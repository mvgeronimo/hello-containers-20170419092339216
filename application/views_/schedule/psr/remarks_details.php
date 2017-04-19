<style type="text/css">
	.margintop-10 {
		margin-top:10px;
	}

	.dm_action_plan_table th, .dm_action_plan_table tr {
		text-align: center;
	}
</style>

<script type="text/javascript">
$(document).ready(function() {
	$('.btn_submit').click(function() {
		var record_id = $('.record_id').val();
		var psr_action_plan = $('.psr_action_plan').val();
		
		$.ajax({
			type:'post',
			url:'<?=base_url();?>Home/update_remarks',
			data:{"record_id":record_id, "psr_action_plan":psr_action_plan,"role":"psr"}
		}).done(function() {
			alert('success');
		})		
	})
})
</script>


<input type="hidden" class="record_id" value="<?=$remarks[0]->record_id?>">
<div class="evaluation_div">
	<div class="col-md-12">
			<table class="dm_action_plan_table table table-bordered col-sm-12 col-md-12 col-lg-12 margintop-10">
				<thead>
					<th>DM's Action Plan</th>
					<th>Time Range</th>
				</thead>

				<tbody>
					<tr>
						<td><?= $remarks[0]->dm_action_plan; ?></td>
						<td> < remarks here > </td>
					</tr>
				</tbody>
			</table>
		</div>

	<div class="col-md-12">
			<table class="psr_action_plan_table table table-bordered col-sm-12 col-md-12 col-lg-12 margintop-10">
				<thead>
					<th>PSR's Action Plan</th>
					
				</thead>

				<tbody>
					<tr>
						<td><input type="text" class="form-control psr_action_plan"></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="col-md-12" style="text-align:right">
			<button class="btn btn-primary btn_submit" type="1">Save as Draft</button>
			<button class="btn btn-primary btn_submit" type="2">Submit</button>
			<button class="btn btn-primary btn_cancel" type="1">Cancel</button>
		</div>
</div>