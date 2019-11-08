<?php
	echo form_open( 'staff/delete' );
	echo form_label( 'Are You sure want to delete?', 'delete' );
	echo form_button('yes','Yes');
	echo form_button('no','No');
	echo form_close( '' );