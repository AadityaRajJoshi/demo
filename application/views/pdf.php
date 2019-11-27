<img src="">
<p style="font-size:10px;">Name : <b><?php echo ucfirst($user->name); ?></b></p>
<p style="font-size:10px;">Email : <b><?php echo $user->email; ?></b></p>
<p style="font-size:10px;">Number : <b><?php echo $user->phone_number; ?></b></p>
<table border="1" style="padding: 5px; font-size: 10px; border-color: #efefef;">
   <thead>
		<tr>
			<th><b><?php echo get_msg('event'); ?></b></th>
			<th><b><?php echo get_msg('type'); ?></b></th>
			<th><b><?php echo get_msg('date'); ?></b></th>
			<th><b><?php echo get_msg('city'); ?></b></th>
			<th><b><?php echo get_msg('hour'); ?></b></th>
		</tr>
   </thead>
   <tbody>
   	<?php $total=0; foreach ($events as $event): $total = $total + $event->total_worktime; ?>
		<tr>
			<td><?php echo $event->name; ?></td>
			<td><?php echo get_staff_type( $event->type ); ?></td>
			<td><?php echo get_date_from_datetime( $event->start_time, 'd M Y' ); ?></td>
			<td><?php echo $event->city; ?></td>
			<td><?php echo seconds_to_time( $event->total_worktime ); ?></td>		         
		</tr>
   	<?php endforeach; ?>
   		<tr>
			<td colspan="3"></td>
			<td><b>Summa</b></td>
			<td><?php echo seconds_to_time($total); ?></td>
		</tr>
   </tbody>
</table>