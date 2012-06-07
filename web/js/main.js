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
    })
});