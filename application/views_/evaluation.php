<style type="text/css">
	.margintop-10 {
		margin-top:10px;
	}

	.center-text {
		text-align: center;
	}
</style>


<script type="text/javascript">
$(document).ready(function() {
	$('.prog-a').addClass('activePage');


	$('.btn_cancel').click(function() {
		window.location = "<?=base_url();?>home";
	})

	$('.btn_submit').click(function() {
		var btn_type = $(this).attr('type');
		var dm_action = $('.dm_action_plan').val();
		var issues_concerns = $('.issues_and_concerns').val();

		

		$.ajax({
			type:'post',
			url:'<?=base_url();?>Ojl_evaluation/insert_evaluation',
			data:{'type':btn_type, 'dm_action':dm_action, 'issues_concerns':issues_concerns, status:2}
		}).done(function() {
			var agenda_id = $('.hidden_agenda').val();
			$.ajax({
				type:'post',
				url:'<?=base_url();?>Ojl_evaluation/sendMail',
				data:{'agenda_id':agenda_id}
			}).done(function() {
				bootbox.alert('<b>The OJL report has been forwarded to the PSR for review and acknowledgment.</b>', function() {
					location.reload();
				});
			})
			
			//window.location = '<?=base_url();?>Home';

		})
	})

	$('.btn_cancel').click(function() {
		window.location = '<?=base_url();?>Home';
	})
})
</script>

 <?php $date = date('F d, Y'); 

 	foreach($agenda  as $key => $c) {
 		$psr = $c->psr;
 		
 			$salary = $c->salary;
 		
 		
 		$territory = $c->territory;
 		$date_from = date_create($c->date_from);
 		
 		$date_to = date_create($c->date_to);
 		

 		if($date_from == $date_to) {
 			$date_of = date_format($date_from, 'F d, Y');
 		} else {
 			$datefrom = date_format($date_from, 'F d -');
 			$dateto = date_format($date_to, ' d, Y');
 			$date_of = $datefrom.$dateto;
 		}	

 		$salary_grade = $c->salary_grade;
 		$status = $c->status;

 		$competency_standards = $c->competency_standards;
 	}

 	foreach($evaluation as $key => $c) {
 		$dm_remarks = $c->dm_action_plan;
 		$psr_remarks = $c->psr_action_plan;
 		$om_remarks = $c->om_remarks;
 		$issues_and_concerns = $c->issues_and_remarks;
 	}

 ?>

<style type="text/css">

.crae {
	padding-left: 0px;
	margin-bottom: 10px;
}

</style>

<input type="hidden" class="hidden_psr" value="<?=$this->session->userdata('agenda_psr');?>">
<input type="hidden" class="hidden_agenda" value="<?=$this->session->userdata('agenda_id');?>">
<input type="hidden" class="hidden_step" value="<?=$this->session->userdata('step');?>">
<div class="evaluation_div col-md-12" style="background-color:white">
	<div class="col-md-2 progress_div">
		<?php $this->load->view('schedule/progress.php'); ?>
	</div>

	<div class="col-md-10 container_div">
		<div class="col-md-12 pad-0">
			<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL COMPLETION</p>
			<p class="darkblue-font page_title">EVALUATION, AGREEMENTS AND DIRECTIONS</p>
		</div>

		<div class="col-md-12 pad-0">
				<div class="col-md-6 pad-0 margintop-10" style="">

					<div class="col-md-12 crae">
						<div class="col-md-4"><b>Name of DM: </b></div>
						<div class="col-md-8"><?= $this->session->userdata('firstname').' '.$this->session->userdata('lastname'); ?></div>
					</div>

					<div class="col-md-12 crae">
						<div class="col-md-4"><b>Name of PSR: </b></div>
						<div class="col-md-8"><span class="psr"><?=$psr;?></span></div>
					</div>

					<div class="col-md-12 crae">
						<div class="col-md-4"><b>Salary Grade: </b></div>
						<div class="col-md-8"><b><?=$salary_grade?></b></div>
					</div>		
				</div>

				<div class="col-md-6 pad-0">

					<div class="col-md-4 pad-0 margintop-10">
						<b>Territory: </b>
					</div>

					<div class="col-md-6 pad-0 margintop-10">
				
						<span class="territory"><?=$territory;?></span>
					</div>

					<div class="col-md-2"></div>




					<div class="col-md-4 pad-0 margintop-10">
						<b>Date : </b>
					</div>

					<div class="col-md-6 pad-0 margintop-10">
						<?= $date_of; ?>
					</div>

					<div class="col-md-2"></div>


					<div class="col-md-4 pad-0 margintop-10">
						<b>Competency Standard: </b>
					</div>

					<div class="col-md-6 pad-0 margintop-10">
						<span><?=$competency_standards?></span>
					</div>

					<div class="col-md-2"></div>



				</div>

			</div>

		<div class="col-md-12 darkblue-bg darkblue-btn" style="margin-top:25px;"><b>EVALUATION, AGREEMENTS AND DIRECTIONS</b></div>
		<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>DISTRICT MANAGER'S ACTION PLAN</b></div>

		<div class="col-md-12 pad-0">
			<?php if($status == 2 || $status == 3 || $status == 4) { ?>
				<textarea style="width:100%" rows="5" class="dm_action_plan" disabled><?=$dm_remarks;?></textarea>
			<?php } else { ?>
				<textarea style="width:100%" rows="5" class="dm_action_plan"><?=$dm_remarks;?></textarea>
			<?php } ?>
		</div>

		<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>PSR'S ACTION PLAN</b></div>

		<div class="col-md-12 pad-0">
			<textarea style="width:100%" rows="5" class="psr_action_plan" disabled><?= $psr_remarks; ?></textarea>
		</div>

		<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>OM'S REMARKS</b></div>

		<div class="col-md-12 pad-0">
			<textarea style="width:100%" rows="5" class="om_action_plan" disabled><?=$om_remarks;?></textarea>
		</div>

		<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>ISSUES AND CONCERNS</b></div>

		<div class="col-md-12 pad-0">
			<?php if($status == 2 || $status == 3 || $status == 4) { ?>
				<textarea style="width:100%" rows="5" class="issues_and_concerns" disabled><?= $issues_and_concerns; ?></textarea>
			<?php } else { ?>
				<textarea style="width:100%" rows="5" class="issues_and_concerns"><?= $issues_and_concerns; ?></textarea>
			<?php } ?>
		</div>


		<div class="col-md-12 pad-0" style="text-align:right;margin-top:10px;margin-bottom:15px;">
			
			<?php if($status != 2 && $status != 3 && $status != 4) { ?>
				<button class="darkblue-bg darkblue-btn btn_cancel" type="1">CANCEL</button>
				<button class="darkblue-bg darkblue-btn btn_submit" type="2">SUBMIT</button>
			<?php } ?>	
		</div>

	
	</div>
</div>