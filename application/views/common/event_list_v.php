<table class="luft-table luft-view-mobile">
  	<thead>
  		<th class="luft-event-id hide-on-mobile"><?php thead('order_number'); ?></th>
  		<th class="luft-event-name"><?php thead('event', 'name'); ?></th>
  		<th class="luft-event-date"><?php thead('date', 'start_time'); ?></th>
  		<th class="luft-event-city hide-on-mobile"><?php thead('city'); ?></th>
  		<th class="luft-event-time hide-on-mobile"><?php echo get_msg( 'eventime' ); ?></th>
  		<th class="luft-working-time hide-on-mobile"><?php thead( 'total_worktime' ); ?></th>
  		<th class="luft-event-status"><?php echo is_admin() ? get_msg('finished') : '' ?></th>
  	</thead>
  	<tbody>

		<?php foreach ($events as $event) { ?>
		<tr>
			<td class="hide-on-mobile"><?php echo $event->order_number ?></td>
			<td class="luft-event-name">
				<?php if( is_admin() ): ?>
				<a href="<?php echo get_route('event_detail'). $event->id?>"><?php echo $event->name ?></a>
				<?php else:
					echo $event->name;
				endif; ?>				
			</td>
			<td class="luft-event-date"><?php echo  get_date_from_datetime( $event->start_time, 'd M Y' ); ?></td>
			<td class="hide-on-mobile"><?php echo $event->city ?></td>
			<td class="hide-on-mobile">
				<?php echo get_start_end_time($event->start_time,$event->stop_time); ?>							
			</td>
			<td class="hide-on-mobile"><?php echo seconds_to_time( $event->total_worktime );?></td>
			<td class="d-flex-center right-text">
			<?php if( is_admin() ) : ?>
					<a href="<?php echo get_route('event_edit').'/'. $event->id; ?>"  class="luft-user-edit hide-on-mobile" ><i class="far fa-edit"></i></a>
				<div class="onoffswitch">
					<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-<?php echo $event->id ?>"<?php echo $event->finished ? 'checked' : '' ?> data-id = <?php echo $event->id ?> >
					<label class="onoffswitch-label" for="switch-<?php echo $event->id ?>">
						<span class="onoffswitch-inner"></span>
						<span class="onoffswitch-switch"></span>
					</label>
				</div>

				<a href="#" class="luft-extend-table display-on-mobile" ><span class="plus-minus"></span></a>
			<?php else: ?>
				<a class="luft-view-more" href="<?php echo get_route( 'event_detail' ) . $event->id ?>"><?php echo get_msg( 'more_event' ); ?></a>
			<?php endif; ?>
			</td>

			<td class="extend-data">
				<div> <span> <?php echo get_msg( 'eventime' ); ?> </span> <span> <?php echo get_start_end_time($event->start_time,$event->stop_time); ?>	</span> </div>
				<div> <span> Total working hour </span> <span> <?php echo seconds_to_time( $event->total_worktime );?>	</span> </div>
				<div> <span> City </span> <span> <?php echo $event->city ?>	</span> </div>
				<div>
					<?php if( is_admin() ) : ?>
						<a href="<?php echo get_route('event_edit').'/'. $event->id; ?>"  class="luft-user-edit-btn" >Edit</a> 
					<?php endif; ?>
				</div>

			</td>
			
		</tr>
		
		<?php } ?>
  	</tbody>
</table>