<div class="luft-login-box">
	<?php echo form_open( 'forgot' ); ?>

	<div class="luft-form-row luft-input-type">
		<?php echo form_label(get_msg( 'label_email' ), 'email');
		echo form_input( array(
			'name' => 'email',
			'placeholder' => get_msg( 'placeholder_find_email' ),
			'id' => 'email',
			'required' => 'required',
		) ); ?>
	</div>

	<div class="luft-submit-wrapper">
		<div class="luft-form-row luft-submit-type">
			<?php echo form_submit('change_pass', get_msg( 'change_pass' )); ?>
		</div>	
	</div>

	<?php echo form_close( '' ); ?>
</div>