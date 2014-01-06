function goBig(){
    $('.big-ass-pict').css('display','block')
    $('.cute-small-pict').css('display','none')
    $('.thumb-container').removeClass('span3').addClass('span8').css('text-align','center')
    $('.changesize').unbind('click').click(goSmall).html("Miniatures")
    return false;
  }
  function goSmall(){
    $('.big-ass-pict').css('display','none')
    $('.cute-small-pict').css('display','block')
    $('.thumb-container').removeClass('span8').addClass('span3').css('text-align','center')
  	$('.changesize').unbind('click').click(goBig).html("Photos pleine taille")
  	return false;
  }
  $(function(){
  	goSmall();
  	$('.big-ass-pict').lazyload();
  	$('.cute-small-pict').lazyload();
  })