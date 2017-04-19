





<?php $this->load->view('template/header'); ?>

<div class="container">

	

<div class="loader" style="">

<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" style="z-index:99999;height:600px;position:absolute;">

<img src="<?php echo base_url(); ?>assets/images/loader2.gif" style="left:50%;top:30%;position:fixed;">

</div>

</div>





<div class="header" style="margin-bottom:3%;">

	<div class="col-md-6">

		<img src='assets/images/biomedis-logo.png' class="biomedis-logo" style="margin-left:15px;position:absolute;z-index:9;width:160px;background:#fff;">

	</div>



	<div class="col-md-6 loginName" style="text-align:right;color:white;padding-right:40px;;margin-top:10px">

		Welcome, <b><?php echo ucfirst($this->session->userdata('firstname')).' '.ucfirst($this->session->userdata('lastname')); ?></b> <a href='' class="btn-logout" style="color:white"><i>(Logout)</i></a>

	</div>

</div>

<?php $this->load->view($content); ?>



<?php $this->load->view('template/footer');?>

</div>
<?php if($content == 'home' || $content == 'ojl_summary' || $content == 'ojl_schedule' || $content == 'ojl_completion_calendar'){?>
<style type="text/css">
	.footer1{
		position: absolute;bottom: 0px;
	}
</style>
<?php } ?>



<input type="hidden" class="2nd_url" value="<?= $this->uri->segment(1);?>">

<input type="hidden" class="3rd_url" value="<?= $this->uri->segment(2);?>">



<script type="text/javascript">





$(document).ready(function() {

	var path = '<?=base_url();?>';

	var nd_url = $('.2nd_url').val();

	var third_url = $('.3rd_url').val();



	$('.biomedis-logo').click(function() {
		var home_url = "<?=(isset($home_link)) ? $home_link : ''?>";
		if(home_url!=''){
			window.location = '<?=base_url()?>'+home_url;
		}
		else{
			window.location = '<?=base_url()?>Home';
		}

	})



	$('.biomedis-logo').attr('src', path+'assets/images/biomedis-logo.png');

	$('.footer-login img').attr('src', path+'assets/images/biomedis-footer.png');



	//$('.prog-img').attr('src', path+'assets/images/piatos-ol.png');

	

	for(piatos=1;piatos<=11;piatos++) {

		$('.piatos_'+piatos).attr('src', path+'assets/images/piatos-ol-'+piatos+'.png');

	}

	



	

})

</script>