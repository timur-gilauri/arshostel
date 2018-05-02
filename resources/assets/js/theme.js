$(function () {
    let navbarHeight = $('nav.navbar').outerHeight();
    let scrollTime = 600;


    $('.scroll-action').click(function (event) {
        event.preventDefault();
        let id = $(this).data('href');
        let target = $(id);
        let scrollTop = id !== '#top' ? target.offset().top - navbarHeight : 0;
        $('html').stop().animate({
            'scrollTop': scrollTop
        }, scrollTime);
    });

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
