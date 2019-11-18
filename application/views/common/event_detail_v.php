<section class="luft-evt-detail-wrapper">

    <div class="luft-evt-header">
        <div class="evt-name">

            <h2>Familjedag</h2>
            <div class="evt-info">
                <h4><b>DATE </b> <span><?php echo get_date_from_datetime($event->start_time, 'Y-m-d')  ?></span></h4>
                <h4><b>CITY </b> <span> ktm </span></h4>
                <h4> <b>STAFF </b> <span></span></span></h4>
            </div>
        </div>

        <div class="evt-order-number">
            <h5>ORDERNUMBER <span><span> <?php echo $event->order_number ?> </h5>
            <h5>TOTAL WORKINGTIME <span><span> <?php echo seconds_to_time($event->total_worktime ) ?></h5>
        </div>
    </div>

    <div class="evt-time-wrapper">

        <div class="travel-time-1">
            <h4>TRAVELTIME 1</h4>
            <p> <?php echo get_start_end_time( $event->traveltime_1_start, $event->traveltime_1_stop ) ?>  </p>
        </div>

        <div class="cs-time">
            <h4>CONSTRUCTION Time</h4>
            <p><?php echo get_start_end_time( $event->construction_start, $event->construction_stop ) ?></p>
        </div>

        <div class="evt-time">
            <h4>EVENT TIME</h4>
            <p><?php echo get_start_end_time( $event->start_time,$event->stop_time ) ?></p>
        </div>

        <div class="ds-time">
            <h4> DISMANTALING TIME</h4>
            <p><?php echo get_start_end_time( $event->dismantling_start, $event->dismantling_stop ) ?></p>
        </div>

        <div class="travel-time-2">
            <h4>TRAVELTIME 2</h4>
            <p><?php echo get_start_end_time($event->traveltime_2_start, $event->traveltime_2_stop) ?></p>
        </div>
    </div>

    <div class="evt-info">
        <h4><b> PACKED BY </b> <span> Emma </span></h4>
        <h4><b> PACKING TIME </b> <span><?php echo $event->packing_time ?> </span></h4>
    </div>

    <div class="evt-detail-sect evt-sect-border">

        <div class="evt-detail-first">
            <h4>EVENT ADRESS</h4>
            <p> <?php echo $event->address ?>  </p>        
        </div>

        <div class="evt-contact-second">
            <h4>CONTACTPERSON</h4>
            <p><?php echo $event->contact_person ?></p>        
        </div>

        <div class="evt-contact-third pr-5">
            <h4>Contact phone</h4>
            <p><?php echo $event->telephone_contact_person ?></p>        
        </div>

        <div class="evt-contact-forth pr-5">
            <h4>DISTANCE TO EVENT</h4>
            <p><?php echo $event->distance_to_event ?></p>        
        </div>

        <div class="evt-contact-fifth pr-5">
            <h4>TYPE OF CAR AND WAGON</h4>
            <p><?php echo $event->type_of_car ?></p>        
        </div>

        <div class="evt-contact-six f-100">
            <h4>GOOGLE MAP</h4>
            <p><a target="_blank" href="https://www.google.com/maps/@27.6704274,85.3239595,3225m/data=!3m1!1e3"><?php echo $event->link_gmap ?></a></p>        
        </div>
        
    </div>

    <div class="evt-detail-sect">

        <div class="evt-detail-first">
            <h4>PRODUCTS</h4>
            <p><?php echo $event->add_products ?></p>        
        </div>

        <div class="evt-contact-second">
            <h4>ELECTRICITY</h4>
            <p><?php echo $event->electricity ?></p>        
        </div>

        <div class="evt-contact-third">
            <h4>OTHER INFORMATION</h4>
            <p><?php echo $event->other_information ?></p>        
        </div>
        
    </div>
</section>