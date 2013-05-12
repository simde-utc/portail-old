$(document).ready(function() {
  $('#transaction-form').on('submit', function() {
    var input = $('input[name="transaction[debit]"]')
      , group = input.parent()
      ;
    if(group.find('.active').text() == 'Débit')
      input.val(true);
    else
      input.val(false);
    return true;
  });
  $('#transaction_montant').change(function(){
    var input = $('input[name="transaction[debit]"]')
      , group = input.parent()
      ;
    if(parseFloat($(this).val()) < 0)
      group.find(':nth-child(2)').trigger('click');
    else
      group.find(':nth-child(3)').trigger('click');
  });
  $('#transaction_montant').ready(function(){
    var input = $('input[name="transaction[debit]"]')
      , group = input.parent()
      ;
    if(parseFloat($('#transaction_montant').val()) < 0)
      group.find(':nth-child(2)').trigger('click');
    else
      group.find(':nth-child(3)').trigger('click');
  });
});


$(document).ready(function() {
  $('#budget_poste-form').on('submit', function() {
    var input = $('input[name="budget_poste[debit]"]')
      , group = input.parent()
      ;
    if(group.find('.active').text() == 'Débit')
      input.val(true);
    else
      input.val(false);
    return true;
  });
  $('#budget_poste_prix_unitaire').change(function(){
    var input = $('input[name="budget_poste[debit]"]')
      , group = input.parent()
      ;
    if(parseFloat($(this).val()) < 0)
      group.find(':nth-child(2)').trigger('click');
    else
      group.find(':nth-child(3)').trigger('click');
  });
  $('#budget_poste_prix_unitaire').ready(function(){
    var input = $('input[name="budget_poste[debit]"]')
      , group = input.parent()
      ;
    if(parseFloat($('#budget_poste_prix_unitaire').val()) < 0)
      group.find(':nth-child(2)').trigger('click');
    else
      group.find(':nth-child(3)').trigger('click');
  });
});

$(document).ready(function() {
  $('#budget_poste-form').on('submit', function() {
    var input = $('input[name="budget_poste[debit]"]')
      , group = input.parent()
      ;
    if(group.find('.active').text() == 'Débit')
      input.val(true);
    else
      input.val(false);
    return true;
  });
  $('#budget_poste_prix_unitaire').change(function(){
    var input = $('input[name="budget_poste[debit]"]')
      , group = input.parent()
        ;
    if(parseFloat($(this).val()) < 0)
      group.find(':nth-child(2)').trigger('click');
    else
      group.find(':nth-child(3)').trigger('click');
  });
  $('#budget_poste_prix_unitaire').ready(function(){
    var input = $('input[name="budget_poste[debit]"]')
      , group = input.parent()
      ;
    if(parseFloat($('#budget_poste_prix_unitaire').val()) < 0)
      group.find(':nth-child(2)').trigger('click');
    else
      group.find(':nth-child(3)').trigger('click');
  });
});