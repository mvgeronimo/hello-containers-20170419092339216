<style type="text/css">

	.pad-0 {
		padding:0px;
	}
	.margin-top-20 {
		margin-top:20px;
	}
	.business-div {
		border:1px solid white;
		border-bottom:none;
		/*background-color:#d0d8e8*/
	}
	.business-item {
		border:1px solid white;
		border-bottom:none;
		border-top: none;
		/*background-color:#d0d8e8*/
	}
	.people-div {
		border:1px solid white;
		border-bottom:none;
		/*background-color:#e9edf4*/
	}

	.people-item {
		border:1px solid white;
		border-bottom:none;
		border-top: none;
		/*background-color:#e9edf4*/
	}

</style>

<script type="text/javascript">
$(document).ready(function() {
	$('.btn_conforme').click(function() {
		var om_remarks = $('.om_action_plan').val();
		var agenda_id = $('.agenda_id').val();

		$.ajax({
			type:'post',
			url:'<?=base_url();?>home/om_aknowledge',
			data:{'om_remarks':om_remarks, 'agenda_id':agenda_id}
		}).done(function() {
			$.ajax({
				type:'post',
				url:'<?=base_url();?>home/finish_ojl',
				data:{'agenda_id':agenda_id}
			}).done(function() {
				alert('success');
			})
		})
	})
})
</script>

<input type="hidden" class="agenda_id" value="<?=$evaluation[0]->agenda_id;?>">
<div class="col-md-12 new_version_container" style="background-color:white">
	<div class="col-md-12">
		<div class="col-md-2"></div>

		<div class="col-md-10" style="margin-bottom:10px;">
			<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL REMARKS</p>
			<p class="darkblue-font" style="font-size:50px">OM REMARKS</p>
		</div>
	</div>

	

		<div class="col-md-12 pad-0">
			<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>DISTRICT MANAGER'S REMARKS</b></div>

			<div class="col-md-12 pad-0">
				<textarea style="width:100%" rows="5" class="dm_action_plan" disabled><?=$evaluation[0]->dm_action_plan;?></textarea>
			</div>

			<!-- <div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>DATE RANGE</b></div> -->
			
			<!--<div class="col-md-12 pad-0" style="padding: 15px 0px 0px 0px;border: 1px solid rgb(169, 169, 169);">
				<p class="dm_date"></p> <p class="dm_to"></p> 

			</div>-->
		</div>

		<div class="col-md-12 pad-0">
			<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>PSR's REMARKS</b></div>

			<div class="col-md-12 pad-0">
				<textarea style="width:100%" rows="5" class="psr_action_plan" disabled><?=$evaluation[0]->psr_action_plan;?></textarea>
			</div>

			<!-- <div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>DATE RANGE</b></div> -->

			

			<!-- <div class="col-md-12 pad-0" style="padding: 15px 0px 0px 0px;border: 1px solid rgb(169, 169, 169);">
				<p class="psr_date"></p>

			</div> -->
		</div>

		<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>OM's REMARKS</b></div>

		<div class="col-md-12 pad-0" style="margin-bottom:10px">
			<textarea style="width:100%" rows="5" class="om_action_plan"><?=$evaluation[0]->om_remarks;?></textarea>
		</div>

		<div class="col-md-6">
			
		</div>
		<div class="col-md-6 pad-0" style="text-align:right">
			<button class="darkblue-bg darkblue-btn btn_conforme">Aknowledge</button>
		</div>


	</div>
	
</div>