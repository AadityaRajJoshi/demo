<!DOCTYPE html>
<html>
<head>
	<title>list Staff</title>
</head>
<body>
	<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Total Workingtime</th>
    <th>Edit</th>
  </tr>

  <tr>
  	<?php foreach ($staffs as $staff) {?>
    <td><?php echo $staff->id; ?></td>
    <td><?php echo $staff->username; ?></td>
    <td></td>
    <td><a href="<?php echo base_url(); ?>index.php/user/edit/<?php echo $staff->id; ?>"  >Edit</a> <a href="" >delete</a></td>
  </tr>
  	<?php } ?>
  
</table>
</body>
</html>
