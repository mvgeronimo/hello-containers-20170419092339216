


<style type="text/css">

	.menu_btn {

		width: 40%;

		margin-bottom: 10px;



	}



	.navigation_p {

		margin:0px;

		font-size:16px;

		color:#012873;

	}



	.navigation {
		z-index: 999999999;

	}



	.navigation_child {

		padding-top: 5%;

		width: 31.9%;

		margin-right: 15px;







	}



	.nav_btn {



		background-color: #012873;

		color: white;

		width: 100%;

		border: none;

		padding-top: 10px;

		padding-bottom: 10px;

	

	}

.navigation_child img {
    display: block;
    margin: auto;
    margin-top: -25%;
}
/*
	.schedule-logo, .completion-logo, .summary-logo {

		position: absolute;

		top: 29%;

	    left: 20%;

	    z-index: 99999999999999;

	}



	.completion-logo {

	    left: 47%;

	}



	.summary-logo {

		left: 73.5%;

	}
*/




</style>



<script type="text/javascript">

$(document).ready(function() {

	$('.menu_btn').click(function() {

		var type = $(this).attr('menu-type');

		window.location="<?=base_url();?>"+type;

	})

})



</script>



<div class="menu_conatainer" style="margin-top:17%;">

	

	

	



	<div class="col-md-1 navigation">

		<!-- <button class="form-control btn btn-primary menu_btn ojl_completion" menu-type="ojl_completion">OJL COMEPLETION</button> -->

	</div>



	<div class="col-md-10 navigation" >

	



		<div class="col-md-4 col-sm-4 col-xs-4 navigation_child" style="background-color:white">
			<img src="assets/images/schedule-logo.png" class="schedule-logo">

			<div class="col-md-12 pad-0" style="height:135px;">
				<p class="navigation_p"><b>OJL</b></p>

				<p class="navigation_p"><b>SCHEDULE</b></p>



				<p>Set agenda and itinerary of OJL.</p>
			</div>
			
			<div class="col-md-12 pad-0">
				<button class="nav_btn menu_btn ojl_schedule" menu-type="ojl_schedule" style="width:100%;">OJL SCHEDULE</button>
			</div>
		</div>



		<div class="col-md-4 col-sm-4 col-xs-4 navigation_child" style="background-color:white">
			<img src="assets/images/completion-logo.png" class="completion-logo">

			<div class="col-md-12 pad-0" style="height:135px;">
				<p class="navigation_p"><b>OJL</b></p>

				<p class="navigation_p"><b>COMPLETION</b></p>



				<p>Synchronize data from OJL mobile and complete the OJL.</p>
			</div>

			<div class="col-md-12 pad-0">
				<button class="nav_btn menu_btn ojl_schedule" menu-type="ojl_completion_calendar" style="width:100%;">OJL COMPLETION</button>
			</div>
		</div>

		

		<div class="col-md-4 col-sm-4 col-xs-4 navigation_child" style="background-color:white">
			<img src="assets/images/summary-logo.png" class="summary-logo">

			<div class="col-md-12 pad-0" style="height:135px;">
				<p class="navigation_p"><b>OJL</b></p>

				<p class="navigation_p"><b>SUMMARY</b></p>
				<p>Monitor OJL status and view OJL summary.</p>
			</div>

			<div class="col-md-12 pad-0">
				<button class="nav_btn menu_btn ojl_schedule" menu-type="ojl_summary" style="width:100%;">OJL SUMMARY</button>
			</div>
		</div>



		

		

	</div>



	



	<div class="col-md-1 navigation" >

		<!-- <button class="form-control btn btn-primary menu_btn ojl_summary" menu-type="ojl_summary">OJL SUMMARY</button> -->

	</div>



	<div class="col-md-12 white_plains" style="position: absolute;margin-top: 0px; top:50%;">



		</div>



	



</div>



