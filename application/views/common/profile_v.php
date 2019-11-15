<?php echo form_open_multipart(); ?>

<?php if( 'own' == $mode ): ?>
	<div class="luft-profile-image">
		<?php if(isset($profile_picture)): ?>				
			<img src="<?php echo $profile_picture; ?>" alt="profile picture" id="uploaded-image" accept=".png, .jpg, .jpeg" />
		<?php endif; ?>
	</div>
	<div class="luft-form-row-file">
		<label for="profile-image">Upload profile picture</label>
		<input type="file" name="userfile" size="20" id="profile-image" />
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
		echo form_close( '' );
	?>
