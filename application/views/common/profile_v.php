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
			<label for="profile-image">Upload profile picture</label>
			<input type="file" name="userfile" size="20" id="profile-image" accept=".png, .jpg, .jpeg" />
		</div>
	<?php endif; ?>

	<div class="luft-form-wrapper">
		<div class="luft-form-row">
			<?php 
				echo form_label(get_msg('label_name'), 'username');
				echo form_input(array(
					'name' => 'username',
					'value'=> get_value($user, 'username'),
					'placeholder' => get_msg('placeholder_name'),
					'id' => 'username',
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
						'type' => 'email',
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
		<div>	
		<?php 
		echo form_dropdown( array(
			'name' => 'date',
			'id' => 'eventDate',
			'class' => 'custom-styled-select',
		), $date );?> 
		</div>
		<div class="user-table-content">
				<table class="luft-table">
					<thead>
						
						<th class="luft-event-name staff-profile-th"><?php thead('event', 'name'); ?></th>
						<th class="luft-event-type staff-profile-th"><?php echo "Type" ?></th>
						
						<th class="luft-event-date staff-profile-th"><?php thead('date', 'start_time'); ?></th>
						<th class="luft-event-city staff-profile-th"><?php thead('city'); ?></th>					
						<th class="luft-working-time staff-profile-th"><?php thead('hour', 'total_worktime'); ?></th>
						
					</thead>
					<tbody>
						<?php foreach ($events as $event) : ?>
						<tr>						
							<td>
								<?php if( is_admin() ): ?>
								<a href="<?php echo get_route('event_detail'). $event->id?>"><?php echo $event->name ?></a>
								<?php else:
									echo $event->name;
								endif; ?>				
							</td>
							<td><?php echo $event->type ?></td>
							<td><?php echo  get_date_from_datetime( $event->start_time, 'd M Y' ); ?></td>
							<td class="hide-on-mobile"><?php echo $event->city ?></td>				
							<td class="hide-on-mobile" ><?php echo seconds_to_time( $event->total_worktime );?></td>
						</tr>
						<?php endforeach; ?>
						<tr class="staff-total-time">
							<td colspan="3"></td>
							<td><b><?php echo get_msg( 'summa' ); ?></b></td>
							<td><?php echo $total_worktime ?></td>
						</tr>
					</tbody>
				</table>
		</div>
	</div>
<?php endif; ?>
<div class="display-on-mobile">
	<a href="#"  class="go-back-btn"> <?php echo get_msg( 'go_back' ) ?> </a>
</div>