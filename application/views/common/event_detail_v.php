<section class="luft-evt-detail-wrapper">

    <div class="luft-evt-header">
        <div class="evt-name">

            <h2><?php echo $event->name ?></h2>
            <div class="evt-info">
                <h4><b><?php echo get_msg('preview_date'); ?> </b> <span><?php echo get_date_from_datetime($event->start_time, 'Y-m-d')  ?></span></h4>
                <h4><b><?php echo get_msg('preview_city'); ?> </b> <span> ktm </span></h4>
                <h4> <b><?php echo get_msg('preview_staff'); ?> </b> <span><?php echo $event_staff ?></span></h4>
            </div>
        </div>

        <div class="evt-order-number">
            <h5> <span><?php echo get_msg('preview_ordernumber'); ?><span> <?php echo $event->order_number ?> </h5>
            <h5><?php echo get_msg('preview_total_worktime'); ?><span><span> <?php echo seconds_to_time($event->total_worktime ) ?></h5>
        </div>
    </div>

    <div class="evt-time-wrapper">

        <div class="travel-time-1">
            <h4><?php echo get_msg('preview_traveltime_1'); ?></h4>
            <p><?php echo get_start_end_time( $event->traveltime_1_start, $event->traveltime_1_stop ) ?>  </p>
        </div>

        <div class="cs-time">
            <h4><?php echo get_msg('preview_construct_time'); ?></h4>
            <p><?php echo get_start_end_time( $event->construction_start, $event->construction_stop ) ?></p>
        </div>

        <div class="evt-time">
            <h4><?php echo get_msg('preview_event_time'); ?></h4>
            <p><?php echo get_start_end_time( $event->start_time,$event->stop_time ) ?></p>
        </div>

        <div class="ds-time">
            <h4><?php echo get_msg('preview_dismantling_time'); ?></h4>
            <p><?php echo get_start_end_time( $event->dismantling_start, $event->dismantling_stop ) ?></p>
        </div>

        <div class="travel-time-2">
            <h4><?php echo get_msg('preview_traveltime_2'); ?></h4>
            <p><?php echo get_start_end_time($event->traveltime_2_start, $event->traveltime_2_stop) ?></p>
        </div>
    </div>

    <div class="evt-info">
        <h4><b><?php echo get_msg('preview_packed_by'); ?></b> <span> <?php echo $event_package_staff ?> </span></h4>
        <h4><b> <?php echo get_msg('preview_packing_time'); ?> </b> <span><?php echo $event->packing_time ?> </span></h4>
    </div>

    <div class="evt-detail-sect evt-sect-border">

        <div class="evt-detail-first">
            <h4><?php echo get_msg('preview_event_address'); ?></h4>
            <p> <?php echo $event->address ?>  </p>        
        </div>

        <div class="evt-contact-second">
            <h4><?php echo get_msg('preview_contactperson'); ?></h4>
            <p><?php echo $event->contact_person ?></p>        
        </div>

        <div class="evt-contact-third pr-5">
            <h4><?php echo get_msg('preview_contact_phone'); ?></h4>
            <p><?php echo $event->telephone_contact_person ?></p>        
        </div>

        <div class="evt-contact-forth pr-5">
            <h4><?php echo get_msg('preview_distance_event'); ?></h4>
            <p><?php echo $event->distance_to_event ?></p>        
        </div>

        <div class="evt-contact-fifth pr-5">
            <h4><?php echo get_msg('preview_type_of_car'); ?></h4>
            <p><?php echo $event->type_of_car ?></p>        
        </div>

        <div class="evt-contact-six f-100">
            <h4><?php echo get_msg('preview_gmap'); ?></h4>
            <p><a target="_blank" href="https://www.google.com/maps/@27.6704274,85.3239595,3225m/data=!3m1!1e3"><?php echo $event->link_gmap ?></a></p>        
        </div>
        
    </div>

    <div class="evt-detail-sect">

        <div class="evt-detail-first">
            <h4><?php echo get_msg('preview_products'); ?></h4>
            <p><?php echo $event->add_products ?></p>        
        </div>

        <div class="evt-contact-second">
            <h4><?php echo get_msg('preview_electricity'); ?></h4>
            <p><?php echo $event->electricity ?></p>        
        </div>

        <div class="evt-contact-third">
            <h4><?php echo get_msg('preview_other_info'); ?></h4>
            <p><?php echo $event->other_information ?></p>        
        </div>
        
    </div>
</section>