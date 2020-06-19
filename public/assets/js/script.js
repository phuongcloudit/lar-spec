$(document).ready(function () {

    $(".menu-mobile").click(function () {
      if ($("#header-nav").hasClass("active")) {
        $('.header-nav').removeClass("active");
        $('.header-nav').hide();
      } else {
        $('.header-nav').addClass("active");
        $('.header-nav').show();
      }
    });
  });