
<style type="text/css">
	.prog_agenda {
		color:blue;
	}


	.margintop-10 {
		margin-top:10px;
	}
	.psr, .territory {
		height: 25px !important;
		padding: 0px !important;
	}
</style>

<script type="text/javscript">
$(document).ready(function() {

  alert('a');

  $('.btn-save').click(function() {
    alert('a');
  })

})

</script>

<?php if($AgendaType == 2) {


		foreach($agenda as $value) {
	 		$agenda_id = $value->agenda_id;
	 		$dm = $value->dm;

	 		$date_from = $value->date_from;
	 		$datefrom = date_create($date_from);
	 		$day1 = date_format($datefrom, 'F d, Y');
	 		$datefrom = date_format($datefrom, 'F d');
	 		
	 		$date_to = $value->date_to;
	 		$dateto = date_create($date_to);
	 		$day2 = date_format($dateto, 'F d, Y');
	 		$dateto = date_format($dateto, 'd, Y');
	 		
	 		$date_of_ojl = $datefrom.'-'.$dateto;

	 		$psr = $value->psr_name;
	 		$territory = $value->territory_name;
	 		$salary = $value->salary;
	 		$competency = $value->competency_standards;

		 }
	}
?>



<div class="create_div">
	<input type="hidden" class="input_next_id">
	<?php include('progress.php'); ?>


	<div class="col-md-12 agenda_div"> <!-- div for agenda -->
		<div class="col-md-12 title-bar">
			<b>I. AGENDA</b>
		</div>

		<div class="col-md-12">
			<div class="col-md-6 margintop-10" style="">
				<div class="col-md-4">
					<b>Name of DM: </b>
				</div>

				<div class="col-md-8">
					<?php if($AgendaType == 2) { ?>
						<p class="p_dm" dm="<?php echo $this->session->userdata('username'); ?>"><?=$dm;?></p>
					<?php } else { ?>
						<p class="p_dm" dm="<?php echo $this->session->userdata('username'); ?>"><?php echo $this->session->userdata('username'); ?></p>
					<?php } ?>

				</div>

				<div class="col-md-4 margintop-10">
					<b>Name of PSR: </b>
				</div>

				<div class="col-md-8 margintop-10">
					<select class="form-control psr">
						<?php foreach($psr as $key => $c) { ?>
							<option value="<?= $c->psr_id; ?>"><?= $c->psr_name; ?></option>
						<?php } ?>
					</select> 
				</div>

				<div class="col-md-4 margintop-10">
					<b>Salary Grade: </b>
				</div>

				<div class="col-md-8 margintop-10">
					<b>2000</b>
				</div>

				<div class="col-md-4 margintop-10">
					<b>Territory: </b>
				</div>

				<div class="col-md-8 margintop-10">
					<select class="form-control territory">
						<?php foreach($territory as $key => $c) { ?>
							<option value="<?= $c->territory_id; ?>"><?= $c->territory_name; ?></option>
						<?php } ?>
		
					</select> 
				</div>


			</div>

			<div class="col-md-6">
				<div class="col-md-4 margintop-10">
					<b>Date From: </b>
				</div>

				<div class="col-md-8 margintop-10">
					<?php include('date_from.php'); ?>
				</div>

				<div class="col-md-4 margintop-10">
					<b>Date To: </b>
				</div>

				<div class="col-md-8 margintop-10">
				 <?php include('date_to.php'); ?>
				</div>

				<div class="col-md-4 margintop-10">
					<b>Competency Standard: </b>
				</div>

				<div class="col-md-8 margintop-10">
					<input type="text" class="form-control" id="competency_standards">
				</div>

			</div>

		</div>

		<!-- div for business people-->

		<div class="col-md-12" style="margin-top:25px;border:1px solid black">
			<div class="col-md-12">

				<div class="col-md-5" style="">
					<b>AGENDA</b>
				</div>

				<div class="col-md-7">
					<b>SPECIFIC PLAN(S)</b>
				</div>
			</div>

			<div class="col-md-12 business_development_cont">

				<div class="col-md-12">
					<div class="col-md-5" style="margin-top:15px">
						<b>Business Development</b>
					</div>

					<div class="col-md-7" style="margin-top:15px">
						
					</div>
				</div>

				<div class="col-md-12">
					<div class="col-md-5" style="margin-top:15px">
						<button class="btn btn-primary add_agenda">Add Agenda</button> 
					</div>

					<div class="col-md-7" style="margin-top:15px">
						
					</div>
				</div>



				<div class="agenda_cont">
					<div class="col-md-12 business_1">
						<div class="col-md-5" style="margin-top:15px">
							<div class="col-md-10" style="padding:0px">
								<select class="agenda_name form-control agd_1">
								<?php foreach($dropdown as $key => $value) { ?>
								<option value="<?php echo $value->agenda_name_id; ?>"><?php echo $value->agenda_name; ?></option>
								<?php } ?>
								</select>
							</div>

							<div class="col-md-2">
								<button class="btn btn-primary minus_agenda" btn-num="1" style="height: 34px;width:40px">
									<span class="glyphicon glyphicon-minus" aria-hidden="true">
								</button>
							</div>
						</div>

						<div class="col-md-7" style="margin-top:15px">
							<input type="text" class="action_plan_1 form-control" placeholder="Action Plan">
						</div>
					</div>

				</div>

				<div class="col-md-12">
					<div class="col-md-5" style="margin-top:15px">
						
					</div>

					<div class="col-md-7" style="margin-top:15px;text-align:right">
						<button class="btn btn-primary save_business" data-val="1">Save</button> 
					</div>
				</div>

			</div>


			<div class="col-md-12 people_development_cont">

				<div class="col-md-12">
					<div class="col-md-5" style="margin-top:15px">
						<b>People Development</b>
					</div>

					<div class="col-md-7" style="margin-top:15px">
						
					</div>
				</div>

				<div class="col-md-12">
					<div class="col-md-5" style="margin-top:15px">
						<button class="btn btn-primary add_people_agenda">Add Agenda</button> 
					</div>

					<div class="col-md-7" style="margin-top:15px">
						
					</div>
				</div>

				<div class="people_cont">
					<div class="col-md-12 ppl_1">

						<div class="col-md-5" style="margin-top:15px">
							<div class="col-md-10" style="padding:0px">
								<!--<input type="text" class="agenda_name_people_1 form-control" placeholder="Agenda">!-->
								<select class="agenda_name_people_1 form-control">
								<?php foreach($dropdown as $key => $value) { ?>
								<option value="<?php echo $value->agenda_name_id; ?>"><?php echo $value->agenda_name; ?></option>
								<?php } ?>
								</select>
							</div>

							<div class="col-md-2">
								<button class="btn btn-primary minus_ppl_agenda" btn-num="1" style="height: 34px;width:40px">
									<span class="glyphicon glyphicon-minus" aria-hidden="true">
								</button>
							</div>
							
						</div>

						<div class="col-md-7" style="margin-top:15px">
							<input type="text" class="action_plan_people_1 form-control" placeholder="Action Plan">
						</div>
					</div>

				</div>

				<div class="col-md-12">
					<div class="col-md-5" style="margin-top:15px">
						
					</div>

					<div class="col-md-7" style="margin-top:15px;text-align:right">
						<button class="btn btn-primary save_people" data-val="2">Save</button> 
					</div>
				</div>


			</div>

			

		</div>

		<!-- end of business people -->
	</div> <!-- end for agenda -->

	


	<div class="col-md-12" style="text-align:right">
			<button class="btn btn-primary to_itenerary">Itenerary</button> 
		</div>

  <div class="col-md-12" style="text-align:right;display:none">
    <button class="btn btn-primary btn-save">Save</button>
  </div>

</div>