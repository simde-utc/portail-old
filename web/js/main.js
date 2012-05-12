$(document).ready(function(){
  $("#lienlisteassos").click(function(e){
    e.preventDefault();
    $("#bigmenu").show();
  });
  $("body").click(function(e){
    if(!$(e.target).is('#bigmenu') && !$(e.target).is('#lienlisteassos'))
    {
      if($('#bigmenu').is(':visible'))
        $('#bigmenu').hide();
    }
  });
});