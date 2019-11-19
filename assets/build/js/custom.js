+(function ($) {
    const documentReadyCallbackFunc = () => {

        $.sidebarMenu($('.sidebar-menu'));

        setTimeout(function () {
            $('.form-success, .form-err').fadeOut('slow');
        }, 5000);

        $('#showLeft, .close-icon-mobile').click(function () {
            $('body').toggleClass('animate-menu-open')
        })

        $('.custom-styled-select').select2({
            placeholder: "Add staff here",
        });

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#uploaded-image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#profile-image").change(function () {
            readURL(this);
        });
        
        //status yes no toggle script
        $(document).on('click', '.onoffswitch-checkbox', function () {
            var id = $(this).data('id');
            $.ajax({
                url: LUFTLEK.ajax_url + LUFTLEK.route.event_toggle_status,
                type: 'POST',
                data: { event_id: id },
                dataType: 'json',
                success: function(res){
                    if(200 != res.status){
                        alert(res.message);
                        location.reload();
                    }
                }
            });
        });

  

        // let name = $('#name');
        // let date = $("#date");
        // let orderNumber = $("#order_number");
        // let city = $("city");
        // let staff = $("#add_staff").children("option:selected");
        // let packageStaff = $("#add_package_staff").children("option:selected");
        // let travelTimeStart1 = $("#traveltime_1_start");
        // let travelTimeStop1 = $("#traveltime_1_stop");
        // let constructionStart = $('#construction_start');
        // let constructionStop = $('#construction_stop');
        // let eventStart = $('#start_time');
        // let eventStop = $('#stop_time');
        // let dismantleStart = $('#dismantling_start');
        // let dismantleStop = $('#dismantling_stop');
        // let travelTimeStart2 = $('#traveltime_2_start');
        // let travelTimeStop2 = $('#traveltime_2_stop');
        // let packingTime = $('#packing_time');
        // let eventAddress = $('#address');
        // let contactPerson = $('#contact_person');
        // let contactPersonPhone = $('#telephone_contact_person');
        // let distanceToEvent = $('#distance_to_event');
        // let typeOfCar = $('#type_of_car');
        // let gMap = $('#link_gmap'); 
        // let product = $('#add_product');
        // let electricity = $('#Electricity');
        // let otherInfo = $('#other_information');

        
        var preview = $('#kk');
        preview.click(function() {
            var inputs = $('#my-form').serializeArray();
            $.each(inputs, function (i, input) {
                $('#preview_' + input.name).html(input.value);
            });
            // $(".evt-name h2").html(name.val());
            // $(".date").html(date.val());
            // $(".orderNum").html(orderNumber.val());
            // $(".travel-time-1 p").html(travelTimeStart1.val()+ '-' + travelTimeStop1.val());
            // $(".cs-time p").html(constructionStart.val()+ '-' + constructionStop.val());
            // $(".evt-time p").html(eventStart.val()+ '-' + eventStop.val());
            // $(".ds-time p").html(dismantleStart.val()+ '-' + dismantleStop.val());
            // $(".travel-time-2 p").html(travelTimeStart2.val()+ '-' + travelTimeStop2.val());
            // $(".staffs").html(staff.val());
            // $(".evt-info-package-staff").html(packageStaff.text());
            // $(".evt-info-package-time").html(packingTime.val());
            // $(".evt-detail-first p").html(eventAddress.val());
            // $(".evt-contact-second p").html(contactPerson.val());
            // $(".evt-contact-third  p").html(contactPersonPhone.val());
            // $(".evt-contact-forth p").html(distanceToEvent.val());
            // $(".evt-contact-fifth p").html(typeOfCar.val());
            // $(".evt-contact-six p").html(gMap.val());
            // $(".evt-detail-product").html(product.val());
            // $(".evt-detail-electricity").html(electricity.val());
            // $(".evt-detail-otherInfo").html(otherInfo.val());
        });
      

    };

    /* DOM ready event */
    $(document).ready(documentReadyCallbackFunc);

  

})(jQuery);

