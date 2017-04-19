<style type="text/css">
.remarks_table th, .remarks_table, .remarks_table th {
		text-align: center;

	}

.remarks_table tbody tr:hover {
	background-color:grey;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
	$('.remarks_table').delegate('tbody tr', 'click', function() {
		var id = $(this).attr('row-id');
		window.location = '<?=base_url();?>Home/remarks_details/'+id;
	})
})
</script>

<div class="col-md-12">
	<table class="remarks_table table table-bordered col-sm-12 col-md-12 col-lg-12 margintop-10">
		<thead>
			<th>DM</th>
			<th>AGENDA ID</th>
		</thead>

		<tbody>
			<?php foreach($remarks as $key => $c) { ?>
			<tr row-id="<?=$c->record_id; ?>">
				<td><?=$c->username; ?></td>
				<td><?=$c->agenda_id; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>