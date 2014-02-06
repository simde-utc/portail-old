<?php use_helper('Date', 'Text'); ?>

<h1>Documents stockés</h1>
<br/>
<a href="<?php echo url_for('document_new', $asso) ?>" class="btn btn-success">Ajouter un document</a>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Date d'ajout</th>
      <th>Nom</th>
      <!-- <th>Reference</th> Génerer automatiquement une référence en fonction du type de doc -->
      <th>Type</th>
      <th>Transaction</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($documents as $document): ?>
    <tr>
      <td class="reduce"><?php echo format_date($document->getCreatedAt(), 'D', 'fr') ?></td>
      <td class="expand"><a href="<?php echo url_for('document_show', $document) ?>" target="_blank"><?php echo $document->getNom() ?></a></td>
      <!-- <td><?php echo $document->getReference() ?></td> -->
      <td class="reduce"><?php echo $document->DocumentType->getNom() ?></td>
      <?php if (!is_null($document->getTransactionId())): ?>
      <td class="reduce"><a href="<?php echo url_for('transaction_show', $document->Transaction) ?>"><?php echo truncate_text($document->Transaction->libelle, 40, '...') ?></a></td>
      <?php else: ?>
      <td class="reduce"></td>
      <?php endif; ?>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
