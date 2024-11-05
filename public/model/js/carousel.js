$(document).ready(function () {
    $('.carousel').slick({
        // dots: true,

        // infinite: true,
        // speed: 500,
        // fade: true,
        // cssEase: 'linear',
        // prevArrow: $('.prev-arrow'),
        // nextArrow: $('.next-arrow'),

        // autoplay: true,
        // autoplaySpeed: 3000,

        dots: true,
        infinite: true,
        autoplay: true,
        arrows: true,
        fade: true,
        cssEase: 'linear',
        autoplaySpeed: 3000,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 360,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true,
                    arrows: false,
                }
            },
            {
                breakpoint: 361,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 412,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
        ]
    });
});

$(document).ready(function () {
    $('.carousel-prestation').slick({

        prevArrow: $('.prev-arrow-prestation'),
        nextArrow: $('.next-arrow-prestation'),

        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        speed: 1500,
        slidesToShow: 5,
        slidesToScroll: 1,
        
        responsive: [
            {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
            }
            },
            {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
            },
            {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
            }
        ]

    });
});

$(document).ready(function () {
    $('.carousel-partenaire').slick({
        infinite: true,

        prevArrow: $('.prev-arrow-partenaire'),
        nextArrow: $('.next-arrow-partenaire'),

        autoplay: true,
        autoplaySpeed: 2000,
        speed: 1000,
        slidesToShow: 6,
        slidesToScroll: 1,

        responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
        ]

    });
});

$(document).ready(function () {
    $('.carousel-infoUtils').slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 2000,
        fade: true,
        cssEase: 'linear',

        autoplay: true,
        autoplaySpeed: 2000,
    });
});
