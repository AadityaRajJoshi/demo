<div class="luft-login-box">
	<div class="luft-logo-wrapper">
		<img src="<?php echo base_url();  ?>assets/image/logo.png" alt="luftlek-logo" />
	</div>

	<?php if( $this->session->flashdata( 'login_error' ) ): ?> 
		<span class="form-err"><?php echo $this->session->flashdata( 'login_error' ); ?> </span> 
	<?php endif; ?>

	<?php echo form_open( 'user/login' ); ?>

		<div class="luft-form-row luft-input-type">
			<?php echo form_label(get_msg( 'label_username' ), 'username');
			echo form_input( array(
				'name' => 'username',
				'placeholder' => get_msg( 'placeholder_username' ),
				'id' => 'username',
				'required' => 'required',
				'value' => isset( $cookie[ 'name' ] ) ? $cookie[ 'name' ] : ''
			) ); ?>
		</div>

		<div class="luft-form-row luft-input-type">
			<?php 
				echo form_label(get_msg('label_password'), 'password');
				echo form_password( array(
					'name' => 'password',
					'placeholder' => get_msg( 'placeholder_password' ),
					'id' => 'password',
					'autocomplete' => 'off',
					'required' => 'required',
					'value' => isset( $cookie[ 'pass' ] ) ? $cookie[ 'pass' ] : ''
				) );
			?>
		</div>
		
		<div class="luft-submit-wrapper">
			<label class="luft-form-row luft-checkbox-type">
				<?php 
					echo form_checkbox(array(
						'name' => 'remember_me',
						'id'   => 'remember_me',
						'value' => 'on',
						'checked' => isset( $cookie[ 'pass' ] ) ? true : false
					));  
					echo get_msg('remember'); 
				?>
				<span class="checkmark"></span>
			</label>	
			
			<div class="luft-forget-password display-on-mobile">
				<a href="<?php echo get_route('forgot'); ?>"><img src="assets/image/lock.png" alt="lock" /><span> <?php echo get_msg( 'forget_pass' ) ?> <span></a>
			</div>

			<div class="luft-form-row luft-submit-type">
				<?php echo form_submit('login', get_msg( 'login' )); ?>
			</div>	
		</div>	
	<?php echo form_close( '' ); ?> 

	<div class="luft-forget-password display-on-desktop">
		<a href="<?php echo get_route('forgot'); ?>"> 
			<img src="assets/image/lock.png" alt="lock" /> 
			<span><?php echo get_msg( 'forget_pass' ) ?><span>
		</a>
	</div>
</div>