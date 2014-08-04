$(document).ready(function() {

  $(document).on('change','#selectSalle',function(){
     var href= $('#selectSalle option:selected').val();
     window.location = href;
  });
  
  
 
});

