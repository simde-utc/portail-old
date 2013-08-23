$(function () {
    $('.nom-transaction').tooltip({placement: 'right', html: true});
    $('.moyen-transaction').tooltip({placement: 'left'});
    $('#compte_chooser').change(function() {
        var val = $(this).val();
        var pos = compte_location.lastIndexOf('/');
        var loc = compte_location.substring(0, pos+1) + val;
        document.location.replace(loc);
    });
});