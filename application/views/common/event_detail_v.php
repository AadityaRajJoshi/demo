<section class="luft-evt-detail-wrapper">

    <div class="luft-evt-header">
        <div class="evt-name">
            <h2 id='preview_name'><?php echo get_value($event,'name'); ?></h2>
            <div class="evt-info">
                <h4>
                    <b><?php echo get_msg('preview_date'); ?> </b> 
                    <span id="preview_date"><?php echo get_value($event, 'date'); ?></span>
                </h4>
                <h4>
                    <b><?php echo get_msg('preview_city'); ?> </b> 
                    <span id="preview_city"> <?php echo ucfirst($event->city) ?> </span>
                </h4>
                <h4> 
                    <b><?php echo get_msg('preview_staff'); ?> </b> 
                    <span id="preview_staff"><?php echo $event_staff; ?></span>
                </h4>
            </div>
        </div>

        <div class="evt-order-number hide-on-mobile">
            <h5>
                <span>
                    <?php echo get_msg('preview_ordernumber'); ?>
                    <span id="preview_order_number"><?php echo get_value($event, 'order_number'); ?> </span>
                </span>
            </h5>
            <h5>
                <?php echo get_msg('preview_total_worktime'); ?>
                <span id="preview_total_worktime"><?php echo get_value($event,'total_worktime'); ?></span>
            </h5>
        </div>
    </div>

    <div class="evt-time-wrapper">

        <div class="travel-time-1">
            <h4><?php echo get_msg('preview_traveltime_1'); ?></h4>
            <p id="preview_traveltime_1"><?php echo get_value($event,'traveltime_1'); ?>  </p>
        </div>

        <div class="cs-time">
            <h4><?php echo get_msg('preview_construct_time'); ?></h4>
            <p id="preview_construction_time"><?php echo get_value($event,'construction_time'); ?></p>
        </div>

        <div class="evt-time">
            <h4><?php echo get_msg('preview_event_time'); ?></h4>
            <p id="preview_event_time"><?php echo get_value($event,'event_time'); ?></p>
        </div>

        <div class="ds-time">
            <h4><?php echo get_msg('preview_dismantling_time'); ?></h4>
            <p id="preview_dismantling_time"><?php echo get_value($event, 'dismantling_time'); ?></p>
        </div>

        <div class="travel-time-2">
            <h4><?php echo get_msg('preview_traveltime_2'); ?></h4>
            <p id="preview_traveltime_2"><?php echo get_value($event, 'traveltime_2'); ?></p>
        </div>
    </div>

    <div class="evt-info">
        <h4>
            <b><?php echo get_msg('preview_packed_by'); ?></b> 
            <span id="preview_package_staff"> <?php echo $event_package_staff; ?></span>
        </h4>
        <h4>
            <b><?php echo get_msg('preview_packing_time'); ?></b>
            <span id='preview_packing_time'><?php echo get_value($event,'packing_time'); ?></span>
        </h4>
        <h4 class="display-on-mobile">
            <b><?php echo get_msg('preview_ordernumber'); ?></b> 
            <span id="preview_order_number"><?php echo get_value($event, 'order_number'); ?> </span>
        </h4>
        <h4 class="display-on-mobile">
            <b> <?php echo get_msg('preview_total_worktime'); ?></b>
            <span id="preview_total_worktime"><?php echo get_value($event,'total_worktime'); ?></span>
        </h4>   

        
    </div>

    <div class="evt-detail-sect evt-sect-border">

        <div class="evt-detail-first">
            <h4><?php echo get_msg('preview_event_address'); ?></h4>
            <p id="preview_address"><?php echo get_value($event,'address'); ?></p>        
        </div>

        <div class="evt-contact-second">
            <h4><?php echo get_msg('preview_contactperson'); ?></h4>
            <p id="preview_contact_person"><?php echo get_value($event,'contact_person'); ?></p>        
        </div>

        <div class="evt-contact-third pr-5">
            <h4><?php echo get_msg('preview_contact_phone'); ?></h4>
            <p id="preview_telephone_contact_person"><?php echo get_value($event,'telephone_contact_person'); ?></p>        
        </div>

        <div class="evt-contact-forth pr-5">
            <h4><?php echo get_msg('preview_distance_event'); ?></h4>
            <p id="preview_distance_to_event"><?php echo get_value($event,'distance_to_event'); ?></p>        
        </div>

        <div class="evt-contact-fifth pr-5">
            <h4><?php echo get_msg('preview_type_of_car'); ?></h4>
            <p id="preview_type_of_car"><?php echo get_value($event,'type_of_car'); ?></p>        
        </div>

        <div class="evt-contact-six f-100">
            <h4><?php echo get_msg('preview_gmap'); ?></h4>
            <p id="preview_link_gmap">
                <a target="_blank" href="https://www.google.com/maps/@27.6704274,85.3239595,3225m/data=!3m1!1e3">
                    <?php echo get_value($event,'link_gmap'); ?>
                </a>
            </p>        
        </div>
        
    </div>

    <div class="evt-detail-sect">

        <div class="evt-detail-first">
            <h4><?php echo get_msg('preview_products'); ?></h4>
            <p id="preview_add_products"><?php echo get_value($event,'add_products'); ?></p>        
        </div>

        <div class="evt-contact-second">
            <h4><?php echo get_msg('preview_electricity'); ?></h4>
            <p id="preview_electricity"><?php echo get_value($event,'electricity'); ?></p>        
        </div>

        <div class="evt-contact-third">
            <h4><?php echo get_msg('preview_other_info'); ?></h4>
            <p id="preview_other_information"><?php echo get_value($event,'other_information'); ?></p>        
        </div>
        
    </div>

    <div class="display-on-mobile">
        <a href="#" class="go-back-btn"> Go Back </a>
    </div>
</section>

