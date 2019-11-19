<?php echo form_open( '', array('id'=>'my-form') ); ?>
	<div class="luft-form-wrapper">
		<div class="luft-form-row">
			<?php echo form_label( get_msg('label_event_name'), 'name' ); 
			echo form_input( array(
				'name' => 'name',
				'placeholder' => get_msg('placeholder_event_name'),
				'id' => 'name',
				'value' => get_value($event, 'name'),
				'required' => 'required'
			) ); ?>
		</div>
		<div class="luft-inline-input inline-4">
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('label_event_order'), 'order_number' );
				echo form_input( array(
					'name' => 'order_number',
					'placeholder' => get_msg('placeholder_event_order'),
					'id' => 'order_number',
					'value' => get_value($event, 'order_number'),
					// 'required' => 'required',
					'type' => 'number'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('label_event_date'), 'date' );
				echo form_input( array(
					'name' => 'date',
					'placeholder' => get_msg('placeholder_event_date'),
					'id' => 'date',
					'required' => 'required',
					'value' => get_value($event, 'date', date( 'Y-m-d' )),
					'type' => 'date',
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('label_event_starttime'), 'start_time' );
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
				echo form_label( get_msg('label_event_stoptime'), 'stop_time' );
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
				echo form_label( get_msg('label_event_traveltime_1_start'), 'traveltime_1_start' );
				echo form_input( array(
					'name' => 'traveltime_1_start',
					'id' => 'traveltime_1_start',
					'required' => 'required',
					'value' => get_value($event, 'traveltime_1_start', '07:00'),
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('label_event_traveltime_1_stop'), 'traveltime_1_stop' );
				echo form_input( array(
					'name' => 'traveltime_1_stop',
					'id' => 'traveltime_1_stop',
					'value' => get_value($event, 'traveltime_1_stop', '08:00'), 
					'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('label_event_traveltime_2_start'), 'traveltime_2_start' );
				echo form_input( array(
					'name' => 'traveltime_2_start',
					'id' => 'traveltime_2_start',
					'value' => get_value($event, 'traveltime_2_start', '18:00'),
					// 'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('label_event_traveltime_2_stop'), 'traveltime_2_stop' );
				echo form_input( array(
					'name' => 'traveltime_2_stop',
					'id' => 'traveltime_2_stop',
					'value' => get_value($event, 'traveltime_2_stop', '19:00'),
					'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('label_event_construction_start'), 'construction_start' );
				echo form_input( array(
					'name' => 'construction_start',
					'id' => 'construction_start',
					'value' => get_value($event, 'construction_start', '08:00'),
					'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('label_event_construction_stop'), 'construction_stop' );
				echo form_input( array(
					'name' => 'construction_stop',
					'id' => 'construction_stop',
					'value' => get_value($event, 'construction_stop', '10:00'),
					'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('label_event_dismantling_start'), 'dismantling_start' );
				echo form_input( array(
					'name' => 'dismantling_start',
					'id' => 'dismantling_start',
					'value' => get_value($event, 'dismantling_start', '16:00'),
					'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
			<div class="luft-form-row">
				<?php
				echo form_label( get_msg('label_event_dismantling_stop'), 'dismantling_stop' );
				echo form_input( array(
					'name' => 'dismantling_stop',
					'id' => 'dismantling_stop',
					'value' => get_value($event, 'dismantling_stop', '18:00'),
					'required' => 'required',
					'type' => 'time'
				) ); ?>
			</div>
		</div>

		<div class="luft-form-row full-width-row">
			<?php
				echo form_label( get_msg('label_event_addstaff'), 'add_staff' );
				echo form_multiselect( array(
					'name' => 'add_staff[]',
					'id' => 'add_staff',
					'class' => 'custom-styled-select',
				),  $staffs, $event_users ); 
			?>
		</div>

		<div class="luft-inline-input inline-2">
			<div class="luft-form-row">
				<?php

				echo form_label( get_msg('label_event_add_packingstaff'), 'add_package_staff' );
				echo form_dropdown( array(
					'name' => 'add_package_staff',
					'id' => 'add_package_staff',
					'options' => $staffs,
					'class' => 'custom-styled-select',
				), $staffs, isset( $event_package_users ) ? $event_package_users : false ); 
				?>
			</div>
			<div class="luft-form-row">
				<?php echo form_label( get_msg('label_event_packing_time'), 'Packing_time' ); 
				echo form_input( array(
					'name' => 'packing_time',
					'placeholder' => get_msg('placeholder_event_packing_time'),
					'value' => get_value($event, 'packing_time'),
					'id' => 'packing_time'
				) ); ?>
			</div>
		</div>


		<div class="luft-inline-input second-section">
			<div class="luft-form-row luft-half-row  text-area-row">
				<div class="text-area-wrapper">
					<?php
					echo form_label( get_msg('label_event_address'), 'address' );
					echo form_textarea( array(
						'name' => 'address',
						'placeholder' => get_msg('placeholder_event_address'),
						'value' => get_value($event, 'address'),
						'id' => 'address'						
					) );?>
				</div>
			</div>
			<div class="luft-half-row">
				<div class="luft-form-row luft-half-row">
					<?php echo form_label( get_msg('label_event_Contact_person'), 'contact_person' ); 
					echo form_input( array(
						'name' => 'contact_person',
						'placeholder' => get_msg('placeholder_event_Contact_person'),
						'value' => get_value($event, 'contact_person'),
						'id' => 'contact_person'
					) ); ?>
				</div>

				<div class="luft-form-row luft-half-row">

					<?php echo form_label( get_msg('label_event_tele_person'), 'telephone_contact_person' ); 
					echo form_input( array(
						'name' => 'telephone_contact_person',
						'placeholder' => get_msg('placeholder_event_tele_Contact_person'),
						'id' => 'telephone_contact_person',
						'value' => get_value($event, 'telephone_contact_person'),
					) ); ?>
				</div>


				<div class="luft-form-row luft-half-row">
					<?php echo form_label( get_msg('label_event_distance'), 'distance_to_event' ); 
					echo form_input( array(
						'name' => 'distance_to_event',
						'placeholder' => get_msg('placeholder_event_distance'),
						'id' => 'distance_to_event',
						'value' => get_value($event, 'distance_to_event'),
					) ); ?>
				</div>

				<div class="luft-form-row luft-half-row">
					<?php echo form_label( get_msg('label_event_car_wagon'), 'type_of_car' ); 
					echo form_input( array(
						'name' => 'type_of_car',
						'placeholder' => get_msg('placeholder_event_car_wagon'),
						'value' => get_value($event, 'type_of_car'),
						'id' => 'type_of_car'
					) ); ?>
				</div>
				
				<div class="luft-form-row map-link">
					<?php echo form_label( get_msg('label_event_link_map'), 'link_gmap' ); 
					echo form_input( array(
						'name' => 'link_gmap',
						'placeholder' => get_msg('placeholder_event_link_map'),
						'value' => get_value($event, 'link_gmap'),
						'id' => 'link_gmap'
					) ); ?>
				</div>
			</div>	

		</div>

		<div class="luft-inline-input section-3">
			<div class="luft-form-row text-area-wrapper">
				<?php
				echo form_label( get_msg('label_event_other_info'), 'other_information' );
				echo form_textarea( array(
					'name' => 'other_information',
					'placeholder' => get_msg('placeholder_event_other_info'),
					'id' => 'other_information',
					'value' => get_value($event, 'other_information'),
					'rows'        => '8',
					'cols'        => '30',
				) );?>
			</div>
			<div class="luft-form-row text-area-wrapper">
				<?php
				echo form_label( get_msg('label_event_add_product'), 'add_products' );
				echo form_textarea( array(
					'name' => 'add_products',
					'placeholder' => get_msg('placeholder_event_add_product'),
					'id' => 'add_product',
					'value' => get_value($event, 'add_products'),
					'rows'        => '8',
					'cols'        => '30',
				) );?>
			</div>	
			
			<div class="luft-form-row text-area-wrapper">
				<?php echo form_label( get_msg('label_event_electricty'), 'Electricity' );
				echo form_textarea( array(
					'name' => 'electricity',
					'id' => 'Electricity',
					'value' => get_value($event, 'electricity'),
					'rows'        => '8',
					'cols'        => '30',
				) );?>
			</div>
		</div>
		<a href="#preview-modal" rel="modal:open" class="preview-modal"  id="kk"> preview-event </a>
		<?php
			// echo form_button( 'preview-event', get_msg('event_preview_btn') );
			echo form_submit( 'publish-event', get_msg('event_publish_btn') ); ?>
	</div>
	<?php
	echo form_close( '' );
?>	