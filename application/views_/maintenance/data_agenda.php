<?php foreach($results as $result): ?>

  <tr>

    <td><?php echo $result->agenda_maintenance_name; ?></td>

    <td><?php echo $result->cat_maintenance_name; ?></td>

    <td>
      
      <?php if($result->is_active == 1): ?>
      
        <input type="checkbox" name="isactive" value="" checked disabled >
      
      <?php elseif($result->is_active == 0): ?>
        
        <input type="checkbox" name="isactive" value="" disabled >

      <?php endif; ?>

    </td>

    <td>

      <a  title='View' data-toggle='tooltip' data-placement='right'>

        <span class='agenda-edit-icon glyphicon glyphicon-pencil' data-id="<?php echo $result->agenda_maintenance_id; ?>" aria-hidden='true'></span>

      </a>

    </td>

  </tr>

<?php endforeach; ?>