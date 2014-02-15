function fullscreenSizing(){
  $(".photo_viewer").css("position","fixed");
    $(".photo_viewer").css("width", $(window).width());
    $(".photo_viewer").css("height", $(window).height());
}

$(document).keydown(function(e){
  if (e.keyCode == 37) // prev
    $(".prevpict")[0].click();
  if (e.keyCode == 39) // next
    $(".nextpict")[0].click();
})

$(document).keyup(function(e){
  if (e.keyCode == 27) // escape
  $(".photo-galery-link")[0].click();
})

$(function(){
  $(window).resize(fullscreenSizing)
  fullscreenSizing();
})
