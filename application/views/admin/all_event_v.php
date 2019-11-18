<table class="luft-table">
  	<thead>
  		<th class="luft-event-id"><?php thead('order_number'); ?></th>
  		<th class="luft-event-name"><?php thead('event', 'name'); ?></th>
  		<th class="luft-event-date"><?php thead('date', 'start_time'); ?></th>
  		<th class="luft-event-city"><?php echo get_msg( 'city' ); ?> <img src='assets/image/filter.png' alt="filter" class="filter-img" /></th>
  		<th class="luft-event-time"><?php echo get_msg( 'eventime' ); ?> <img src='assets/image/filter.png' alt="filter" class="filter-img" /></th>
  		<th class="luft-working-time"><?php thead( 'total_worktime' ); ?></th>
  		<th class="luft-event-status"><?php echo get_msg( 'finished' ) ?></th>
  	</thead>
  	<tbody>

		<?php foreach ($events as $event) { ?>
		<tr>
			<td><?php echo $event->order_number ?></td>
			<td><a href="<?php echo get_route('event_detail'). $event->id?>"><?php echo $event->name ?></a></td>
			<td><?php echo  get_date_from_datetime( $event->start_time, 'd M Y' ); ?></td>
			<td>Kathmandu</td>
			<td>
				<?php echo get_time_from_datetime( $event->start_time ) . ' - ' . get_time_from_datetime(  $event->stop_time )  ?>							
			</td>
			<td><?php echo seconds_to_time( $event->total_worktime );?></td>
			<td class="d-flex-center right-text">
				<a href="<?php echo get_route('event_edit').'/'. $event->id; ?>"  class="luft-user-edit" ><i class="far fa-edit"></i></a>
			<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-<?php echo $event->id ?>"<?php echo $event->finished ? 'checked' : '' ?> data-id = <?php echo $event->id ?> >
				<label class="onoffswitch-label" for="switch-<?php echo $event->id ?>">
					<span class="onoffswitch-inner"></span>
					<span class="onoffswitch-switch"></span>
				</label>
			</div>
			</td>
		</tr>
		<?php } ?>
  	</tbody>
</table>