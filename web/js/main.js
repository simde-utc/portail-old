$(document).ready(function(){
  $("#lienlisteassos").click(function(e){
    e.preventDefault();
    $("#bigmenu").toggle();
  });
  
  $("body").click(function(e){
    if(!$(e.target).is("#bigmenu") && $(e.target).parents("#bigmenu").length == 0 && !$(e.target).is("#lienlisteassos"))
      $("#bigmenu:visible").hide();
  });
  
   $('.well').tooltip({
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