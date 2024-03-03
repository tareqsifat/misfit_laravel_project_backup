$(window).on('scroll', function () {
    var wSize = $(window).width();
    if (wSize > 1 && $(this).scrollTop() > 1) {
        $('header').addClass('sticky');
    } else {
        $('header').removeClass('sticky');
    }
});

$('#default').zenith({
    layout: 'default' , 
    slideSpeed: 450, 
    autoplaySpeed: 3000,
    
});

if ($(window).width() < 992) {
    $('a.nav-link').click(function(){
        $('.navbar.navbar-expand-lg .navbar-collapse').slideUp();
        $('.navbar.navbar-expand-lg .navbar-collapse').removeClass('show');
    });
}