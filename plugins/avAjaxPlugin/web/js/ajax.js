$(document).ready(function() {
    $('body').prepend("<div id='canvasloader-container'></div>");
    $('body').prepend("<input type='hidden' id='avAjax_current_update_container' value=''/>");
    createLoader('canvasloader-container');
    $("form.ajax").live('submit',function(event) {
        $('#canvasloader-container').fadeIn();
        event.preventDefault();
        var update = $(this).attr("update")?$(this).attr("update"):$('#avAjax_current_update_container').val();
        $('#avAjax_current_update_container').val(update);
        var form = $(this);

        ajaxFormSubmit(form,update);
        return false;
    });
    $("a.ajax").live('click',function(event) {
        $('#canvasloader-container').fadeIn();
        event.preventDefault();
        var update = $(this).attr("update")?$(this).attr("update"):$('#avAjax_current_update_container').val();
        $('#avAjax_current_update_container').val(update);
        var link = $(this).attr("href");
        ajaxLink(link,update);
        return false;
    });
});
function ajaxFormSubmit(form,update){
    $.ajax({
        url: $(form).attr('action'),
        context: document.body,
        data: $(form).serialize(),
        type: $(form).attr('method'),
        success: function(jsonResponse){
            ajaxify(jsonResponse, update);
        }
    });
}

function ajaxLink(link,update){
    $.ajax({
        url: link,
        context: document.body,
        type: "GET",
        success: function(jsonResponse){
            ajaxify(jsonResponse, update);
        },
        error: function(jsonResponse){
            alert("Il semble s'êre produit une erreur");
            $('#canvasloader-container').fadeOut();
        }
    });
}

function ajaxify(jsonResponse, update){
    $(document).trigger(jQuery.Event('ajaxcall'));
    if(jsonResponse.substring(0,1)=="{" && jsonResponse.substring(jsonResponse.length-1)=="}"){
        var json = eval("("+jsonResponse+")");
        if(json.update != undefined){
            update = json.update;
            $('#avAjax_current_update_container').val(update);
        }
        // check if a callback is given in the response
        if(json.hasOwnProperty("callback")){
            $.post(json.callback, 
            {
                params : json.data
                },
            function(data){
                $("#"+update).html(data);
            });
        }else{//if no callback has been given, we put data in the element to update
            $("#"+update).html(json.data);
        }
        if(json.hasOwnProperty("callbackjs")){
            eval(json.callbackjs)();
        }
    }else{
        $("#"+update).html(jsonResponse);
    }
    
    $('#canvasloader-container').fadeOut();

}

function createLoader(id){
    $('#canvasloader-container').html("<img src='/images/ajax-loader.gif'/>");
}