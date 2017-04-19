<style type="text/css">
.summary_thead {
	background-color: #012873;
	color: white;
}
.summary_table th, .summary_table td {
	text-align: center;
}


</style>

<div class="col-md-12 summary_div" style="background-color:white">

	<div class="col-md-2">

	</div>

	<div class="col-md-10">
		<h4 style="color:#ccc">OJL SUMMARY</h4>

	<div class="col-md-12">
			<table class="summary_table table table-bordered col-sm-12 col-md-12 col-lg-12 margintop-10">
				<thead class="summary_thead">
					<th>Action</th>
					<th>PSR</th>
					<th>DATE</th>
					<th>STATUS</th>
				<thead>

				<tbody>

					<?php foreach($summary as $key => $c) { 
						$current_date = date('Y-m-d');
						$date_from = $c->date_from;
						$date_to = $c->date_to;
						$link_completion = '';
						$link_view_agenda = '';
						$is_completion = '';

						//$date_for = date("Y-m-d", strtotime("-7 day", strtotime($date_from)));

						$active = '';
					/*	if($current_date >= $c->date_from ) {
							$status = 'For Completion';
							$link = 'ojl_completion?id='.$c->agenda_id;
							
						} 
						else {
							$status = 'New';
						}

						if($c->dm_action_plan !='') {
							$status = 'Submitted to PSR';
							$link = 'Ojl_evaluation?id='.$c->agenda_id;
							$active = 'a';
						}
						if($c->psr_remarks != '') {
							$status = 'Submitted to OM';
							$link = 'Ojl_evaluation?id='.$c->agenda_id;
							$active = 'a';
						} 
						if($c->om_remarks != ''){
							$status = 'Submitted to Training Department';
							$link = '';
							$active = 'b';
						}
*/
						$link_view_agenda = 'agenda/edit_agenda/'.$c->agenda_id;

						if($c->status==5){
							$status = 'For Completion';
							$link_completion = 'ojl_completion?id='.$c->agenda_id;
							$is_completion = 1;
						}
						if($c->status==1){
							$status = 'New';
						}
						if($c->status==2 || $c->status==3){
							$link_completion = 'Ojl_evaluation?id='.$c->agenda_id;
							$is_completion = 1;
							if($c->status==2){
								$aa = 'PSR';
							}
							else{
								$aa = 'OM';
							}
							$status = 'Submitted to '.$aa;
						}
						if($c->status==4){
							$status = 'Submitted to Training Department';
						}

						$date_from = date_create($c->date_from);
						//$date_from = date_format($date_from, 'M d -');
						$date_to = date_create($c->date_to);
						//$date_to = date_format($date_to, ' d, Y');
						if($date_from==$date_to){
							$date_range = date_format($date_from, 'M d, Y');
						}
						else{
							$date_range = date_format($date_from, 'M d -').date_format($date_to, ' d, Y');
						}

						?>
						<tr>
							<td>
							<?php
								if($c->status==4){
							?>
								<a href="<?=base_url();?>agenda/agenda_details/<?=$c->agenda_id;?>" title="View OJL Report" style="margin-right:10px;"><img src="assets/images/report.png" style="width:17px;"></a>
							<?php 
								} else {
							?>
							<a href="<?=base_url().$link_view_agenda?>" title="View OJL Details" style="margin-right:10px;"><img src="assets/images/eye.png"></a>
							<?php } ?>

							<?php
								if($is_completion==1){
							?>
							<a href="<?=base_url().$link_completion?>" title="OJL Completion"><img src="assets/images/edit-summary.png"></a>
							<?php }?>
							</td>
							<td><?=$c->psr?></td>
							<td><?= $date_range ?></td>
							<td><?=$status;?></td>
						</tr>
					<?php } ?>
				</tbody>	
			</table>
		</div>
	</div>

	

</div>