<?php echo form_open( 'user/update' ); ?>

	<div class="luft-form-wrapper">
		<div class="luft-form-row">
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
	

	if( is_admin() ){
		if( $mode == 'own' ){
			echo form_submit( 'update', get_msg( 'save_details' ) );
		}else{
			echo form_submit( 'update', get_msg( 'update_staff' ) );
		}
	}

	if( is_staff() ){
		echo form_submit( 'update', get_msg( 'save_details' ) );	
	}

	echo form_close( '' );
?>
