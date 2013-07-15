<?php use_helper('Date', 'Number'); ?>

<h1>Liste des transactions de l'association <?php echo $asso ?> </h1>

<?php if (count($transactions) > 5) : ?>
  <a href="<?php echo url_for('transaction_new', $asso) ?>" class="btn btn-success"><i class="icon-plus icon-black"></i>&nbsp;&nbsp;Nouvelle transaction</a>
<?php endif; ?>

<?php
$oldName = '';
$credit = 0;
$debit = 0;
foreach ($transactions as $transaction):
  if ($oldName != '' && $oldName != $transaction->getCompteBanquaire()->getNom()):
    ?>
    <caption style="font-weight: bold; padding-bottom: 10px"><?php echo $oldName . " - Total : " . format_currency($credit + $debit, '€', 'fr'); ?></caption>
    <tr class="total">
      <td></td>
      <td><strong><?php echo format_currency($credit, '€', 'fr'); ?></strong></td>
      <td><strong><?php echo format_currency($debit, '€', 'fr'); ?></strong></td>
      <td colspan="4"></td>
    </tr>
    </tbody>
    </table>
    <?php
  endif;
  if ($oldName != $transaction->getCompteBanquaire()->getNom()): // isFirst ?
    $credit = 0;
    $debit = 0;
    ?>

    <table style="margin: 20px auto;" class="table table-bordered table-striped table-transaction">
      <thead>
        <tr>
          <th>Libellé</th>
          <th>Crédit</th>
          <th>Débit</th>
          <th>Date transaction</br>Date rapprochement</th>
          <th>Moyen</br>Commentaire</th>
          <th>Actions</th>
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
        <td><a href="<?php echo url_for('transaction_show', $transaction) ?>">
            <abbr title="<?php echo $transaction->getCommentaire() ?>">
              <?php echo $transaction->getLibelle() ?>
            </abbr>
          </a></td>
        <td><?php if ($transaction->getMontant() >= 0) echo format_currency($transaction->getMontant(), '€', 'fr'); ?></td>
        <td><?php if ($transaction->getMontant() < 0) echo format_currency($transaction->getMontant(), '€', 'fr'); ?></td>
        <td><?php echo format_date($transaction->getDateTransaction(), 'D', 'fr'); ?><br /> <?php echo format_date($transaction->getDateRapprochement(), 'D', 'fr'); ?></td>
        <td><?php echo $transaction->getTransactionMoyen() ?><br /><em><?php echo $transaction->getMoyenCommentaire() ?></em></td>
        <td>
          <div class="btn-group">
            <a href="<?php echo url_for('transaction/edit?id=' . $transaction->getId()) ?>" class="btn"><i class="icon-pencil"></i>&nbsp;&nbsp;Editer</a>
            <?php echo link_to('<i class="icon-trash icon-white"></i>', 'transaction/delete?id=' . $transaction->getId(), array('method' => 'delete', 'confirm' => 'Voulez-vous vraiment supprimer cette transaction ?', 'class' => 'btn btn-danger')) ?>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  <caption style="font-weight: bold; padding-bottom: 10px"><?php echo $oldName . " - Total : " . format_currency($credit + $debit, '€', 'fr'); ?></caption>

  <tr class="total">
    <td></td>
    <td><strong><?php echo format_currency($credit, '€', 'fr'); ?></strong></td>
    <td><strong><?php echo format_currency($debit, '€', 'fr'); ?></strong></td>
    <td colspan="4"></td>
  </tr>
</tbody>
</table>

<a href="<?php echo url_for('transaction_pdf', $asso) ?>" class="btn btn-primary"><i class="icon-share-alt icon-white"></i>&nbsp;&nbsp;Export pdf</a>
<a href="<?php echo url_for('transaction_new', $asso) ?>" class="btn btn-success"><i class="icon-plus icon-white"></i>&nbsp;&nbsp;Nouvelle transaction</a>
