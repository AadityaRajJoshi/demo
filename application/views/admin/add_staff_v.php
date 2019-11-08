<?php
	echo form_open( 'staff/add' );
	echo form_label( 'Name', 'name' );
	echo form_input( array(
		'name' => 'name',
		'placeholder' => 'Enter name',
		'id' => 'name',
	) );

	echo form_label( 'Email', 'email' );
	echo form_input( array(
		'name' => 'email',
		'placeholder' => 'Enter email',
		'id' => 'email',
	) );

	echo form_label( 'Number', 'number' );
	echo form_input( array(
		'name' => 'number',
		'placeholder' => 'Enter Phone Number',
		'id' => 'phone',
	) );

	echo form_label( 'Password', 'password' );
	echo form_password( array(
		'name' => 'password',
		'id' => 'password',
	) );

	echo form_label( 'Display Name', 'displayname');
	echo form_input( array(
		'name' => 'displayname',
		'placeholder' => 'Enter display Name',
		'id' => 'displayname',
	) );

	echo form_submit( 'add', 'Add Staff' );
	echo form_close( '' );
?>
