+(function ($) {
    const documentReadyCallbackFunc = () => {

        $.sidebarMenu($('.sidebar-menu'));

        setTimeout(function () {
            $('.form-success, .form-err').fadeOut('slow');
        }, 5000);

        $('#showLeft').click(function () {
            $('body').toggleClass('animate-menu-open')
        })

        $('.custom-styled-select').select2();

    };

    /* DOM ready event */
    $(document).ready(documentReadyCallbackFunc);

    //delete script 


})(jQuery);

