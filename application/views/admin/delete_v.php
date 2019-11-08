<?php
	echo form_open( 'staff/delete' );
	echo $confirm;
	echo form_submit('yes','Yes');
	echo form_button('no','No');

	echo form_close( '' );