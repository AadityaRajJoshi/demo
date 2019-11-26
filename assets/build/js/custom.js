+(function ($) {

    var capitalize = function (text) {
        return text.substr(0, 1).toUpperCase() + text.substr(1);
    };

    //hide show table detail content
    function toggleDetailTable() {
        $('.extend-data').hide();
        $('.luft-extend-table').click(function (e) {
            $(this).parent().next().slideToggle(200);
            $(this).parent().parent().toggleClass('data-expended');
            e.preventDefault();
        });
        $('.extend-data').slideUp(200);
    }


    function filterByRange(){
        
      $('input[name="daterange"]').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {
        var id = $('[name ="id"]').val();
        var start_date = start.format('YYYY-MM-DD');
        var end_date = end.format('YYYY-MM-DD');
       window.location.href = LUFTLEK.ajax_url + 'user/edit/' + id + '/'  + '?f=' +start_date + '&t=' + end_date;
      });

      $( 'input[name="eventDatePicker"]').daterangepicker({
        opens:'left'
      }, function( start, end, label ){
        var start = start.format('YYYY-MM-DD');
        var end = end.format('YYYY-MM-DD');
        window.location.href = LUFTLEK.ajax_url + 'event/' + '?f=' +start + '&t=' + end;
      });
    }  


    var documentReadyCallbackFunc = () => {

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
                success: function (res) {
                    if (200 != res.status) {
                        alert(res.message);
                        location.reload();
                    }
                }
            });
        });


        var preview = $('#preview-btn');
        preview.click(function () {
            var inputs = $('#my-form').serializeArray();
            $.ajax({
                url: LUFTLEK.ajax_url + LUFTLEK.route.event_process_data,
                type: 'POST',
                data: inputs,
                dataType: 'json',
                success: function (res) {
                    if (200 == res.status) {
                        $.each(res.data, function (name, input) {
                            $('#preview_' + name).html(input);
                        });
                        var staff = $('#add_staff option:selected').toArray().map(function (item) {
                            return capitalize(item.text);
                        }).join(', ');

                        $('#preview_staff').html(staff);
                        var package_staff = $('#add_package_staff option:selected').text();
                        $('#preview_package_staff').html(capitalize(package_staff));
                        var city = $('#city').val();
                        $('#preview_city').html(capitalize(city));
                    }
                }
            })
        });
    };

    /* DOM ready event */
    $(document).ready(documentReadyCallbackFunc, toggleDetailTable(),filterByRange());

})(jQuery);

