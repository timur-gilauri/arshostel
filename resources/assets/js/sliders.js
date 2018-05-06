$(document).ready(function () {

    let galleryResponsive = {
        0: {
            items: 1
        },
        520: {
            items: 2
        },
        920: {
            items: 3
        }
    };

    $('.rooms').owlCarousel({
        margin: 10,
        nav: true,
        dots: false,
        navText: [
            "<i class='icon-arrow-left owl-direction'></i>",
            "<i class='icon-arrow-right owl-direction'></i>"
        ],
        responsive: galleryResponsive
    });

    $('.gallery').owlCarousel({
        margin: 10,
        nav: true,
        dots: false,
        navText: [
            "<i class='icon-arrow-left owl-direction'></i>",
            "<i class='icon-arrow-right owl-direction'></i>"
        ],
        responsive: galleryResponsive
    });

    $('.reviews').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        items: 1,
        autoHeight: true,
        navText: [
            "<i class='icon-arrow-left owl-direction'></i>",
            "<i class='icon-arrow-right owl-direction'></i>"
        ],
    });
});