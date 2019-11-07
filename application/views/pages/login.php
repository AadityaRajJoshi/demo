<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	 <?php
		 if( $this->session->flashdata( 'login_error' ) ){
			 echo $this->session->flashdata( 'login_error' );
		 }
	 ?>
	<?php echo form_open( 'login/login_attempt' );
		echo form_label('User Name', 'username');
		echo form_input( array(
			'name' => 'username',
			'placeholder' => 'Enter Username Or Email',
			'id' => 'username',
		) );

		echo form_label('Password', 'password');
		echo form_password( array(
			'name' => 'password',
			'placeholder' => 'Enter Password',
			'id' => 'password',
			'autocomplete' => 'off'
		) );

		echo form_checkbox( array(
			'name' => 'remember_me',
			'id'   => 'remember_me'
		) );
		echo form_label( 'Remember Me', 'remember_me');

		echo form_submit('login', 'Login');
	echo form_close( '' ); ?>
	<a href="#">Forget Password</a>
</body>
</html>