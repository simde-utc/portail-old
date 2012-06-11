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
});