<?php foreach($data as $key => $c) {  ?>

		<? if($c->is_active > 0){
			$check = "checked";
		   } else {
		   	$check = "";
		   }
		 ?>

	<tr class="search_row pagemember" data-id="<?= $c->job_id; ?>">
		<td class=" ctd" style="display:none;color:#558ed5"><u><?= $c->job_id; ?></u></td>
		<td class="  ctd"><?= $c->job_name; ?></td>
		<td class="  ctd">
			<input type="checkbox" onClick="return false;" name="<?= $c->job_id; ?>" value="<?= $c->is_active; ?>" <?= $check ?>>
		</td>
		<td class="ctd"><a  title='View' data-toggle='tooltip' data-placement='right'>
        <span class='user-edit-icon glyphicon glyphicon-pencil' data-id="<?= $c->job_id; ?>" aria-hidden='true'></span>
        </td>
	</tr>

<?php } ?>

