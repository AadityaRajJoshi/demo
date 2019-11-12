<?php
	echo form_open( 'staff/add' ); ?>
	<div class="luft-form-wrapper">
		<div class="luft-form-row">
			<?php echo form_label( get_msg( 'name' ), 'name' ); 
			echo form_input( array(
				'name' => 'name',
				'placeholder' => get_msg( 'name_placeholder' ),
				'id' => 'name',
				'required' => 'required'
			) ); ?>
		</div> 
		<div class="luft-inline-input">
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg( 'email' ), 'email' );
				echo form_input( array(
					'name' => 'email',
					'placeholder' => get_msg( 'email_placeholder' ),
					'id' => 'email',
					'required' => 'required',
					'type' => 'email'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg( 'number' ), 'number' );
				echo form_input( array(
					'name' => 'number',
					'placeholder' => get_msg( 'number_placeholder' ),
					'id' => 'phone',
					'required' => 'required',
					'type' => 'tel'
				) ); ?>
			</div>

			<div class="luft-form-row">
			<?php echo form_label( get_msg( 'password' ), 'password' );
				echo form_password( array(
					'name' => 'password',
					'id' => 'password',
					'required' => 'required',
					'placeholder' => get_msg( 'password_placeholder' ),
				) ); ?>
			</div>
			
		</div>
		<?php
			echo form_submit( 'add', 'Add Staff' ); ?>
	</div>
	<?php
	echo form_close( '' );
?>
