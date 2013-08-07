/* web/js/eventform.js */
newfieldscount = 0;

function addNewField(num){
  return $.ajax({
    type: 'GET',
    url: '/add?num='+num,
    async: false
  }).responseText;
}

var removeNew = function(){
  $('.removenew').click(function(e){
    e.preventDefault();
    $(this).parent().remove();
  })
};


$(document).ready(function(){
  $('#addoccurrence').click(function(e){
    e.preventDefault();
    $('#maListe').append(addNewField(newfieldscount));
    newfieldscount = newfieldscount + 1;
    $('.removenew').unbind('click');
    removeNew();
  });
});