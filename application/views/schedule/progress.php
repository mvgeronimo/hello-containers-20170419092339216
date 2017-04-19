<style type="text/css">
	.prog {
		color:#7a7a7a;
		float:left
	}

	.prog:hover {
		opacity: .5;


	}
	.prog-a {
		cursor: pointer;
	}
	.top-15 {
		margin-top: 15px;
	}
</style>

<script type="text/javascript">
$(document).ready(function() {
	var currentStep = $('.currentStep').val();

	if(currentStep == 1) {
		$('.i').addClass('activePage');
	} else if(currentStep == 2) {
		$('.i').addClass('activePage');
		$('.ii').addClass('activePage');
	} else if(currentStep == 3) {
		$('.i').addClass('activePage');
		$('.ii').addClass('activePage');
		$('.iii').addClass('activePage');
	} else if(currentStep == 4) {
		$('.i').addClass('activePage');
		$('.ii').addClass('activePage');
		$('.iii').addClass('activePage');
		$('.iv').addClass('activePage');
	} else if(currentStep == 5) {
		$('.i').addClass('activePage');
		$('.ii').addClass('activePage');
		$('.iii').addClass('activePage');
		$('.iv').addClass('activePage');
		$('.ix').addClass('activePage');
	} else if(currentStep == 6) {
		$('.i').addClass('activePage');
		$('.ii').addClass('activePage');
		$('.iii').addClass('activePage');
		$('.iv').addClass('activePage');
		$('.v').addClass('activePage');
		$('.ix').addClass('activePage');
	} else if(currentStep == 7) {
		$('.i').addClass('activePage');
		$('.ii').addClass('activePage');
		$('.iii').addClass('activePage');
		$('.iv').addClass('activePage');
		$('.v').addClass('activePage');
		$('.vi').addClass('activePage');
		$('.ix').addClass('activePage');
	} else if(currentStep == 8) {
		$('.i').addClass('activePage');
		$('.ii').addClass('activePage');
		$('.iii').addClass('activePage');
		$('.iv').addClass('activePage');
		$('.v').addClass('activePage');
		$('.vi').addClass('activePage');
		$('.vii').addClass('activePage');
		$('.ix').addClass('activePage');
	} else if(currentStep == 9) {
		$('.i').addClass('activePage');
		$('.ii').addClass('activePage');
		$('.iii').addClass('activePage');
		$('.iv').addClass('activePage');
		$('.v').addClass('activePage');
		$('.vi').addClass('activePage');
		$('.vii').addClass('activePage');
		$('.viii').addClass('activePage');
		$('.ix').addClass('activePage');
	} else if(currentStep == 10) {
		$('.i').addClass('activePage');
		$('.ii').addClass('activePage');
		$('.iii').addClass('activePage');
		$('.iv').addClass('activePage');
		$('.v').addClass('activePage');
		$('.vi').addClass('activePage');
		$('.vii').addClass('activePage');
		$('.viii').addClass('activePage');
		$('.ix').addClass('activePage');
		$('.x').addClass('activePage');
	} else if(currentStep == 11) {
		$('.i').addClass('activePage');
		$('.ii').addClass('activePage');
		$('.iii').addClass('activePage');
		$('.iv').addClass('activePage');
		$('.v').addClass('activePage');
		$('.vi').addClass('activePage');
		$('.vii').addClass('activePage');
		$('.viii').addClass('activePage');
		$('.ix').addClass('activePage');
		$('.x').addClass('activePage');
		$('.xi').addClass('activePage');
	}

})
</script>

<?php //echo '<pre>'; print_r($this->session->all_userdata()); ?>
<input type="hidden" class="currentStep" value="<?=$this->session->userdata('step');?>">
<input type="hidden" class="hidden_step" value="<?=$this->session->userdata('step');?>">
<!-- <div class="col-md-12 progress" style="background-color:#ccc; font-size:19px;">
		<span class="glyphicon glyphicon-asterisk prog prog_agenda" aria-hidden="true"></span>
		<span class="glyphicon glyphicon-asterisk prog prog_itenerary" aria-hidden="true"></span>
		<span class="glyphicon glyphicon-asterisk prog prog_sales_plan" aria-hidden="true"></span>
		<span class="glyphicon glyphicon-asterisk prog prog_cp_monitoring" aria-hidden="true"></span>
		<span class="glyphicon glyphicon-asterisk prog" aria-hidden="true"></span>
	</div> -->

<div class="tab-paging">
	<!-- <ol class="flex-control-nav flex-control-paging" style="clear:both;float:none">
			<li > <a class="i">1</a></li>
			<li > <a class="ii">2</a></li>
			<li > <a class="iii">3</a></li>
			<li > <a class="iv">4</a></li>
			<li > <a class="v">5</a></li>
			<li > <a class="vi">6</a></li>
			<li > <a class="vii">7</a></li>
			<li > <a class="viii">8</a></li>
			<li > <a class="ix">9</a></li>
			<li > <a class="x">10</a></li>
			<li > <a class="xi">11</a></li>
	</ol> -->

	<div class="col-md-12 pad-0">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_1">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a i">Agenda</a>
		</div>
	</div>
	
	<div class="col-md-12 pad-0 top-15">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_2">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a ii">Itinerary</a>
		</div>
	</div>

	<div class="col-md-12 pad-0 top-15">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_3">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a iii">Sales Plan for the Month</a>
		</div>
	</div>

	<div class="col-md-12 pad-0 top-15">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_4">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a iv">Coverage Performance Monitoring</a>
		</div>
	</div>

	<div class="col-md-12 pad-0 top-15">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_5">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a ix">Employee Competency Development</a>
		</div>
	</div>


	<div class="col-md-12 pad-0 top-15">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_6">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a v">Client Engagement</a>
		</div>
	</div>

	<div class="col-md-12 pad-0 top-15">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_7">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a vi">Product Communication Exercise</a>
		</div>
	</div>

	<div class="col-md-12 pad-0 top-15">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_8">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a vii">Survey on Drugstores and Pharmacies</a>
		</div>
	</div>

	<div class="col-md-12 pad-0 top-15">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_9">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a viii">Competitor's Activity Report</a>
		</div>
	</div>

	
	<div class="col-md-12 pad-0 top-15">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_10">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a x">Activity and STARS Monitoring Sheet</a>
		</div>
	</div>

	<div class="col-md-12 pad-0 top-15">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_11">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a xi">Evaluation, Agreements and Directions</a>
		</div>
	</div>
	
</div>

<script type="text/javascript">
$(document).ready(function() {
	// $('.xi').click(function() {
	// 	window.location = '<?=base_url();?>Ojl_evaluation';
	// })

	// $('.ii').click(function() {
	// 	window.location = '<?=base_url();?>Agenda/edit_itenerary';
	// })

	var path = '<?=base_url();?>';

	//$('.prog-img').attr('src', '../assets/images/piatos-ol.png');

	//$('.i').attr('src', path+'assets/images/piatos-ol-1.png');

	$('.prog-a').css({'color':'#ccc'});
})
</script>