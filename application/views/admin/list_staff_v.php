
	<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Total Workingtime</th>
    <th>Edit</th>
  </tr>

  <tr>
  	<?php foreach ($staffs as $key => $staff) {?>
    <td><?php echo $key+1; ?></td>
    <td><?php echo $staff->username; ?></td>
    <td></td>
    <td><a href="staff/edit/<?php echo $staff->id; ?>"  >Edit</a> | <a href="staff/delete/<?php echo $staff->id; ?>" >delete</a></td>
  </tr>
  	<?php } ?>
  
</table>

