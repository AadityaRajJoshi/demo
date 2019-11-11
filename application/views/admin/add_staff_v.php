<?php
	echo form_open( 'staff/add' ); ?>
	<div class="luft-form-wrapper">
		<div class="luft-form-row">
			<?php echo form_label( 'Name', 'name' ); 
			echo form_input( array(
				'name' => 'name',
				'placeholder' => 'Enter name',
				'id' => 'name',
				'required' => 'required'
			) ); ?>
		</div> 
		<div class="luft-inline-input">
			<div class="luft-form-row">
				<?php
				echo form_label( 'Email', 'email' );
				echo form_input( array(
					'name' => 'email',
					'placeholder' => 'Enter email',
					'id' => 'email',
					'required' => 'required',
					'type' => 'email'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'Number', 'number' );
				echo form_input( array(
					'name' => 'number',
					'placeholder' => 'Enter Phone Number',
					'id' => 'phone',
					'required' => 'required',
					'type' => 'tel'
				) ); ?>
			</div>

			<div class="luft-form-row">
			<?php echo form_label( 'Password', 'password' );
				echo form_password( array(
					'name' => 'password',
					'id' => 'password',
					'required' => 'required',
					'placeholder' => 'Enter Password',
				) ); ?>
			</div>
			
		</div>
		<?php
			echo form_submit( 'add', 'Add Staff' ); ?>
	</div>
	<?php
	echo form_close( '' );
?>
