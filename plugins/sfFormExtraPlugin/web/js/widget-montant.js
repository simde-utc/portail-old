function init_input_montant(id) {
    // on initialise la valeur
    value = parseFloat($(id+'_montant').val());
    if (!isNaN(value))
        $(id+'_montant').val(Math.abs(value).toFixed(2));

    $(id+'_montant').keyup(function() {
        if ($(this).val().indexOf('-') == 0) // commence par un -
            set_state('debit');
    });

    var set_state = function(state) {
        var hidden = $(id+'_hidden_state');
        if (state == hidden.val()) // si l'état n'est pas modifié on ne fait rien
            return;

        if (state == 'credit') {
            hidden.val('credit');
            $(id+'_credit_btn').addClass('active');
            $(id+'_debit_btn').removeClass('active');
        } else {
            hidden.val('debit');
            $(id+'_debit_btn').addClass('active');
            $(id+'_credit_btn').removeClass('active');
        }
    };
    set_state((!isNaN(value) && value >= 0) ? 'credit' : 'debit');

    $(id+'_credit_btn').click(function() {
        set_state('credit');
    });
    $(id+'_debit_btn').click(function() {
        set_state('debit');
    });
}

