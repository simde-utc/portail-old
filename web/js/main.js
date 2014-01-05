$(document).ready(function(){
  $("#lienlisteassos").click(function(e){
    e.preventDefault();
    $("#bigmenu").toggle();
  });
  
  $("body").click(function(e){
    if(!$(e.target).is("#bigmenu") && $(e.target).parents("#bigmenu").length == 0 && !$(e.target).is("#lienlisteassos"))
      $("#bigmenu:visible").hide();
  });

  $("#all_but").click(function(e){
    e.preventDefault();
    $("#all_but").css("border-bottom", "3px solid black");
    $("#articles_but").css("border-bottom", "none");
    $("#events_but").css("border-bottom", "none");
    
    $("#my_flux div.articles_abonnements").show();
    $("#my_flux div.events_abonnements").show();
  });
  
  $("#articles_but").click(function(e){
    e.preventDefault();
    $("#all_but").css("border-bottom", "none");
    $("#articles_but").css("border-bottom", "3px solid black");
    $("#events_but").css("border-bottom", "none");
    
    $("#my_flux div.articles_abonnements").show();
    $("#my_flux div.events_abonnements").hide();
  });
  
  $("#events_but").click(function(e){
    e.preventDefault();
    $("#all_but").css("border-bottom", "none");
    $("#articles_but").css("border-bottom", "none");
    $("#events_but").css("border-bottom", "3px solid black");
    
    $("#my_flux div.articles_abonnements").hide();
    $("#my_flux div.events_abonnements").show();
  });

   $(".well").tooltip({
     selector: "a[rel=tooltip]"
   });
    
  $('.dropdown-toggle').dropdown();
  
  if ($.fn.datetimepicker) {
    $('.datepicker').datetimepicker({
      dateFormat: "dd/mm/yy",
      timeFormat: "HH:mm"
    });
  }
  
  $(".ejs").each(function(){
    var a = $(this).html() + "@assos.utc." + "fr";
    $(this).html(a);
    $(this).attr("href", "mailto:" + a);
    $(this).css("visibility", "visible");
  });
  
  $("img.avatar").error(function() {
    if($(this).attr("src") != "/images/default.jpg"){
      $(this).attr("src", "/images/default.jpg");
    }
  });

  if(window.Select2)
    $(".select2").select2({width: 'resolve'});
});
