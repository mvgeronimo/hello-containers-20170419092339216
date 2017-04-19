<!DOCTYPE html>
<html>
<title>OJL</title>
<head>
<style>
.loader{
	position:relative;
	display:none;
	background-color:#fff;
	opacity:0.5;
	z-index:99999;
}
</style>

	<meta charset="utf-8" />
 <!--   <meta http-equiv="X-UA-Compatible" content="IE=8,IE=EmulateIE8,IE=7,IE=EmulateIE7" /> -->
<!--  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
<meta http-equiv="X-UA-Compatible" content="IE=9">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-table.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/ajaxfiledownload.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/cascadingdropdown.js"></script> -->
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/ie.css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-table.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/default.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/responsive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/responsive_maintenance.css">

<?php $this->load->view('completion/script.php') ?>
<script type="text/javascript">
$(document).ready(function() {
	$('.btn-logout').click(function(e) {
		e.preventDefault();

		$.ajax({
			url:'<?=base_url();?>Login_controller/logout'
		}).done(function(result) {
			window.location = '<?=base_url();?>';
		})

	})
})

</script>

</head>

<body>


