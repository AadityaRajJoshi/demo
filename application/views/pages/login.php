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
	 <?php 
		 $cookie= get_cookie( 'remember_me' );  
		  var_dump($cookie);
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
			'name'  => 'remember',
			'id'    => 'remember',
			'value' => 'true'
		) );
		echo form_label( 'Remember Me', 'remember');

		echo form_submit('login', 'Login');
	echo form_close( '' ); ?>
	<a href="#">Forget Password</a>
</body>
</html>