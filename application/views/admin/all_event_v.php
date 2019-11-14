<table class="luft-table">
  	<thead>
  		<th class="luft-user-id"><?php echo get_msg('ordernumber') ?> <img src='assets/image/filter.png' alt="filter" class="filter-img" /> </th>
  		<th><?php echo get_msg( 'event' ); ?><img src='assets/image/filter.png' alt="filter" class="filter-img" /></th>
  		<th><?php echo get_msg( 'date' ); ?><img src='assets/image/filter.png' alt="filter" class="filter-img" /></th>
  		<th><?php echo get_msg( 'city' ); ?><img src='assets/image/filter.png' alt="filter" class="filter-img" /></th>
  		<th><?php echo get_msg( 'eventime' ); ?><img src='assets/image/filter.png' alt="filter" class="filter-img" /></th>
  		<th><?php echo get_msg( 'total_workingtime' ); ?><img src='assets/image/filter.png' alt="filter" class="filter-img" /></th>
  		<th><?php echo get_msg( 'finished' ) ?></th>
  	</thead>
  	<tbody>
  		<?php //echo "<pre>"; ?>
  		<?php //var_export( $events ); ?>
  			<?php foreach ($events as $event) { ?>
  			<tr>
  				<td><?php echo $event->order_number ?></td>
  				<td><?php echo $event->name ?></td>
  				<td><?php echo $event->start_time ?></td>
  				<td>Kathmandu</td>
  				<td></td>
  				<td></td>
  				<td>
  					<a href="<?php echo $event->id; ?>"  class="luft-user-edit" ><i class="far fa-edit"></i></a>
  					<?php echo form_checkbox( array(
  						'name' => 'event_status',
  						'id'   => 'event_status',
  						'checked' => false
  					) ); ?>
  				</td>
  			</tr>
  			<?php } ?>
  	</tbody>
</table>