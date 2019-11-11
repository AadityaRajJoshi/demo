<?php
	echo form_open( $action );
    echo $confirm;

	echo form_hidden('id', $id);
	echo form_submit('yes','Yes');?>
	<a href="staff"><?php echo form_button('no','No');  ?> </a>
	
	<?php echo form_close( '' );