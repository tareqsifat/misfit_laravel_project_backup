window.slider_reboot = function () {
    $('.owl-carousel').off().owlCarousel({
        animateOut: 'fadeOut',
        animateIn: 'flipInX',
        loop: true,
        margin: 10,
        autoplay: true,
        nav: false,
        smartSpeed:450,
        items: 1,
    })
}
