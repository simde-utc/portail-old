<?php use_helper('Number', 'Date') ?>
<h1>Note de Frais</h1>

<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr><th colspan="4" style="text-align: center;">Achats à rembourser (<?php echo count($transactions); ?>)</th></tr>
    <tr>
      <th>Transaction</th>
      <th>Membre</th>
      <th>Montant</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($transactions as $transaction): ?>
    <tr>
      <td><?php echo $transaction->getLibelle() ?></td>
      <td><?php echo $transaction->getMoyenCommentaire() ?></td>
      <td><?php echo format_currency(abs($transaction->getMontant()), '€', 'fr_FR') ?></td>
      <td><?php echo format_date($transaction->getDateTransaction(), 'D', 'fr') ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<p>
  <a href="<?php echo url_for('ndf_new', $asso) ?>" class="btn btn-success"><i class="icon-white icon-plus"></i> Ajouter une note de frais</a>
</p>

<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr><th colspan="4" style="text-align: center;">Note de frais précédentes (<?php echo count($note_de_frais); ?>)</th></tr>
    <tr>
      <th>Nom</th>
      <th>Montant</th>
      <th>Date</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($note_de_frais as $ndf): ?>
    <tr>
      <td><a href="<?php echo url_for('transaction_show', $ndf->getTransaction()) ?>"><?php echo $ndf->getNom() ?></a></td>
      <td><?php echo format_currency(abs($ndf->getTransaction()->getMontant()), '€', 'fr_FR') ?></td>
      <td><?php echo format_date($ndf->getTransaction()->getDateTransaction(), 'D', 'fr') ?></td>
      <td><a class="btn btn-primary" href="<?php echo url_for('ndf_export', $ndf) ?>"><i class="icon-share-alt icon-white"></i> Attestation</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
