window.addEventListener('load', function () {

    /* SCROLLING */

    let navbarHeight = $('nav.navbar').outerHeight();
    let scrollTime = 600;

    $('.scroll-action').click(function (event) {
        event.preventDefault();
        scrollToId($(this).data('href'));
    });

    function scrollToId(id) {
        let target = $(id);
        if (!target.length) {
            return false;
        }
        let scrollTop = id !== '#top' ? target.offset().top - navbarHeight : 0;
        console.log(scrollTop);
        $('html, body').stop().animate({
            'scrollTop': scrollTop
        }, scrollTime);
    }


    if (window.location.search) {
        let query = window.location.search.substr(1);
        let params = query.split('&');
        let sectionId = '';
        params.forEach(param => {
            let queryPair = param.split('=');
            if (queryPair.length !== 2) {
                return false;
            }
            let prop = queryPair[0];
            if (prop === 'to') {
                sectionId = queryPair[1];
            }
        });
        if ($(`#${sectionId}`).length) {
            scrollToId(`#${sectionId}`);
        }
    }

    /* MOBILE NAVBAR */

    let menu = $('.mobile-menu');

    $('.hamburger-btn').click(function () {
        if (!$(this).hasClass('open')) {
            $(this).addClass('open');
            menu.slideDown();
        } else {
            $(this).removeClass('open');
            menu.slideUp();
        }
    });

    menu.find('.nav-item').click(function () {
        $('.hamburger-btn').removeClass('open');
        menu.slideUp();
    });
});
