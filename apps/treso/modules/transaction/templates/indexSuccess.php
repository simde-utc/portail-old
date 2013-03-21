<?php use_helper('Date'); ?>

<h1>Liste des transactions de l'association <?php echo $asso?></h1>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Asso</th>
      <th>Compte</th>
      <th>Libelle</th>
      <th>Montant</th>
      <th>Commentaire</th>
      <th>Date transaction</th>
      <th>Date rapprochement</th>
      <th>Moyen</th>
      <th>Moyen P. commentaire</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($transactions as $transaction): ?>
    <tr>
      <td><a href="<?php echo url_for('transaction/edit?id='.$transaction->getId()) ?>"><?php echo $transaction->getId() ?></a></td>
      <td><?php echo $transaction->getCompteBanquaire() ?></td>
      <td><?php echo $transaction->getLibelle() ?></td>
      <td><?php echo $transaction->getMontant() ?></td>
      <td><?php echo $transaction->getCommentaire() ?></td>
      <td><?php echo format_date($transaction->getDateTransaction(), 'D', 'fr'); ?></td>
      <td><?php echo format_date($transaction->getDateRapprochement(), 'D', 'fr'); ?></td>
      <td><?php echo $transaction->getTransactionMoyen() ?></td>
      <td><?php echo $transaction->getMoyenCommentaire() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('transaction_new', $asso) ?>">Nouvelle transaction</a>