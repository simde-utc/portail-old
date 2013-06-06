<?php use_helper('Date', 'Number') ?>
<h1>Liste des chèques</h1>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Libellé</th>
      <th>Montant</th>
      <th>Date transaction</br>Date rapprochement</th>
      <th>Moyen</br>Commentaire</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($cheques as $transaction): ?>
    <tr>
      <td>
        <a href="<?php echo url_for('transaction_show', $transaction) ?>">
          <abbr title="<?php echo $transaction->getCommentaire() ?>">
            <?php echo $transaction->getLibelle() ?>
          </abbr>
        </a>
        <?php if($transaction->getDateRapprochement()): ?>
          <span class="label label-success">Encaissé</span>
        <?php else: ?>
          <span class="label label-warning">En attente</span>
        <?php endif ?>
      </td>
      <td><?php echo format_currency($transaction->getMontant(), '€', 'fr'); ?></td>
      <td><?php echo format_date($transaction->getDateTransaction(), 'D', 'fr'); ?><br /> <?php echo format_date($transaction->getDateRapprochement(), 'D', 'fr'); ?></td>
      <td><?php echo $transaction->getTransactionMoyen() ?><br /><em><?php echo $transaction->getMoyenCommentaire() ?></em></td>
    </tr>
    <?php endforeach; ?>    
  </tbody>
</table>
