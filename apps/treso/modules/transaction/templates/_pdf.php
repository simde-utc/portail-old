<?php use_helper('Date'); ?>
<?php use_helper('Number'); ?>

<style>
  table {
    font-size: 10pt;
    margin: 20px auto;
  }
  .bold { font-weight: bold; }
  td, th {
    border: 1px solid black;
    padding: 5px;
    text-align: center;
    white-space: nowrap;
  }
  th.date, td.date {
    width: 12%;
  }
  th.libelle, td.libelle {
    text-align: justify;
    width: 32%;
  }
  th.montant, td.montant {
    width: 14%;
  }
  th.rapproche, td.rapproche {
    width: 12%;
  }
  th.moyen, td.moyen {
    width: 16%;
  }
</style>
<p>&nbsp;</p>
<table>
  <thead>
    <tr class="bold">
      <th class="date">Date</th>
      <th class="libelle">Libellé</th>
      <th class="montant">Crédit</th>
      <th class="montant">Débit</th>
      <th class="rapproche">Rapproché</th>
      <th class="moyen">Moyen<br />Commentaire</th>
    </tr>
  </thead>
  <tbody>
<?php
$oldName = '';
$credit = 0;
$debit = 0;
foreach ($transactions as $transaction): ?>
    <?php if ($transaction->getMontant() >= 0) : ?>
      <tr class="recette">
        <?php $credit += $transaction->getMontant() ?>
      <?php else : ?>
      <tr class="depense">
        <?php $debit += $transaction->getMontant() ?>
      <?php endif; ?>

      <td class="date"><?php echo date('Y-m-d', strtotime($transaction->getDateRapprochement())) ?></td>
      <td class="libelle">
        <?php echo $transaction->getLibelle() ?>
        <?php if($transaction->getCommentaire()): ?>
          <div style="font-size: 0.8em;">> <?php echo $transaction->getCommentaire() ?></div>
        <?php endif ?>
      </td>
      <td class="montant"><?php if ($transaction->getMontant() >= 0) echo format_currency($transaction->getMontant(),'€','fr'); ?></td>
      <td class="montant"><?php if ($transaction->getMontant() < 0) echo format_currency($transaction->getMontant(),'€','fr'); ?></td>
      <td class="rapproche"><?php if($transaction->getDateRapprochement()): ?>Oui<?php else: ?>Non<?php endif ?></td>
      <td class="moyen"><?php echo $transaction->getTransactionMoyen() ?>
        <?php if($transaction->getMoyenCommentaire()): ?>
        <br /><em><?php echo $transaction->getMoyenCommentaire() ?></em>
        <?php endif ?>
      </td>
    </tr>
<?php endforeach; ?> 

<tr>
  <td></td>
  <td></td>
  <td><strong><?php echo format_currency($credit,'€','fr') ; ?></strong></td>
  <td><strong><?php echo format_currency($debit,'€','fr') ; ?></strong></td>
  <td colspan="2"><?php echo "Total : " . format_currency($credit + $debit,'€','fr'); ?></td>
</tr>

</tbody>
</table>