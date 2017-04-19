
FROM registry.ng.bluemix.net/mvgeronimo/php-template
MAINTAINER Sudesh Krishnamoorthy

######## SETUP MSSQL ########
ENV MS_ODBC_URL https://download.microsoft.com/download/B/C/D/BCDD264C-7517-4B7D-8159-C99FC5535680/RedHat6/msodbcsql-11.0.2270.0.tar.gz
ENV FIX_SCRIPT Microsoft--SQL-Server--ODBC-Driver-1.0-for-Linux-Fixed-Install-Scripts
ENV FIX_SCRIPT_URL https://github.com/Andrewpk/${FIX_SCRIPT}/archive/master.zip

# Set the locale
RUN apt-get update && apt-get -y install locales && locale-gen en_US.UTF-8
#ENV LANG en_US.UTF-8
#ENV LANGUAGE en_US:en
#ENV LC_ALL en_US.UTF-8

RUN apt-get -y install aptitude wget unzip make gcc libkrb5-3 libgssapi-krb5-2

# Download ODBC install files & scripts
RUN cd /tmp && wget -O msodbcsql.tar.gz ${MS_ODBC_URL} && wget -O odbc-fixed.zip ${FIX_SCRIPT_URL}

# Unzip downloaded files
RUN cd /tmp && tar -xzf ./msodbcsql.tar.gz && unzip -o ./odbc-fixed.zip && cp ./${FIX_SCRIPT}-master/* ./msodbcsql-11.0.2270.0

# Run install scripts
RUN cd /tmp/msodbcsql-11.0.2270.0 && yes YES | ./build_dm.sh --accept-warning --libdir=/usr/lib/x86_64-linux-gnu && ./install.sh install --accept-license --force
RUN apt-get -y -o Dpkg::Options::="--force-confnew" install apache2 php5
RUN /usr/sbin/a2enmod rewrite
RUN php5enmod mssql


####### SETUP MYSQL AND PHP #######
RUN apt-get install -y --force-yes curl nano && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get install -y --force-yes \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
    libicu-dev \
     libxml2-dev \
     libldap2-dev \
    vim \
        wget \
        unzip \
        git \
    && docker-php-ext-install -j$(nproc) iconv intl xml soap mcrypt opcache pdo pdo_mysql mysqli mysql mbstring \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap && a2enmod rewrite \
    && apt-get -y -o Dpkg::Options::="--force-confnew" install php5-mssql
RUN apt-get purge -y php5-common libapache2-mod-php5 php5-mysql \
        && apt-get install -y libapache2-mod-php5 php5-mysql
COPY ./ /var/www/html/
RUN service apache2 restart
EXPOSE 80