<style type="text/css">
.planned_table th, .planned_table td, .programs_table th, .programs_table td {
	text-align: center;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
	$('.btn_conforme').click(function() {
		var mp_id = $('.hidden_mp_id').val();
		$.ajax({
			type:'post',
			url:'<?=base_url();?>Home/conforme_mp',
			data:{'mp_id':mp_id}
		}).done(function(result) {
			alert('success');
			window.location = '<?=base_url();?>home';
		})
	})

	$('.btn_cancel').click(function() {
		window.location = '<?=base_url();?>home/ojl_conforme';
	})
})
</script>

<?php 


	$date_from = date_create($mpi[0]->date_from);
	$date_from = date_format($date_from, 'F d');

	$date_to = date_create($mpi[0]->date_to);
	$date_to = date_format($date_to, '-d, Y');

	$mp_id = $mpi[0]->record_id;

?>

<div class="conforme_mpi_div">

	<div class="col-md-12 container_div">
		<div class="col-md-12 title-bar">
			<b>X. ACTIVITY AND STARS MONITORING SHEET</b>
		</div>

		<div class="col-md-12">
			<b>MARKETING PROGRAMS IMPLEMENTATION</b>
		</div>

		<div class="col-md-12">
			Period Covered: <?= $date_from.$date_to; ?>
		</div>

		<input type="hidden" class="hidden_mp_id" value="<?=$mp_id;?>">

		<div class="col-md-12 planned_div" style="margin-top:10px">
			<span><b>Planned</b></span>
			<table class="planned_table table table-bordered col-sm-12 col-md-12 col-lg-12 margintop-10">
				<thead>
					<th>Product</th>
					<th>Name of Program</th>
					<th>Planned</th>
					<th>Actual</th>
					<th>%Perf</th>
					<th>Date Implemented</th>
					<th>Remarks / Next Schedules</th>
				</thead>	

				<tbody>
					<?php foreach($planned as $key => $c) { 
						if($c->plan_type == 1) {
						?>
						<tr>
							<td><?=$c->product;?></td>
							<td><?=$c->name_of_program;?></td>
							<td><?=$c->planned;?></td>
							<td><?=$c->actual;?></td>
							<td><?=$c->perf;?></td>
							<td><?=$c->date_impletemented;?></td>
							<td><?=$c->remarks;?></td>
						</tr>
					<?php } } ?>
				</tbody>
			</table>
		</div>


		<div class="col-md-12 programs_div" style="margin-top:10px">
			<span><b>Programs Implemented on Top of Planned</b></span>

			<table class="programs_table table table-bordered col-sm-12 col-md-12 col-lg-12 margintop-10">
				<thead>
					<th>Product</th>
					<th>Name of Program</th>
					<th>Planned</th>
					<th>Actual</th>
					<th>%Perf</th>
					<th>Date Implemented</th>
					<th>Remarks / Next Schedules</th>
				</thead>	

				<tbody>
					<?php foreach($planned as $key => $c) { 
						if($c->plan_type == 2) {
						?>
						<tr>
							<td><?=$c->product;?></td>
							<td><?=$c->name_of_program;?></td>
							<td><?=$c->planned;?></td>
							<td><?=$c->actual;?></td>
							<td><?=$c->perf;?></td>
							<td><?=$c->date_impletemented;?></td>
							<td><?=$c->remarks;?></td>
						</tr>
					<?php } } ?>
				</tbody>
			</table>
		</div>

		<div class="col-md-12">
			<span><b>S.T.A.R.S. noted:</b><i>Demonstrate Functional Expertise, Thinks Customer, Drives innovation, Examplifies Leadership</i></spa>
		</div>

		<div class="functional_expertise_div col-md-12">
			<span>Competency Exhibited: Functional Expertise</span>

			<table class="function_expertise_table table table-bordered col-sm-12 col-md-12 col-lg-12 margintop-10">
				<tbody>

					<?php foreach($functional_expertise as $key => $c) { ?>
					<tr>
						<td style="width:50%"><b>Situation/Task</b></td>
						<td><?=$c->situation_task;?></td>
					</tr>

					<tr>
						<td style="width:50%"><b>Action</b></td>
						<td><?=$c->action;?></td>
					</tr>

					<tr>
						<td style="width:50%"><b>Result</b></td>
						<td><?=$c->result;?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

		<div class="thinks_customer_div col-md-12">
			<span>Competency Exhibited: Functional Expertise</span>

			<table class="thinks_customer_table table table-bordered col-sm-12 col-md-12 col-lg-12 margintop-10">
				<tbody>

					<?php foreach($thinks_customer as $key => $c) { ?>
					<tr>
						<td style="width:50%"><b>Situation/Task</b></td>
						<td><?=$c->situation_task;?></td>
					</tr>

					<tr>
						<td style="width:50%"><b>Action</b></td>
						<td><?=$c->action;?></td>
					</tr>

					<tr>
						<td style="width:50%"><b>Result</b></td>
						<td><?=$c->result;?></td>
					</tr>

					<tr>
						<td style="width:50%"><b>Alternative Action</b></td>
						<td><?=$c->alternative_action;?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

		<div class="col-md-12" style="text-align:right">
			<button class="btn btn-primary btn_conforme">CONFORME</button>
			<button class="btn btn-primary btn_cancel">CANCEL</button>
		</div>
	</div>


</div>