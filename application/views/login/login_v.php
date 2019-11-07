<div class="luft-login-box">
	<div class="luft-logo-wrapper">
		<img src="<?php echo base_url();  ?>assets/image/logo.png" alt="luftlek-logo" />
	</div>

	<?php
		if( $this->session->flashdata( 'login_error' ) ){
			?> <span class="form-err"> <?php echo $this->session->flashdata( 'login_error' ); ?> </span> <?php 
		}
	?>

	<?php echo form_open( 'login/login_attempt' ); ?>

		<div class="luft-form-row luft-input-type">
			<?php echo form_label('User Name', 'username');
			echo form_input( array(
				'name' => 'username',
				'placeholder' => 'Enter Username Or Email',
				'id' => 'username',
				'required' => 'required'
			) ); ?>
		</div>

		<div class="luft-form-row luft-input-type">
			<?php echo form_label('Password', 'password');
			echo form_password( array(
				'name' => 'password',
				'placeholder' => 'Enter Password',
				'id' => 'password',
				'autocomplete' => 'off',
				'required' => 'required',
				'minlength'=> '6'
			) );

			?>
		</div>
		
		<div class="luft-submit-wrapper">
			<label class="luft-form-row luft-checkbox-type">
				<?php echo form_checkbox( array(
					'name' => 'remember_me',
					'id'   => 'remember_me',
					'value' => 'on'
				) ); ?>
				Remember Me
				<!-- <?php echo form_label( 'Remember Me', 'remember_me'); ?> -->
				<span class="checkmark"></span>
			</label>	
			
			<div class="luft-forget-password display-on-mobile">
				<a href="#"> <img src="<?php echo base_url();  ?>assets/image/lock.png" alt="lock" /> <span> Forget Password <span></a>
			</div>

			<div class="luft-form-row luft-submit-type">
				<?php echo form_submit('login', 'Log in'); ?>
			</div>	
		</div>	
	<?php echo form_close( '' ); ?> 

	<div class="luft-forget-password display-on-desktop">
		<a href="forgot"> <img src="<?php echo base_url();  ?>assets/image/lock.png" alt="lock" /> <span> Forget Password <span></a>
	</div>
</div>