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

    };

    /* DOM ready event */
    $(document).ready(documentReadyCallbackFunc);
    
    //delete script
    $( document ).on( 'click', '.onoffswitch-checkbox', function(){
        var id = $(this).data( 'id' );
        $.ajax({
            url : LUFTLEK.ajax_url + LUFTLEK.route.event_toggle_status,
            type : 'POST',
            data : {event_id : id },
        });
    } );

})(jQuery);

