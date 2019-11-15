<?php echo form_open( 'event/add' ); ?>
	<div class="luft-form-wrapper">
		<div class="luft-form-row">
			<?php echo form_label( 'event name', 'name' ); 
			echo form_input( array(
				'name' => 'name',
				'placeholder' => 'Enter event name',
				'id' => 'name',
				'value' => get_value($event, 'name')
				// 'required' => 'required'
			) ); ?>
		</div>
		<div class="luft-inline-input inline-4">
			<div class="luft-form-row">
				<?php
				echo form_label( 'ordernumber', 'order_number' );
				echo form_input( array(
					'name' => 'order_number',
					'placeholder' => 'Enter ordernumber',
					'id' => 'order_number',
					'value' => get_value($event, 'order_number'),
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
					'value' => get_value($event, 'date'), 
					'type' => 'date',
					'value' => date('Y-m-d')
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'Event StartTime', 'start_time' );
				echo form_input( array(
					'name' => 'start_time',
					'id' => 'start_time',
					'required' => 'required',
					'value' => get_value($event, 'start_time', '10:00'), 
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'Event StopTime', 'stop_time' );
				echo form_input( array(
					'name' => 'stop_time',
					'id' => 'stop_time',
					'required' => 'required',
					'value' => get_value($event, 'stop_time', '16:00'), 
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'traveltime 1 start', 'traveltime_1_start' );
				echo form_input( array(
					'name' => 'traveltime_1_start',
					'id' => 'traveltime_1_start',
					'required' => 'required',
					'value' => '7:00',
					'value' => get_value($event, 'traveltime_1_start', '7:00'), 
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'traveltime 1 stop', 'traveltime_1_stop' );
				echo form_input( array(
					'name' => 'traveltime_1_stop',
					'id' => 'traveltime_1_stop',
					'value' => get_value($event, 'traveltime_1_stop'), 
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'traveltime 2 start', 'traveltime_2_start' );
				echo form_input( array(
					'name' => 'traveltime_2_start',
					'id' => 'traveltime_2_start',
					'value' => get_value($event, 'traveltime_2_start'), 
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'traveltime 2 stop', 'traveltime_2_stop' );
				echo form_input( array(
					'name' => 'traveltime_2_stop',
					'id' => 'traveltime_2_stop',
					'value' => get_value($event, 'traveltime_2_stop'),
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'construction start', 'construction_start' );
				echo form_input( array(
					'name' => 'construction_start',
					'id' => 'construction_start',
					'value' => get_value($event, 'construction_start'),
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'construction stop', 'construction_stop' );
				echo form_input( array(
					'name' => 'construction_stop',
					'id' => 'construction_stop',
					'value' => get_value($event, 'construction_stop'),
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'dismantling start', 'dismantling_start' );
				echo form_input( array(
					'name' => 'dismantling_start',
					'id' => 'dismantling_start',
					'value' => get_value($event, 'dismantling_start'),
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( 'dismantling stop', 'dismantling_stop' );
				echo form_input( array(
					'name' => 'dismantling_stop',
					'id' => 'dismantling_stop',
					'value' => get_value($event, 'dismantling_stop'),
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
		</div>

		<div class="luft-form-row full-width-row">
			<?php
			echo form_label( 'add staff', 'add_staff' );
			echo form_multiselect( array(
				'name' => 'add_staff[]',
				'id' => 'add_staff',
				'options' => $staffs,
				'class' => 'custom-styled-select',
			) ); ?>
		</div>

		<div class="luft-inline-input inline-2">
			<div class="luft-form-row">
				<?php
				echo form_label( 'add package staff', 'add_package_staff' );
				echo form_dropdown( array(
					'name' => 'add_package_staff',
					'id' => 'add_package_staff',
					'options' => $staffs,
					'class' => 'custom-styled-select',
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php echo form_label( 'Packing time', 'Packing_time' ); 
				echo form_input( array(
					'name' => 'packing_time',
					'placeholder' => 'Enter packing time',
					'value' => get_value($event, 'packing_time'),
					'id' => 'Packing_time'
					// 'required' => 'required'
				) ); ?>
			</div>
		</div>


		<div class="luft-inline-input second-section">
			<div class="luft-form-row luft-half-row  text-area-row">
				<div class="text-area-wrapper">
					<?php
					echo form_label( 'address', 'address' );
					echo form_textarea( array(
						'name' => 'address',
						'placeholder' => 'Enter Address',
						'value' => get_value($event, 'address'),
						'id' => 'address'						
					) );?>
				</div>
			</div>
			<div class="luft-half-row">
				<div class="luft-form-row luft-half-row">
					<?php echo form_label( 'contactperson', 'contact_person' ); 
					echo form_input( array(
						'name' => 'contact_person',
						'placeholder' => 'Your contact person',
						'value' => get_value($event, 'contact_person'),
						'id' => 'contact_person'
						// 'required' => 'required'
					) ); ?>
				</div>

				<div class="luft-form-row luft-half-row">

					<?php echo form_label( 'telephone contact person', 'telephone_contact_person' ); 
					echo form_input( array(
						'name' => 'telephone_contact_person',
						'placeholder' => 'Your contact person',
						'id' => 'telephone_contact_person',
						'value' => get_value($event, 'telephone_contact_person'),
						// 'required' => 'required'
					) ); ?>
				</div>


				<div class="luft-form-row luft-half-row">
					<?php echo form_label( 'distance to event', 'distance_to_event' ); 
					echo form_input( array(
						'name' => 'distance_to_event',
						'placeholder' => 'Distance to event',
						'id' => 'distance_to_event',
						'value' => get_value($event, 'distance_to_event'),
						// 'required' => 'required'
					) ); ?>
				</div>

				<div class="luft-form-row luft-half-row">
					<?php echo form_label( 'type of car and wagon', 'type_of_car' ); 
					echo form_input( array(
						'name' => 'type_of_car',
						'placeholder' => 'Enter type of car and wagon',
						'value' => get_value($event, 'type_of_car'),
						'id' => 'type_of_car'
						// 'required' => 'required'
					) ); ?>
				</div>
				
				<div class="luft-form-row map-link">
					<?php echo form_label( 'link to google map', 'link_gmap' ); 
					echo form_input( array(
						'name' => 'link_gmap',
						'placeholder' => 'Enter link to google map',
						'value' => get_value($event, 'link_gmap'),
						'id' => 'link_gmap'
						// 'required' => 'required'
					) ); ?>
				</div>
			</div>	

		</div>

		<div class="luft-inline-input section-3">
			<div class="luft-form-row text-area-wrapper">
				<?php
				echo form_label( 'other information', 'other_information' );
				echo form_textarea( array(
					'name' => 'other_information',
					'placeholder' => 'Enter other information',
					'id' => 'other_information',
					'value' => get_value($event, 'other_information'),
					'rows'        => '8',
					'cols'        => '30',
				) );?>
			</div>
			<div class="luft-form-row text-area-wrapper">
				<?php
				echo form_label( 'add products', 'add_products' );
				echo form_textarea( array(
					'name' => 'add_products',
					'placeholder' => 'Add other products',
					'id' => 'add_product',
					'value' => get_value($event, 'add_products'),
					'rows'        => '8',
					'cols'        => '30',
				) );?>
			</div>	
			
			<div class="luft-form-row text-area-wrapper">
				<?php echo form_label( 'Electricity', 'Electricity' );
				echo form_textarea( array(
					'name' => 'electricity',
					'id' => 'Electricity',
					'value' => get_value($event, 'electricity'),
					'rows'        => '8',
					'cols'        => '30',
				) );?>
			</div>
		</div>
		<?php
			echo form_button( 'preview-event', 'preview Event' );
			echo form_submit( 'publish-event', 'publish Event' ); ?>
	</div>
	<?php
	echo form_close( '' );
?>	