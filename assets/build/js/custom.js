+(function ($) {

    const documentReadyCallbackFunc = () => {
        $.sidebarMenu($('.sidebar-menu'))
    };

    /* DOM ready event */
    $(document).ready(documentReadyCallbackFunc);



})(jQuery);