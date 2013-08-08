/* web/js/sportform.js */
newfieldscount = 0;

function addNewField(num){
  return $.ajax({
    type: 'GET',
    url: '/profile/add?num='+num,
    async: false
  }).responseText;
};

function appelAdd(){
    $('#newSport').append(addNewField(newfieldscount));
    newfieldscount = newfieldscount + 1;
};

function deleteOcc(fieldtoremove){
    $("#sport_new_"+fieldtoremove+"_sport_id").remove();
    $(this).parent.remove();
};

