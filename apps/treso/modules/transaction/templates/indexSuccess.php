<?php use_helper('Date', 'Number'); ?>
<?php use_javascript('treso-transactions-graphisme.js') ?>
<script type="text/javascript">
    var compte_location = '<?php echo url_for('transaction_compte', $compte) ?>';
</script>

<h1 style="float:left;">Transactions du compte <?php echo sfOutputEscaperGetterDecorator::unescape($chooser->render('compte_chooser', $compte->getPrimaryKey())) ?></h1>

<div style="float:right;">
  <a href="<?php echo url_for('transaction_new_with_compte', $compte) ?>" class="btn btn-success"><i class="icon-plus icon-white"></i>&nbsp;&nbsp;Nouvelle transaction</a>
<a href="<?php echo url_for('transaction_pdf', $compte) ?>" class="btn btn-primary"><i class="icon-share-alt icon-white"></i>&nbsp;&nbsp;Export pdf</a>
</div>
<style type="text/css">
.table-transaction select {
  border: 0;
  margin-bottom: 0;
  width: 99%;
}
.table-transaction input {
  border: 0;
  margin-bottom: 0;
  width: 99%;
}
</style>
<div style="clear:both; text-align:center;">
    <strong><?php echo "Actuel  " . format_currency($compte->getSoldeActuel(), '€', 'fr'); ?></strong>
    <?php echo " | Rapproché  " . format_currency($compte->getSoldeRapproche(), '€', 'fr'); ?>
    <?php echo " | Minimum projeté  " . format_currency($compte->getSoldeProjeteMinimum(), '€', 'fr'); ?>
</div>
    <table style="margin: 20px auto;" class="table table-bordered table-striped table-transaction table-hover">
      <thead>
        <tr>
          <th><select><option>Date</option><option>Début</option><option>Fin</option></select></th>
          <th><input type="text" placeholder="Libellé"/></th>
          <th><input type="text" placeholder="Poste"/></th>
          <th>Crédit</th>
          <th>Débit</th>
          <th>Solde</th>
          <th><input type="text" placeholder="Moyen"/></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
<?php
$credit = 0;
$debit = 0;
$solde = $compte->getSoldeActuel();
$prec = 0;
foreach ($transactions as $transaction):
  if ($prec)
    $solde -= $prec->getMontant();
  $prec = $transaction;
  $date = $transaction->getDateTimeObject('date_transaction');
  ?>
      <?php if ($transaction->getMontant() >= 0) : ?>
        <tr class="recette">
          <?php $credit += $transaction->getMontant() ?>
        <?php else : ?>
        <tr class="depense">
          <?php $debit += $transaction->getMontant() ?>
        <?php endif; ?>
        <td class="reduce"> <?php // DATE ---- ?>
        <?php echo format_date($transaction->getDateTransaction(), 'D', 'fr'); ?>
          <?php if($transaction->getDateRapprochement()): ?>
          <i class="icon icon-check"></i>
        <?php endif; ?>
        </td>
        <td class="expand"> <?php // LIBELLE et lien vers le detail ---- ?>
          <a href="<?php echo url_for('transaction_show', $transaction) ?>" title="<?php echo nl2br($transaction->getCommentaire()) ?>" class="nom-transaction">
              <?php echo $transaction->getLibelle() ?>
          </a></td>
        <td class="reduce"> <?php // NOM DU POSTE BUDGETAIRE et lien vers le budget ---- ?>
          <?php $poste = $transaction->getBudgetPoste();
            if($poste): ?>
            <?php echo link_to($poste->getBudget()->getSemestre().' / '.$poste->getNom(), 'budget_show', array('id'=>$poste->getBudgetId())) ?>
          <?php else: ?>
            -
          <?php endif; ?>
        </td>
        <?php // MONTANT (crédit ou débit) ---- ?>
        <td class="reduce"><?php if ($transaction->getMontant() >= 0) echo format_currency($transaction->getMontant(), '', 'fr'); ?></td>
        <td class="reduce"><?php if ($transaction->getMontant() < 0) echo format_currency($transaction->getMontant(), '', 'fr'); ?></td>
        <?php // SOLDE ---- ?>
        <td class="reduce"><?php echo format_currency($solde, '', 'fr') ?></td>
        <?php // MOYEN DE PAIEMENT ---- ?>
        <td class="reduce">
          <?php $comm = $transaction->getMoyenCommentaire();
        if(strlen($comm) > 5): ?>
          <span class="moyen-transaction" title="<?php echo $comm ?>">
            <?php echo $transaction->getTransactionMoyen() ?>
          </span>
        <?php else: ?>
          <?php echo $transaction->getTransactionMoyen() ?>
          <?php if($comm) echo ' : ', $comm ?>
        <?php endif; ?>
        <?php // ACTIONS ---- ?>
        <td class="reduce">
          <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu pull-right">
              <?php if(!$transaction->getDateRapprochement()): ?>
              <li tabindex="-1">
                <?php echo link_to('<i class="icon-check"></i> Rapprocher', 'transaction_rapprocher', $transaction, array('tabindex'=>'-1')) ?>
              </li>
              <?php endif; ?>
              <li tabindex="-1"><?php //bouton éditer; on demande confirmation si la transaction est rapprochée
                    $options = array('tabindex'=>'-1');
                    if ($transaction->getDateRapprochement())
                      $options['confirm'] = "Cette transaction est déjà rapprochée.\nÊtes vous sûr de vouloir la modifier ?";
                    echo link_to('<i class="icon-pencil"></i> Éditer', 'transaction/edit?id=' . $transaction->getId(), $options) ?></li>
              <li tabindex="-1"><?php echo link_to('<i class="icon-trash"></i> Supprimer', 'transaction/delete?id=' . $transaction->getId(), array('method' => 'delete', 'confirm' => 'Voulez-vous vraiment supprimer cette transaction ?', 'tabindex'=>'-1')) ?></li>
            </ul>
          </div>
        </td>
      </tr>
<?php endforeach; ?>

  <tr class="total">
    <td colspan="3"></td>
    <td><strong><?php echo format_currency($credit, '€', 'fr'); ?></strong></td>
    <td><strong><?php echo format_currency($debit, '€', 'fr'); ?></strong></td>
    <td colspan="3"></td>
  </tr>
</tbody>
</table>
