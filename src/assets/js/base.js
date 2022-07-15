$(function () {
  /**
   * header__menu 実装
   * 背景透過
   * navメニュー表示
   */
  $(".header__btn").click(function () {
    $(".header__btn").toggleClass("active");
    $(".header__nav").toggleClass("active");
    $(".header__bg").toggleClass("active");
  });

  //navメニューをクリックしたらheader__menuのactiveクラスを解除する処理
  $('a[href^="#"]').on("click", function () {
    $(".header__btn").removeClass("active");
    $(".header__nav").removeClass("active");
    $(".header__bg").removeClass("active");

    const href = $(this).attr("href");
    const target = $(href == "#" || href == "" ? "html" : href);
    const position = target.offset().top;
    let speed = 500;
    $("html , body").animate({ scrollTop: position }, speed, "swing");
    return false;
  });

  //topへ戻るボタン実装
  const topPage = $(".topPage");
  topPage.hide();
  $(window).scroll(function () {
    if ($(this).scrollTop() > 80) {
      topPage.fadeIn();
    } else {
      topPage.fadeOut();
    }
  });
  topPage.click(function () {
    $("body , html").animate({ scrollTop: 0 }, 500);
    return false;
  });

  //アコーディオンメニュー実装
  $(".js-qa").click(function () {
    $(this).next().slideToggle(200);
    $(this).find("span").toggleClass("active");
  });

  $(window).scroll(function () {
    let pageHeight = $(document).innerHeight();
    let windowHeight = $(window).innerHeight();
    let pageBottom = pageHeight - windowHeight;
    let ad = $('.ad');
    ad.hide();
    if (pageBottom <= $(window).scrollTop()) {
        ad.fadeOut();
    } else {
        ad.fadeIn();
    }
  });
});







