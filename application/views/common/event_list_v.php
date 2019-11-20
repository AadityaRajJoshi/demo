<table class="luft-table">
  	<thead>
  		<th class="luft-event-id hide-on-mobile"><?php thead('order_number'); ?></th>
  		<th class="luft-event-name"><?php thead('event', 'name'); ?></th>
  		<th class="luft-event-date"><?php thead('date', 'start_time'); ?></th>
  		<th class="luft-event-city"><?php thead('city'); ?></th>
  		<th class="luft-event-time"><?php echo get_msg( 'eventime' ); ?></th>
  		<th class="luft-working-time"><?php thead( 'total_worktime' ); ?></th>
  		<th class="luft-event-status"><?php echo is_admin() ? get_msg('finished') : '' ?></th>
  	</thead>
  	<tbody>

		<?php foreach ($events as $event) { ?>
		<tr>
			<td class="hide-on-mobile"><?php echo $event->order_number ?></td>
			<td>
				<?php if( is_admin() ): ?>
				<a href="<?php echo get_route('event_detail'). $event->id?>"><?php echo $event->name ?></a>
				<?php else:
					echo $event->name;
				endif; ?>				
			</td>
			<td><?php echo  get_date_from_datetime( $event->start_time, 'd M Y' ); ?></td>
			<td class="hide-on-mobile"><?php echo $event->city ?></td>
			<td class="hide-on-mobile" >
				<?php echo get_start_end_time($event->start_time,$event->stop_time); ?>							
			</td>
			<td class="hide-on-mobile" ><?php echo seconds_to_time( $event->total_worktime );?></td>
			<td class="d-flex-center right-text">
			<?php if( is_admin() ) : ?>
					<a href="<?php echo get_route('event_edit').'/'. $event->id; ?>"  class="luft-user-edit" ><i class="far fa-edit"></i></a>
				<div class="onoffswitch">
					<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-<?php echo $event->id ?>"<?php echo $event->finished ? 'checked' : '' ?> data-id = <?php echo $event->id ?> >
					<label class="onoffswitch-label" for="switch-<?php echo $event->id ?>">
						<span class="onoffswitch-inner"></span>
						<span class="onoffswitch-switch"></span>
					</label>
				</div>
			<?php else: ?>
				<a class="luft-view-more" href="<?php echo get_route( 'event_detail' ) . $event->id ?>"><?php echo get_msg( 'more_event' ); ?></a>
			<?php endif; ?>
			</td>
		</tr>
		<?php } ?>
  	</tbody>
</table>