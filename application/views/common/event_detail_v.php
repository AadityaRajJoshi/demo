<section class="luft-evt-detail-wrapper">

    <div class="luft-evt-header">
        <div class="evt-name">

            <h2 id='preview_name'><?php echo $event->name ?></h2>
            <div class="evt-info">
                <h4>
                    <b><?php echo get_msg('preview_date'); ?> </b> 
                    <span id='preview_date'><?php echo $event->date ?></span>
                </h4>
                <h4><b><?php echo get_msg('preview_city'); ?> </b> <span> ktm </span></h4>
                <h4> <b><?php echo get_msg('preview_staff'); ?> </b> <span><?php echo $event_staff ?></span></h4>
            </div>
        </div>

        <div class="evt-order-number">
            <h5>
                <span>
                    <?php echo get_msg('preview_ordernumber'); ?>
                    <span id='preview_order_number'> <?php echo $event->order_number ?> </span>
                </span>
            </h5>
            <h5><?php echo get_msg('preview_total_worktime'); ?><span><span id="preview_total_worktime"> <?php echo $event->total_worktime; ?></h5>
        </div>
    </div>

    <div class="evt-time-wrapper">

        <div class="travel-time-1">
            <h4><?php echo get_msg('preview_traveltime_1'); ?></h4>
            <p id="preview_traveltime_1"><?php echo $event->traveltime_1; ?>  </p>
        </div>

        <div class="cs-time">
            <h4><?php echo get_msg('preview_construct_time'); ?></h4>
            <p id="preview_construction_time"><?php echo $event->construction_time; ?></p>
        </div>

        <div class="evt-time">
            <h4><?php echo get_msg('preview_event_time'); ?></h4>
            <p id="preview_event_time"><?php echo $event->event_time; ?></p>
        </div>

        <div class="ds-time">
            <h4><?php echo get_msg('preview_dismantling_time'); ?></h4>
            <p id="preview_dismantling_time"><?php echo $event->dismantling_time; ?></p>
        </div>

        <div class="travel-time-2">
            <h4><?php echo get_msg('preview_traveltime_2'); ?></h4>
            <p id="preview_traveltime_2"><?php echo $event->traveltime_2; ?></p>
        </div>
    </div>

    <div class="evt-info">
        <h4><b><?php echo get_msg('preview_packed_by'); ?></b> <span id="preview_add_package_staff"> <?php echo $event_package_staff ?> </span></h4>
        <h4><b> <?php echo get_msg('preview_packing_time'); ?> </b> <span id='preview_packing_time'><?php echo $event->packing_time ?> </span></h4>
    </div>

    <div class="evt-detail-sect evt-sect-border">

        <div class="evt-detail-first">
            <h4><?php echo get_msg('preview_event_address'); ?></h4>
            <p id="preview_address"> <?php echo $event->address ?>  </p>        
        </div>

        <div class="evt-contact-second">
            <h4><?php echo get_msg('preview_contactperson'); ?></h4>
            <p id="preview_contact_person"><?php echo $event->contact_person ?></p>        
        </div>

        <div class="evt-contact-third pr-5">
            <h4><?php echo get_msg('preview_contact_phone'); ?></h4>
            <p id="preview_telephone_contact_person"><?php echo $event->telephone_contact_person ?></p>        
        </div>

        <div class="evt-contact-forth pr-5">
            <h4><?php echo get_msg('preview_distance_event'); ?></h4>
            <p id="preview_distance_to_event"><?php echo $event->distance_to_event ?></p>        
        </div>

        <div class="evt-contact-fifth pr-5">
            <h4><?php echo get_msg('preview_type_of_car'); ?></h4>
            <p id="preview_type_of_car"><?php echo $event->type_of_car ?></p>        
        </div>

        <div class="evt-contact-six f-100">
            <h4><?php echo get_msg('preview_gmap'); ?></h4>
            <p id="preview_link_gmap"><a target="_blank" href="https://www.google.com/maps/@27.6704274,85.3239595,3225m/data=!3m1!1e3"><?php echo $event->link_gmap ?></a></p>        
        </div>
        
    </div>

    <div class="evt-detail-sect">

        <div class="evt-detail-first">
            <h4><?php echo get_msg('preview_products'); ?></h4>
            <p id="preview_add_products"><?php echo $event->add_products ?></p>        
        </div>

        <div class="evt-contact-second">
            <h4><?php echo get_msg('preview_electricity'); ?></h4>
            <p id="preview_electricity"><?php echo $event->electricity ?></p>        
        </div>

        <div class="evt-contact-third">
            <h4><?php echo get_msg('preview_other_info'); ?></h4>
            <p id="preview_other_information"><?php echo $event->other_information ?></p>        
        </div>
        
    </div>
</section>