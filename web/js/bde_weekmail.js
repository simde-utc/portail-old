$(document).ready(function() {
   $('.article_text').hide();
   $('.article_name').on('click', function() {
       var text = $(this).closest('tr').next();
       text.toggle();
   });
});