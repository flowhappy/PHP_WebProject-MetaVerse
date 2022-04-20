function back_top() {
  $("html,body").animate({scrollTop:$("#top").offset().top},300);
}
$(document).scroll(function () {
  if (!($(document).scrollTop())) {
    $("nav").css('opacity', '0');
    $(".back_top").css('opacity', 0);
  } else {
    $("nav").css('opacity', '1');
    $(".back_top").css('opacity', 1);
  }
})

function get_more() {
  $("html,body").animate({scrollTop:$("#hot").offset().top},300);
}
