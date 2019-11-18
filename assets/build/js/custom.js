+(function ($) {
    const documentReadyCallbackFunc = () => {

        $.sidebarMenu($('.sidebar-menu'));

        setTimeout(function () {
            $('.form-success, .form-err').fadeOut('slow');
        }, 5000);

        $('#showLeft, .close-icon-mobile').click(function () {
            $('body').toggleClass('animate-menu-open')
        })

        $('.custom-styled-select').select2();

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
            });
        });

    };

    /* DOM ready event */
    $(document).ready(documentReadyCallbackFunc);

})(jQuery);

