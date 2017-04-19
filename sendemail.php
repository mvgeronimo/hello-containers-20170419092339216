<?php 
include 'phpmailer.php';

        define("SMTP_HOST", 'smtp.gmail.com'); //Hostname of the mail server
        define("SMTP_PORT", '465'); //Port of the SMTP like to be 25, 80, 465 or 587
        define("SMTP_UNAME", 'agewellcommunity.info@gmail.com'); //Username for SMTP authentication any valid email created in your domain
        define("SMTP_PWORD", '@g3w3llinfo2016');
        $email = 'phpdeveloper9@unilab.com.ph';
 
$fullname = 'JMZ';
$emailadd = 'phpdeveloper9@unilab.com.ph';
$mail = new PHPMailer; // call the class 
$mail->IsSMTP(); 
$mail->SMTPDebug  = 2;
$mail->SMTPAuth   = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = SMTP_HOST; //Hostname of the mail server
$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
$mail->Password = SMTP_PWORD; //Password for SMTP authentication
$mail->AddReplyTo($emailadd, $fullname); //reply-to address
$mail->SetFrom($emailadd, $fullname);    
$mail->Subject = 'Inquiry: ';
$mail->AddAddress($email, $email);         
$mail->MsgHTML("         
  <p>From: ".ucwords($fullname)."</p>
  <p>Inquiry type: "."</p>
  <p>Message:</p>
  ");

$send = $mail->Send(); 

if($send){
  echo 'success';
  }

?>

             