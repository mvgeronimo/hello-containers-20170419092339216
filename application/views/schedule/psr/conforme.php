<style type="text/css">
.conforme_list th, .conforme_list td {
	text-align: center;
}

.conforme_list tbody tr:hover {
	background-color: grey;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
	$('.conforme_list').delegate('tbody tr', 'click', function() {
		var id = $(this).attr('row-id');
		window.location = '<?=base_url();?>Home/ojl_conforme_details/'+id;
	})
})
</script>

<div class="col-md-12">
	<table class="conforme_list table table-bordered col-sm-12 col-md-12 col-lg-12 margintop-10">
		<thead>
			<th>DM</th>
			<th>DATE FROM</th>
			<th>DATE TO</th>
		</thead>

		<tbody>
		<?php foreach($mpi as $key => $c) { ?>
			<tr row-id="<?=$c->record_id;?>">
				<td><?=$c->username;?></td>
				<td><?=$c->date_from;?></td>
				<td><?=$c->date_to;?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>