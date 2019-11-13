<?php
	echo form_open( 'event/add' ); ?>
	<div class="luft-form-wrapper">
		<div class="luft-form-row">
			<?php echo form_label( 'event_name', 'event-name' ); 
			echo form_input( array(
				'name' => 'event-name',
				'placeholder' => 'Enter event name',
				'id' => 'event-name'
				// 'required' => 'required'
			) ); ?>
		</div>
		<div class="luft-inline-input">
			<div class="luft-form-row">
				<?php
				echo form_label( 'ordernumber', 'ordernumber' );
				echo form_input( array(
					'name' => 'ordernumber',
					'placeholder' => 'Enter ordernumber',
					'id' => 'ordernumber',
					// 'required' => 'required',
					'type' => 'number'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'date', 'date' );
				echo form_input( array(
					'name' => 'date',
					'placeholder' => 'Enter date',
					'id' => 'date',
					'required' => 'required',
					'type' => 'date',
					'value' => date('Y-m-d')
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'Event StartTime', 'event-start' );
				echo form_input( array(
					'name' => 'event-start',
					'id' => 'event-start',
					'required' => 'required',
					'value' => '10:00',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'Event StopTime', 'event-stop' );
				echo form_input( array(
					'name' => 'event-stop',
					'id' => 'event-stop',
					'required' => 'required',
					'value' => '16:00',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'traveltime 1 start', 'traveltime-one-start' );
				echo form_input( array(
					'name' => 'traveltime-one-start',
					'id' => 'traveltime-one-start',
					'required' => 'required',
					'value' => '7:00',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'traveltime 1 stop', 'traveltime-one-stop' );
				echo form_input( array(
					'name' => 'traveltime-one-stop',
					'id' => 'traveltime-one-stop',
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'traveltime 2 start', 'traveltime-two-start' );
				echo form_input( array(
					'name' => 'traveltime-two-start',
					'id' => 'traveltime-two-start',
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'traveltime 2 stop', 'traveltime-two-stop' );
				echo form_input( array(
					'name' => 'traveltime-two-stop',
					'id' => 'traveltime-two-stop',
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'construction start', 'construction-start' );
				echo form_input( array(
					'name' => 'construction-start',
					'id' => 'construction-start',
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'construction stop', 'construction-stop' );
				echo form_input( array(
					'name' => 'construction-stop',
					'id' => 'construction-stop',
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'dismantling start', 'dismantling-start' );
				echo form_input( array(
					'name' => 'dismantling-start',
					'id' => 'dismantling-start',
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'dismantling stop', 'dismantling-stop' );
				echo form_input( array(
					'name' => 'dismantling-stop',
					'id' => 'dismantling-stop',
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
		</div>
		<div class="luft-form-row">
			<?php
			echo form_label( 'add staff', 'staff' );
			echo form_dropdown( array(
				'name' => 'add-staff',
				'id' => 'add-staff',
				'options' => $staffs
			) ); ?>
		</div>
		<div class="luft-inline-input">
			<div class="luft-form-row">
				<?php
				echo form_label( 'add package staff', 'package-staff' );
				echo form_dropdown( array(
					'name' => 'add-package-staff',
					'id' => 'add-package-staff',
					'options' => $staffs
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php echo form_label( 'Packing time', 'Packing-time' ); 
				echo form_input( array(
					'name' => 'Packing-time',
					'placeholder' => 'Enter packing time',
					'id' => 'Packing-time'
					// 'required' => 'required'
				) ); ?>
			</div>
		</div>
		<div class="luft-inline-input">
			<div class="luft-form-row">
				<?php
				echo form_label( 'address', 'address' );
				echo form_textarea( array(
					'name' => 'address',
					'placeholder' => 'Enter Address',
					'id' => 'address',
					'rows'        => '8',
					'cols'        => '30',
				) );?>
			</div>
			<div class="luft-form-row">
				<?php echo form_label( 'contactperson', 'contactperson' ); 
				echo form_input( array(
					'name' => 'contactperson',
					'placeholder' => 'Your contact person',
					'id' => 'contactperson'
					// 'required' => 'required'
				) ); ?>
				<?php echo form_label( 'telephone contact person', 'telephone-contactperson' ); 
				echo form_input( array(
					'name' => 'telephone-contactperson',
					'placeholder' => 'Your contact person',
					'id' => 'telephone-contactperson'
					// 'required' => 'required'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php echo form_label( 'distance to event', 'distance-to-event' ); 
				echo form_input( array(
					'name' => 'distance-to-event',
					'placeholder' => 'Distance to event',
					'id' => 'distance-to-event'
					// 'required' => 'required'
				) ); ?>
				<?php echo form_label( 'type of car and wagon', 'type-of-car' ); 
				echo form_input( array(
					'name' => 'type-of-car',
					'placeholder' => 'Enter type of car and wagon',
					'id' => 'type-of-car'
					// 'required' => 'required'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php echo form_label( 'link to google map', 'link-gmap' ); 
				echo form_input( array(
					'name' => 'link-gmap',
					'placeholder' => 'Enter link to google map',
					'id' => 'link-gmap'
					// 'required' => 'required'
				) ); ?>
			</div>
		</div>
		<div class="luft-inline-input">
			<div class="luft-form-row">
				<?php
				echo form_label( 'other information', 'other-information' );
				echo form_textarea( array(
					'name' => 'other-information',
					'placeholder' => 'Enter other information',
					'id' => 'other-information',
					'rows'        => '8',
					'cols'        => '30',
				) );?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'add products', 'add-products' );
				echo form_textarea( array(
					'name' => 'add-products',
					'placeholder' => 'Add other products',
					'id' => 'add-products',
					'rows'        => '8',
					'cols'        => '30',
				) );?>
			</div>			
		</div>
		<div class="luft-form-row">
			<?php echo form_label( 'Electricity', 'Electricity' );
			echo form_textarea( array(
				'name' => 'Electricity',
				'id' => 'Electricity',
				'rows'        => '8',
				'cols'        => '30',
			) );?>
		</div>
		<?php
			echo form_button( 'preview-event', 'preview Event' );
			echo form_submit( 'publish-event', 'publish Event' ); ?>
	</div>
	<?php
	echo form_close( '' );
?>	