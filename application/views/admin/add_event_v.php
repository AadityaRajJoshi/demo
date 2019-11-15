<?php echo form_open( 'event/add' ); ?>
	<div class="luft-form-wrapper">
		<div class="luft-form-row">
			<?php echo form_label( get_msg('event_name_label'), 'name' ); 
			echo form_input( array(
				'name' => 'name',
				'placeholder' => get_msg('e_name_placeholder'),
				'id' => 'name',
				'value' => get_value($event, 'name')
				// 'required' => 'required'
			) ); ?>
		</div>
		<div class="luft-inline-input inline-4">
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('event_order_label'), 'order_number' );
				echo form_input( array(
					'name' => 'order_number',
					'placeholder' => get_msg('e_order_placeholder'),
					'id' => 'order_number',
					'value' => get_value($event, 'order_number'),
					// 'required' => 'required',
					'type' => 'number'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('event_date_label'), 'date' );
				echo form_input( array(
					'name' => 'date',
					'placeholder' => get_msg('e_date_placeholder'),
					'id' => 'date',
					'required' => 'required',
					'value' => get_value($event, 'date'), 
					'type' => 'date',
					'value' => date('Y-m-d')
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('event_starttime_label'), 'start_time' );
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
				echo form_label( get_msg('event_StopTime_label'), 'stop_time' );
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
				echo form_label( get_msg('event_traveltime_1_start_label'), 'traveltime_1_start' );
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
				echo form_label( get_msg('event_traveltime_1_stop_label'), 'traveltime_1_stop' );
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
				echo form_label( get_msg('event_traveltime_2_start_label'), 'traveltime_2_start' );
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
				echo form_label( get_msg('event_traveltime_2_stop_label'), 'traveltime_2_stop' );
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
				echo form_label( get_msg('event_construction_start_label'), 'construction_start' );
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
				echo form_label( get_msg('event_construction_stop_label'), 'construction_stop' );
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
				echo form_label( get_msg('event_dismantling_start_label'), 'dismantling_start' );
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
				echo form_label( get_msg('event_dismantling_stop_label'), 'dismantling_stop' );
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
			echo form_label( get_msg('event_addstaff_label'), 'add_staff' );
			echo form_multiselect( array(
				'name' => 'add_staff',
				'id' => 'add_staff',
				'options' => $staffs,
				'class' => 'custom-styled-select',
			) ); ?>
		</div>

		<div class="luft-inline-input inline-2">
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('event_add_packingstaff_label'), 'add_package_staff' );
				echo form_dropdown( array(
					'name' => 'add_package_staff',
					'id' => 'add_package_staff',
					'options' => $staffs,
					'class' => 'custom-styled-select',
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php echo form_label( get_msg('event_packing_time_label'), 'Packing_time' ); 
				echo form_input( array(
					'name' => 'packing_time',
					'placeholder' => get_msg('e_packing_time_placeholder'),
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
					echo form_label( get_msg('event_address_label'), 'address' );
					echo form_textarea( array(
						'name' => 'address',
						'placeholder' => get_msg('e_address_placeholder'),
						'value' => get_value($event, 'address'),
						'id' => 'address'						
					) );?>
				</div>
			</div>
			<div class="luft-half-row">
				<div class="luft-form-row luft-half-row">
					<?php echo form_label( get_msg('event_Contact_person_label'), 'contact_person' ); 
					echo form_input( array(
						'name' => 'contact_person',
						'placeholder' => get_msg('e_Contact_person_placeholder'),
						'value' => get_value($event, 'contact_person'),
						'id' => 'contact_person'
						// 'required' => 'required'
					) ); ?>
				</div>

				<div class="luft-form-row luft-half-row">

					<?php echo form_label( get_msg('event_tele_person'), 'telephone_contact_person' ); 
					echo form_input( array(
						'name' => 'telephone_contact_person',
						'placeholder' => get_msg('e_Contact_person_placeholder'),
						'id' => 'telephone_contact_person',
						'value' => get_value($event, 'telephone_contact_person'),
						// 'required' => 'required'
					) ); ?>
				</div>


				<div class="luft-form-row luft-half-row">
					<?php echo form_label( get_msg('event_distance_label'), 'distance_to_event' ); 
					echo form_input( array(
						'name' => 'distance_to_event',
						'placeholder' => get_msg('e_distance_placeholder'),
						'id' => 'distance_to_event',
						'value' => get_value($event, 'distance_to_event'),
						// 'required' => 'required'
					) ); ?>
				</div>

				<div class="luft-form-row luft-half-row">
					<?php echo form_label( get_msg('event_car_wagon_label'), 'type_of_car' ); 
					echo form_input( array(
						'name' => 'type_of_car',
						'placeholder' => get_msg('e_car_wagon_placeholder'),
						'value' => get_value($event, 'type_of_car'),
						'id' => 'type_of_car'
						// 'required' => 'required'
					) ); ?>
				</div>
				
				<div class="luft-form-row map-link">
					<?php echo form_label( get_msg('event_link_map_label'), 'link_gmap' ); 
					echo form_input( array(
						'name' => 'link_gmap',
						'placeholder' => get_msg('e_link_map_placeholder'),
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
				echo form_label( get_msg('event_other_info_label'), 'other_information' );
				echo form_textarea( array(
					'name' => 'other_information',
					'placeholder' => get_msg('e_other_info_placeholder'),
					'id' => 'other_information',
					'value' => get_value($event, 'other_information'),
					'rows'        => '8',
					'cols'        => '30',
				) );?>
			</div>
			<div class="luft-form-row text-area-wrapper">
				<?php
				echo form_label( get_msg('event_add_product_label'), 'add_products' );
				echo form_textarea( array(
					'name' => 'add_products',
					'placeholder' => get_msg('e_add_product_placeholder'),
					'id' => 'add_product',
					'value' => get_value($event, 'add_products'),
					'rows'        => '8',
					'cols'        => '30',
				) );?>
			</div>	
			
			<div class="luft-form-row text-area-wrapper">
				<?php echo form_label( get_msg('event_electricty_label'), 'Electricity' );
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
			echo form_button( 'preview-event', get_msg('event_preview_btn') );
			echo form_submit( 'publish-event', get_msg('event_publish_btn') ); ?>
	</div>
	<?php
	echo form_close( '' );
?>	