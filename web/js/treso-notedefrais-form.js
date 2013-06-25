$(document).ready(function() {
    $('#liste-achats input:checkbox').change(function() {
        var montant = 0;
        var name_set = $('#note_de_frais_nom').val() != '';
        var nb = 0;
        $('#liste-achats input:checkbox:checked').each(function() {
            montant += parseFloat($(this).attr('data-montant'));
            // Si le nom n'est pas déjà saisi on rentre celui correspond au premier achat coché
            if (!name_set) {
                $('#note_de_frais_nom').val($(this).attr('data-nom'));
                name_set = true;
            }
            nb += 1;
        });
        // si il n'y a pas d'acchats cochés on reset le nom
        if (nb == 0)
            $('#note_de_frais_nom').val('');

        var txt_montant = montant.toFixed(2).replace('.', ',') + ' €';
        $('#montant-total').html(txt_montant);
    });
    $('#liste-achats input:checkbox:first').change();
});