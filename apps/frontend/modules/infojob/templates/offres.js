$(document).ready(function() {


	
$( "#checkbox-1a" ).bind( "click", function(event, ui) {
	 alert('blabla');
	 //$("#listesAnnonces").empty();
     $("#listesAnnonces").append( "<ul data-role='listview' data-inset='true'><li>Test</li></ul>");
     console.log("ok");
     console.log("ok");

});


});