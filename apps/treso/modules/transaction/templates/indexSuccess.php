<?php use_helper('Date'); ?>

<h1>Liste des transactions de l'association <?php echo $asso?> </h1>

<table style="margin: 20px auto;" class="table table-bordered table-striped">
  <thead>
    <?php if(TransactionTable::getInstance()->getActiveCount($asso) > 20) {?>
      <a href="<?php echo url_for('transaction_new', $asso) ?>" class="btn btn-success"><i class="icon-plus icon-black"></i>&nbsp;&nbsp;Nouvelle transaction</a>
    <?php } ?>
    <tr>
      <th>Compte</th>
      <th>Libelle</th>
      <th>Crédit</th>
      <th>Débit</th>  
      <th>Commentaire</th>
      <th>Date transaction</th>
      <th>Date rapprochement</th>
      <th>Moyen</th>
      <th>Moyen P. commentaire</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($transactions as $transaction): ?>
    <?php if($transaction->getMontant() >= 0) : ?>
    <tr class="recette">
      <?php else : ?>
    <tr class="depense">
      <?php endif; ?>
      <td><?php echo $transaction->getCompteBanquaire() ?></td>
      <td><?php echo $transaction->getLibelle() ?></td>
      <td><?php if($transaction->getMontant() >= 0) echo $transaction->getMontant(); ?></td>
      <td><?php if($transaction->getMontant() < 0) echo $transaction->getMontant(); ?></td>
      <td><?php echo $transaction->getCommentaire() ?></td>
      <td><?php echo format_date($transaction->getDateTransaction(), 'D', 'fr'); ?></td>
      <td><?php echo format_date($transaction->getDateRapprochement(), 'D', 'fr'); ?></td>
      <td><?php echo $transaction->getTransactionMoyen() ?></td>
      <td><?php echo $transaction->getMoyenCommentaire() ?></td>
      <td>
          <div class="btn-group">
            <a href="<?php echo url_for('transaction/edit?id='.$transaction->getId()) ?>" class="btn"><i class="icon-pencil"></i>&nbsp;&nbsp;Editer</a>
            <?php echo link_to('<i class="icon-trash icon-white"></i>', 'transaction/delete?id='.$transaction->getId(),  array('method' => 'delete', 'confirm' => 'Voulez-vous vraiment supprimer la transaction "'.$transaction->getLibelle().'" ?', 'class' => 'btn btn-danger')) ?>
          </div>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('transaction_new', $asso) ?>" class="btn btn-success"><i class="icon-plus icon-white"></i>&nbsp;&nbsp;Nouvelle transaction</a>