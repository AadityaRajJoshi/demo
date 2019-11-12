<?php
	echo form_open( 'user/update' ); ?>

	<div class="luft-form-wrapper">
		<div class="luft-form-row">
			<?php echo form_label( 'Name', 'name' );
				echo form_input( array(
				'name' => 'name',
				'value'=> $user->username,
				'placeholder' => 'Enter name',
				'id' => 'name',
			) ); 
			?>
		</div>
		<div class="luft-inline-input">
		<div class="luft-form-row">
			<?php 
			echo form_label( 'Email', 'email' );
			echo form_input( array(
				'name' => 'email',
				'value' => $user->email,
				'placeholder' => 'Enter email',
				'id' => 'email',
				'type' => 'email',
			) ); ?>
	    </div>

		<div class="luft-form-row">
			<?php echo form_label( 'Number', 'number' );
			echo form_input( array(
				'name' => 'number',
				'type'=>'tel',
				'value' => $user->phone_number,
				'placeholder' => 'Enter Phone Number',
				'id' => 'phone',
			) ); ?>
		</div>
		
		<div class="luft-form-row">
			<?php echo form_label( 'Password', 'password' );
			echo form_password( array(
				'name' => 'password',
				'placeholder' => 'Enter Password',
				'id' => 'password',
			) ); ?>
		</div>
	</div>	
	<?php 
	echo form_hidden('id', $user->id);
	
	if( is_admin() ){
		echo form_submit( 'update', 'Update Staff' );	
	}

	if( is_staff() ){
		echo form_submit( 'update', 'Update Details' );	
	}
	echo form_close( '' );
?>
