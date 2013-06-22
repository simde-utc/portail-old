$(function() {
    $('#avance_treso_asso_id').change(function() {
        var val = $(this).val();
        var loc = document.location.toString().split('/to/')[0];
        document.location.replace(loc + '/to/' + val);
    })
});