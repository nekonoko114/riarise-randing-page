$(function() {
    $('.header__btn').click(function() {
        $('.header__btn').toggleClass('active');
        $('.header__nav').toggleClass('active');
        $('.header__bg').toggleClass('active');
    });
    $('a[href^="#"]').on('click',function() {
        $('.header__btn').removeClass('active');
        $('.header__nav').removeClass('active');
        $('.header__bg').removeClass('active');
    });

    const topPage = $('.topPage');
    topPage.hide();

    $(window).scroll(function() {
        if ( $(this).scrollTop() > 80 ) {
            topPage.fadeIn();
        } else {
            topPage.fadeOut();
        }
    });
    topPage.click( function() {
        $('body , html').animate({scrollTop : 0},500);
        return false;
    });
});