
	<table class="luft-table">
  <thead>
    <tr>
      <th class="luft-user-id">ID <img src='assets/image/filter.png' alt="filter" class="filter-img" /> </th>
      <th>Name <img src='assets/image/filter.png' alt="filter" class="filter-img" /></th>
      <th>Total Workingtime</th>
      <th class="luft-update-download"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php foreach ($staffs as $key => $staff) {?>
      <td><?php echo $key+1; ?></td>
      <td><?php echo $staff->username; ?></td>
      <td>15hrs</td>
      <td class="luft-text-right"><a href="staff/edit/<?php echo $staff->id; ?>"  class="luft-user-edit" ><i class="far fa-edit"></i></a>  <a href="#" class="luft-user-download"><i class="fas fa-file-pdf"></i></a> </td>
     
    </tr>
  	<?php } ?>
  </tbody>
</table>

