$(document).keydown(function(e){
    if (e.keyCode == 37) // prev
      $(".prevpict")[0].click();
    if (e.keyCode == 39) // next
      $(".nextpict")[0].click();
    })

function fullscreenSizing(){
  $(".photo_viewer").css("position","fixed");
    $(".photo_viewer").css("top","0px");
    $(".photo_viewer").css("left","0px");
    $(".photo_viewer").css("width", $(window).width());
    $(".photo_viewer").css("height", $(window).height());

    var ratio = $(".main-image img").height()/($(".photo_viewer").height()-10);
    if(ratio>1){
      $(".main-image img").height($(".main-image img").height()/ratio);
      $(".main-image img").width($(".main-image img").width()/ratio);
    }
}

function switchFullScreen(){
    $(".photo_viewer .span2").removeClass('span2').addClass('span2'); 
    $(".photo_viewer .span6").removeClass('span6').addClass('span10');

  $(document).keyup(function(e){
    if (e.keyCode == 27) // prev
      $(".photo-fullscreen-button")[0].click();
  })
    
    $.each(
      $(".photo-samegalery"),
      function(osef, link){
        $(link).attr("href", $(link).attr('href') + "#fullscreen");
      })
    setTimeout(function () {
      $(".photo-fullscreen-button").attr("href", location.href.replace(location.hash,""));
      $(window).on('hashchange', function() {
          window.location=location.href.replace(location.hash,"");
      })

      }
    , 100);
    $(window).resize(fullscreenSizing)
    fullscreenSizing();
    setTimeout(fullscreenSizing, 10)

  }

  $(function(){
    if(window.location.hash)
      switchFullScreen();
  })