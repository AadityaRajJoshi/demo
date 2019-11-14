<?php echo form_open_multipart(); ?>

<?php if( 'own' == $mode ): ?>
	
	<div class="luft-profile-image">
		<?php if(isset($profile_picture)): ?>				
			<img src="<?php echo $profile_picture; ?>" alt="profile picture" />
		<?php endif; ?>
	</div>
	<div class="luft-form-row-file">
		<label for="profile-image">Upload profile picture</label>
		<input type="file" name="userfile" size="20" id="profile-image" />
	</div>
<?php endif; ?>

	<div class="luft-form-wrapper">
		<div class="luft-form-row"  >
			<?php echo form_label( get_msg('name'), 'name' );
				echo form_input( array(
				'name' => 'name',
				'value'=> $user->username,
				'placeholder' => get_msg( 'name_placeholder' ),
				'id' => 'name',
			) ); 
			?>
		</div>
		<div class="luft-inline-input">
		<div class="luft-form-row">
			<?php 
			echo form_label( get_msg( 'email' ), 'email' );
			echo form_input( array(
				'name' => 'email',
				'value' => $user->email,
				'placeholder' => get_msg( 'email_placeholder' ),
				'id' => 'email',
				'type' => 'email',
			) ); ?>
	    </div>

		<div class="luft-form-row">
			<?php echo form_label( get_msg( 'number' ), 'number' );
			echo form_input( array(
				'name' => 'number',
				'type'=>'tel',
				'value' => $user->phone_number,
				'placeholder' => get_msg( 'number_placeholder' ),
				'id' => 'phone',
			) ); ?>
		</div>
		
		<div class="luft-form-row">
			<?php echo form_label( get_msg( 'password' ), 'password' );
			echo form_password( array(
				'name' => 'password',
				'placeholder' => get_msg( 'password_placeholder' ),
				'id' => 'password',
			) ); ?>
		</div>
	</div>	
	<?php 
	echo form_hidden('id', $user->id);
	echo form_hidden('mode', $mode);
	
	$btn_txt = 'own' == $mode ? 'save_details':'update_staff';
	echo form_submit('update', get_msg($btn_txt));

	echo form_close( '' );
?>
