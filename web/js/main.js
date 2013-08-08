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
  
  setInterval(function(){
    var d = new Date();
    var mois = new Array('janvier', 'fevrier', 'mars', 'avril', 'mai','juin','juillet','aout','septembre','octobre','novembre','decembre');
    var heure = d.getHours();
    var min = d.getMinutes();
    if (heure<10) heure = '0'+heure;
    if (min<10)	min = '0'+min;
    $(".horloge").html( d.getDate() + ' ' + mois[d.getMonth()] + ' ' +d.getFullYear() + ' <span class="barre">' + heure + ':' + min +'</span>');
  }, 1000);
  
  $(".ejs").each(function(){
    var a = $(this).html() + "@assos.utc." + "fr";
    $(this).html(a);
    $(this).attr("href", "mailto:" + a);
    $(this).css("visibility", "visible");
  });
});