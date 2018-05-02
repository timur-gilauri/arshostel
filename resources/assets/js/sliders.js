$(function () {
    let galleryList = $('.gallery'),
        reviewsList = $('.reviews'),
        bigScreen = $(window).width() > 64 * 16,
        slidesCount = bigScreen ? 3 : 1,
        slideWidth = galleryList.width() / slidesCount,
        gallerySettings = {
            adaptiveHeight: true,
            slideWidth: slideWidth,
            minSlides: slidesCount,
            maxSlides: slidesCount,
            pager: false,
            controls: true,
            infiniteLoop: false,
            onSliderLoad: function () {
                $('.bx-wrapper').find('.bx-clone').children('a').removeAttr('data-fancybox');
            },
            moveSlides: 1
        };

    let reviewsSliderSettings = {
        adaptiveHeight: true,
        minSlides: 1,
        maxSlides: 1,
        pager: false,
        controls: true
    };

    if ($(window).width() <= 420 || $(window).height() < 420) {
        gallerySettings = {
            ...gallerySettings,
            prevSelector: '.gallery-bx-prev',
            nextSelector: '.gallery-bx-next',
        };
        reviewsSliderSettings = {
            ...reviewsSliderSettings,
            prevSelector: '.reviews-bx-prev',
            nextSelector: '.reviews-bx-next',
        }
    }


    let reviewsSlider = reviewsList.bxSlider(reviewsSliderSettings);
    let gallerySlider = galleryList.bxSlider(gallerySettings);

    $(window).on('orientationchange', function () {
        reviewsSlider.reloadSlider(reviewsSliderSettings);
        gallerySlider.reloadSlider(gallerySettings);
    });
});