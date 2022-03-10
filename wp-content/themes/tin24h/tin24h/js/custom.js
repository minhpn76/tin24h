$(document).ready(function () {

    $('.banner-slides').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        infinite: false,
        arrows: false,
    })


    $('.slide-top-feeds ul').slick({
        slidesToShow: 2.4,
        slidesToScroll: 1,
        dots: false,
        infinite: false,
        variableWidth: true,
        arrows: true,
        prevArrow: '<i class="slick-prev fa fa-chevron-left">',
        nextArrow: '<i class="slick-next fa fa-chevron-right">',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1.8,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 1.3,
                    variableWidth: false,
                    dots: false,
                    arrows: false
                }
            },
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 1.1,
                    dots: false,
                    arrows: false,
                    variableWidth: false,
                }
            },
        ]

    })

    $('.block-bottom--slides').slick({
        slidesToShow: 2.9,
        slidesToScroll: 1,
        dots: true,
        infinite: false,
        arrows: true,
        prevArrow: '<i class="slick-prev fa fa-arrow-left">',
        nextArrow: '<i class="slick-next fa fa-arrow-right">',
        responsive: [
            {
                breakpoint: 1281,
                settings: {
                    slidesToShow: 2.8,
                    slidesToScroll: 1,
                }
            },

            {
                breakpoint: 1150,
                settings: {
                    slidesToShow: 2.4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 2.3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 900,
                settings: {
                    arrows: false,
                    dots: false,
                    slidesToShow: 2.7,
                }
            },
            {
                // for screen 414
                breakpoint: 500,
                settings: {
                    slidesToShow: 1.7,
                    slidesToScroll: 1,
                }
            },
            {
                // for screen 414
                breakpoint: 450,
                settings: {
                    slidesToShow: 1.5,
                    slidesToScroll: 1,
                }
            },

            {

                // for screen 375
                breakpoint: 400,
                settings: {
                    slidesToShow: 1.3,
                    slidesToScroll: 1,
                }
            },

            {
                // for screen 320
                breakpoint: 375,
                settings: {
                    slidesToShow: 1.1,
                    slidesToScroll: 1,
                }
            },


        ]
    })

})


$(document).on('click', '.js-toggle-dropdownmenu', function () {
    $('.header-dropdown').slideToggle();
});

$(document).on('click', '.btn-active-mobile-search', function () {
    $('.form-mobile-search').slideToggle();
})

$(document).ready(function () {
    if (screen.width < 769) {
        let menuHeight = $('.header-mobile').outerHeight();
        console.log(menuHeight)

        $('.header .header_layout').css('height', menuHeight)


    }
})