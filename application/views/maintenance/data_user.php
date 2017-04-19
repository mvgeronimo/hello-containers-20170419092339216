<?php foreach($data as $key => $c) {  ?>

		<? if($c->status > 0){
			$check = "checked";
		   } else {
		   	$check = "";
		   }
		 ?>

	<tr class="search_row pagemember" data-id="<?= $c->user_id; ?>">
		<td class=" ctd" style="display:none;color:#558ed5"><u><?= $c->user_id; ?></u></td>
		<td class="  ctd"><?= $c->username; ?></td>
		<td class="  ctd"><?= $c->empid; ?></td>
		<td class="  ctd"><?= $c->firstname; ?></td>
		<td class="  ctd"><?= $c->middlename; ?></td>
		<td class="  ctd"><?= $c->lastname; ?></td>
		<td class="  ctd email-text"><?= $c->email; ?></td>
		<td class="  ctd"><?= $c->jobs; ?></td>
		<td class="  ctd"><?= $c->last_promotion_date; ?></td>
		<td class="  ctd"><?= $c->territories; ?></td>
		<td class="  ctd"><?= $c->roles; ?></td>
		<td class="  ctd">
			<input type="checkbox" onClick="return false;" name="<?= $c->user_id; ?>" value="<?= $c->status; ?>" <?= $check ?> disabled>
		</td>
		<td class="ctd"><a  title='View' data-toggle='tooltip' data-placement='right'>
        <span class='user-edit-icon glyphicon glyphicon-pencil' data-id="<?= $c->user_id; ?>" aria-hidden='true'></span>
        </td>
	</tr>

<?php } ?>

