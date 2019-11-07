<?php
	echo form_open( 'staff/update' );
	echo form_label( 'Name', 'name' );

	foreach ($staff as $staff) {		
		echo form_input( array(
			'name' => 'name',
			'value'=> $staff->username,
			'placeholder' => 'Enter name',
			'id' => 'name',
		) );

		echo form_label( 'Email', 'email' );
		echo form_input( array(
		'name' => 'email',
		'value' => $staff->email,
		'placeholder' => 'Enter email',
		'id' => 'email',
		) );

		echo form_label( 'Number', 'number' );
		echo form_input( array(
			'name' => 'number',
			'type'=>'tel',
			'value' => $staff->phone_number,
			'placeholder' => 'Enter Phone Number',
			'id' => 'phone',
		) );

		echo form_label( 'Display Name', 'displayname');
		echo form_input( array(
			'name' => 'displayname',
			'value' => $staff->display_name,
			'placeholder' => 'Enter display Name',
			'id' => 'displayname',
		) );

		echo form_hidden('id', $staff->id);
	}
	
	echo form_submit( 'update', 'Update Staff' );
	echo form_close( '' );
	 ?>
