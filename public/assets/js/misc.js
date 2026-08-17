(function ($) {
    'use strict';
    $(function () {
        var sidebar = $('.mdc-drawer-menu');
        var body = $('body');

        if ($('.mdc-drawer').length) {
            var drawer = mdc.drawer.MDCDrawer.attachTo(document.querySelector('.mdc-drawer'));
            // toggler icon click function
            document.querySelector('.sidebar-toggler').addEventListener('click', function () {
                drawer.open = !drawer.open;
            });
        }

        // Initially collapsed drawer in below desktop
        if (window.matchMedia('(max-width: 991px)').matches) {
            if (document.querySelector('.mdc-drawer.mdc-drawer--dismissible').classList.contains('mdc-drawer--open')) {
                document.querySelector('.mdc-drawer.mdc-drawer--dismissible').classList.remove('mdc-drawer--open');
            }
        }

        var currentPath = window.location.pathname;

        $('.mdc-drawer-item .mdc-drawer-link').each(function () {

            var linkPath = new URL($(this).attr('href'), window.location.origin).pathname;

            if (linkPath === currentPath) {
                $(this).addClass('active');

                if ($(this).parents('.mdc-expansion-panel').length) {
                    $(this).closest('.mdc-expansion-panel').addClass('expanded').show();
                }
            }

        });

        // Toggle Sidebar items
        $('[data-toggle="expansionPanel"]').on('click', function () {
            // close other items
            $('.mdc-expansion-panel').not($('#' + $(this).attr("data-target"))).hide(300);
            $('.mdc-expansion-panel').not($('#' + $(this).attr("data-target"))).prev('[data-toggle="expansionPanel"]').removeClass("expanded");
            // Open toggle menu
            $('#' + $(this).attr("data-target")).slideToggle(300, function () {
                $('#' + $(this).attr("data-target")).toggleClass('expanded');
            });
        });


        // Add expanded class to mdc-drawer-link after expanded
        $('.mdc-drawer-item .mdc-expansion-panel').each(function () {
            $(this).prev('[data-toggle="expansionPanel"]').on('click', function () {
                $(this).toggleClass('expanded');
            })
        });

        //Applying perfect scrollbar to sidebar
        if (!body.hasClass("rtl")) {
            if ($('.mdc-drawer .mdc-drawer__content').length) {
                const chatsScroll = new PerfectScrollbar('.mdc-drawer .mdc-drawer__content');
            }
        }

    });
})(jQuery);
