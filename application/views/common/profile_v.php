<?php echo form_open_multipart(); ?>
	<?php if( 'own' == $mode ): ?>
		<div class="luft-profile-image">
			<?php if(isset($profile_picture)){?>

				<img src="<?php echo $profile_picture; ?>" alt="profile picture" id="uploaded-image" />
			<?php }else{?>
				<img src="assets/image/placeholder.jpg" alt="profile picture" id="uploaded-image"  />
			<?php } ?>				
			
		</div>
		
		<div class="luft-form-row-file">
			<label for="profile-image"><?php echo get_msg( 'upload_pp' ); ?></label>
			<input type="file" name="userfile" size="20" id="profile-image" accept=".png, .jpg, .jpeg" />
		</div>
	<?php endif; ?>

	<div class="luft-form-wrapper">
		<div class="luft-form-row">
			<?php 
				echo form_label(get_msg('label_username'), 'username');
				echo form_input(array(
					'name' => 'username',
					'value'=> get_value($user, 'username'),
					'placeholder' => get_msg('placeholder_name'),
					'id' => 'username',
				)); 
			?>
		</div>

		<div class="luft-form-row">
			<?php 
				echo form_label(get_msg('label_name'), 'name');
				echo form_input(array(
					'name' => 'name',
					'value'=> get_value($user, 'name'),
					'placeholder' => get_msg('placeholder_name'),
					'id' => 'name',
				)); 
			?>
		</div>

		<div class="luft-inline-input">
			<div class="luft-form-row">
				<?php 
					echo form_label(get_msg('label_email'), 'email');
					echo form_input(array(
						'name' => 'email',
						'value' => get_value($user, 'email'),
						'placeholder' => get_msg('placeholder_email'),
						'id' => 'email',
						'type' => 'email'
					)); 
				?>
			</div>

			<div class="luft-form-row">
				<?php 
					echo form_label( get_msg( 'label_phone_number' ), 'phone_number' );
					echo form_input( array(
						'name' => 'phone_number',
						'type'=>'tel',
						'value' => get_value($user, 'phone_number'),
						'placeholder' => get_msg( 'placeholder_phone_number' ),
						'id' => 'phone',
					)); 
				?>
			</div>
			
			<div class="luft-form-row">
				<?php 
					echo form_label( get_msg( 'label_password' ), 'password' );
					echo form_password( array(
						'name' => 'password',
						'placeholder' => get_msg( 'placeholder_password' ),
						'id' => 'password',
					)); 
				?>
			</div>
		</div>	
	

		<?php 
			$btn_txt = 'own' == $mode ? 'save_details':'update_staff';
			if($user){
				echo form_hidden('id', $user->id);
			}else{
				$btn_txt = 'add_staff';
			}

			echo form_hidden('mode', $mode);
			echo form_submit('update', get_msg($btn_txt));
			?>
	</div>
<?php echo form_close( '' ); ?>

<?php if( $mode == 'other' &&  $events  ) : ?>
	<div class="user-detail-table-wrapper">

		<h2><?php echo get_msg( 'staff_card' ); ?></h2>	

		<div class="user-table-content">

			<div class="filter-by-date">
				<span>	
					<i class="fas fa-angle-up"></i>	
					<input type="text" name="daterange" />
					<i class="fas fa-angle-down"></i>
				</span>
			</div>


			<table class="luft-table luft-view-mobile">
				<thead>
					
					<th class="luft-event-name staff-profile-th"><?php thead('event','name', $segment); ?></th>
					<th class="luft-event-type staff-profile-th hide-on-mobile"><?php echo get_msg('type','type', $segment) ?></th>						
					<th class="luft-event-date staff-profile-th"><?php thead('date', 'start_time', $segment); ?></th>
					<th class="luft-event-city staff-profile-th hide-on-mobile"><?php thead('city','city', $segment); ?></th>					
					<th class="luft-working-time staff-profile-th"><?php thead('hour', 'total_worktime', $segment); ?></th>
					<!-- <th class="display-on-mobile staff-profile-extend"></th> -->
				</thead>
				<tbody>
					<?php $sum=0; foreach ($events as $event): $sum += $event->total_worktime; ?>
						<tr>						
							<td class="profile-td">
								<?php if( is_admin() ): ?>
								<a href="<?php echo get_route('event_detail'). $event->id?>">
									<?php echo $event->name ?>
								</a>
								<?php else:
									echo $event->name;
								endif; ?>				
							</td>
							<td class="hide-on-mobile"><?php echo get_staff_type( $event->type ); ?></td>
							<td class="profile-td"><?php echo  get_date_from_datetime( $event->start_time, 'd M Y' ); ?></td>
							<td class="hide-on-mobile"><?php echo $event->city ?></td>				
							<td class="profile-td"><?php echo seconds_to_time( $event->total_worktime );?></td>
							<td class="staff-profile-extend display-on-mobile"> <a href="#" class="luft-extend-table display-on-mobile" ><span class="plus-minus"></span></a></td>

							<td class="extend-data">        
								<div> 
									<span> <?php echo get_msg( 'type' ) ?> </span> <span> <?php echo get_staff_type( $event->type ); ?> </span> 
								</div>
								<div> 
									<span> <?php echo get_msg( 'city' ) ?> </span> <span> <?php echo $event->city ?> </span> 
								</div>
							</td>

						</tr>
					<?php  endforeach; ?>
					<tr class="staff-total-time hide-on-mobile">
						<td colspan="3"></td>
						<td><b><?php echo get_msg( 'summa' ); ?></b></td>
						<td><?php echo seconds_to_time( $sum ); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<?php endif; ?>
<div class="display-on-mobile">
	<a href="<?php echo $mode == 'add' ? get_route('dashboard') : get_route('staff')?>"  class="go-back-btn"> <?php echo get_msg( 'go_back' ) ?> </a>
</div>