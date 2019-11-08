<?php
	echo form_open( 'staff/delete' );
	var_dump($confirm);
	// echo form_label( 'Are You sure want to delete?', 'delete' );
	echo form_submit('yes','Yes');
	echo form_button('no','No');

	echo form_close( '' );