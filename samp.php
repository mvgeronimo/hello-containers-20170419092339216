
<!DOCTYPE>
<html>
<title>OJL</title>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://biomedisojl.unilab.com.ph/assets/js/jquery-1.11.1.min.js"></script>

<script type="text/javascript" src="http://biomedisojl.unilab.com.ph/assets/js/bootstrap.min.js"></script>

<script type="text/javascript" src="http://biomedisojl.unilab.com.ph/assets/js/bootbox.min.js"></script>

<script type="text/javascript" src="http://biomedisojl.unilab.com.ph/assets/js/bootstrap-table.min.js"></script>

<script type="text/javascript" src="http://biomedisojl.unilab.com.ph/assets/js/ajaxfiledownload.js"></script>

<!--<script type="text/javascript" src="http://biomedisojl.unilab.com.ph/assets/js/cascadingdropdown.js"></script> -->

<link rel="stylesheet" type="text/css" href="http://biomedisojl.unilab.com.ph/assets/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="http://biomedisojl.unilab.com.ph/assets/css/bootstrap-table.min.css">
<link rel="stylesheet" type="text/css" href="http://biomedisojl.unilab.com.ph/assets/css/responsive.css">


</head>
<body>



<style type="text/css">

	.center_log {

		text-align:center; margin-bottom:15px;

	}



	.login_container {

		background-image: url('assets/images/login-background.png');

		margin: 0px;

		background-size: 100%;

		width: 100%;

		background-repeat: no-repeat;

		padding: 0px;

		height: 100%;

	}



	.user_pass_con {

		background-color:white;

		width:27%;

		

		margin-top:14%;

		padding-top: 4%;

		padding-left: 1%;

		padding-right: 1%;

		padding-bottom: 1%;

		text-align: center;

		position: fixed;

		left:50%;

		transform: translate(-50%, -50%);

		z-index: 999999;



	}







	#login_btn {

		background-color: #012873;

		color: white;

		width: 100%;

		border: none;

		padding-top: 10px;

		padding-bottom: 10px;

	}



	.white_plains {

		background-color:white;

		height:205px;

		position: absolute;

		top: 60%;

	}



	.login-lock {

		position: absolute;

		left: 46.5%;

	    top: 23%;

	    z-index: 9999999999999999999;

	}



	.footer-login {

		color:white;

		margin-top:35%;

	}



	.footer-login p {

		margin: 0px;

	}







</style>











<script type="text/javascript">

$(document).ready(function() {



	$(document).keypress(function(e) {

		if(e.which == 13) {

			$('#login_btn').click();

		}

	})

	

	$(document).on('click', '#login_btn', function(){

		//alert($('.agenda_id').val());

		



		var username = $('#login_username').val();

		var password = $('#login_password').val();



		if(username == '') {

			$('#login_username').css({'border-color':'red'});

		} else {

			$('#login_username').css({'border-color':'#ccc'});

		}



		if(password == '') {

			$('#login_password').css({'border-color':'red'});

		} else {

			$('#login_password').css({'border-color':'#ccc'});

		}



		if(username != '' || password != '') {



			$.ajax({

	          'url' : 'http://biomedisojl.unilab.com.ph/azure/pwgrant.php',

	          'data' : {email:username,password:password},

	          'type' : 'post'

	        }).done(function(data){



	        	obj = jQuery.parseJSON(data);

	        	

            	if(obj.status=='success'){

            		

					$.ajax({

						type:'post',

						url:'http://biomedisojl.unilab.com.ph/login_controller/verifyUser',

						data:{"username":username, "password":password, data:obj.dataresult}	

					}).done(function(result) {

						var obj = jQuery.parseJSON(result);



						if(obj.result == '1') {

							var agenda_id = "";   //$('.agenda_id').val();



							if(agenda_id != '') {



								var user_type = obj.data[0].user_type_id;





								

								if(user_type == '2') {

									$.ajax({

										type:'post',

										url:'http://biomedisojl.unilab.com.ph/login_controller/check_if_psr',

										data:{'agenda_id':agenda_id}

									}).done(function(result) {

										if(result == 'not') {

											bootbox.alert("<b>You are not the PSR of this agenda.</b>", function() {

												window.location = 'http://biomedisojl.unilab.com.ph/login_controller/logout';

											})

										} else {

											window.location = 'http://biomedisojl.unilab.com.ph/Agenda/psr_comment/'+agenda_id;

										}

									})



									

								} else {	

									window.location = 'http://biomedisojl.unilab.com.ph/Agenda/om_comment/'+agenda_id;

								}

								

							} else {



								window.location = 'http://biomedisojl.unilab.com.ph/home';

							}

							

						} else {

							bootbox.alert("<b>The username/password does not match.</b>");





						}

					})

				}

				else{

					

					bootbox.alert("<b>The username/password does not match.</b>");

				}

			})

			

		} else {

			bootbox.alert("<b>Kindly enter your network ID and password.</b>");

		}

		

	})

})

</script>

<div class="container login_container">

	<input type="hidden" class="agenda_id" value="">



	<!-- <div class="row" style="width:100%;margin:0px;"> -->

		



		<div class="col-md-12">

			<img src='assets/images/biomedis-logo.png' class="biomedis-logo" style="margin-left:15px;width:160px;background:#fff;">

		</div>


		<div class="col-md-12">
			<div class="logo-con1">
			<img src="assets/images/ojl-lock.png" class="login-lock">
		</div>
		<div class="col-md-12 user_pass_con" style="">
		

				<div class="col-md-12 center_log">

					<p style="color:#012873"><b>SIGN IN TO CONTINUE</b></p>

				</div>



				<div class="col-md-12 center_log">

					<input type="text" placeholder="Email Address" id="login_username" class="form-control">

				</div>



				<div class="col-md-12 center_log">

					<input type="password" placeholder="Password" id="login_password" class="form-control">

				</div>



				<div class="col-md-12 center_log">

					<button id="login_btn">LOGIN</button>

				</div>



		</div>
		</div>



		<div class="col-md-12 white_plains">



		</div>



		







	<!-- </div> -->





	



</div>

<div class="col-md-12 foot">

	<div class="col-md-6 footer-login">

	<p>Copyright 2016, unilab.com.ph; All rights reserved.</p>

	<!-- <p><u>Terms & Conditions of Use</u> | <u>Website Privacy Notice</u> | <u>Social Media Policy</u></p> -->

	<p>&nbsp;</p>

	</div>



<div class="col-md-6 footer-login foots2" style="text-align:right;margin-top:34%;">

<img src="assets/images/biomedis-footer.png">

</div>

</div>



<!--[if IE]>

<style>

    .user_pass_con {

		background-color:white;

		width:30%;

		

		margin-top:4%;

		margin-left:-15%;

		padding-top: 60px;

		padding-left: 10px;

		padding-right: 10px;

		padding-bottom: 10px;

		text-align: center;

		position: absolute;

		z-index:2 !important;

		left:50%;



		



	}



	.white_plains {

		background-color:white;

		height:205px;

		position: absolute;

		top: 60%;

		width:100%;

		z-index:1 !important;

	}



	.footer-login {

		color:white;

		margin-top:33.5%;

	}



	.foots2 {

		margin-top:40% !important;

	}





</style>

<![endif]-->

</body>
</html>