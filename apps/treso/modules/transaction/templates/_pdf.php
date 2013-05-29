<?php use_helper('Date'); ?>
<?php use_helper('Number'); ?>

<style>
  table {
    font-size: 10pt;
  }
  .bold { font-weight: bold; }
  td, th {
    border: 1px solid black;
    padding: 5px;
    text-align: center;
  }
  th.first-child, td.first-child {
    text-align: justify;
  }
</style>

<h1>Liste des transactions de l'association <?php echo $asso ?> </h1>

<?php if (count($transactions) > 20) : ?>
  <a href="<?php echo url_for('transaction_new', $asso) ?>" class="btn btn-success"><i class="icon-plus icon-black"></i>&nbsp;&nbsp;Nouvelle transaction</a>
<?php endif; ?>

<?php
$oldName = '';
$credit = 0;
$debit = 0;
foreach ($transactions as $transaction):
  if ($oldName != '' && $oldName != $transaction->getCompteBanquaire()->getNom()):
    ?>
    <tr>
      <td><?php echo $oldName ?></td>
      <td><strong><?php echo format_currency($credit,'€','fr') ; ?></strong></td>
      <td><strong><?php echo format_currency($debit,'€','fr') ; ?></strong></td>
      <td colspan="2"><?php echo "Total : " . format_currency($credit + $debit,'€','fr'); ?></td>
    </tr>
    </tbody>
    </table>
    <br />
    <br />
    <?php
  endif;
  if ($oldName != $transaction->getCompteBanquaire()->getNom()): // isFirst ?
    $credit = 0;
    $debit = 0;
    ?>

    <table style="margin: 20px auto;" class="table table-bordered table-striped table-transaction">
      <thead>
        <tr class="bold">
          <th class="first-child">Libellé</th>
          <th>Crédit</th>
          <th>Débit</th>
          <th>Rapprochement</th>
          <th>Moyen<br />Commentaire</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $oldName = $transaction->getCompteBanquaire()->getNom();

      endif;
      ?>
      <?php if ($transaction->getMontant() >= 0) : ?>
        <tr class="recette">
          <?php $credit += $transaction->getMontant() ?>
        <?php else : ?>
        <tr class="depense">
          <?php $debit += $transaction->getMontant() ?>
        <?php endif; ?>
        <td class="first-child">
          <?php echo $transaction->getLibelle() ?>
          <?php if($transaction->getCommentaire()): ?>
            <div style="font-size: 0.8em;">> <?php echo $transaction->getCommentaire() ?></div>
          <?php endif ?>
        </td>
        <td><?php if ($transaction->getMontant() >= 0) echo format_currency($transaction->getMontant(),'€','fr'); ?></td>
        <td><?php if ($transaction->getMontant() < 0) echo format_currency($transaction->getMontant(),'€','fr'); ?></td>
        <td><?php if($transaction->getDateRapprochement()): ?>Oui<?php else: ?>Non<?php endif ?></td>
        <td><?php echo $transaction->getTransactionMoyen() ?>
          <?php if($transaction->getMoyenCommentaire()): ?>
          <br /><em><?php echo $transaction->getMoyenCommentaire() ?></em>
          <?php endif ?>
        </td>
      </tr>
    <?php endforeach; ?>
 

  <tr>
    <td><?php echo $oldName ?></td>
    <td><strong><?php echo format_currency($credit,'€','fr') ; ?></strong></td>
    <td><strong><?php echo format_currency($debit,'€','fr') ; ?></strong></td>
    <td colspan="2"><?php echo "Total : " . format_currency($credit + $debit,'€','fr'); ?></td>
  </tr>
</tbody>
</table>