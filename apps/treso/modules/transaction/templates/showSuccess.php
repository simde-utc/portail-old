<?php use_helper('Number', 'Date');
use_javascript('treso-notedefrais.js') ?>
<h1>Affichage d'une transaction</h1>

<h3><?php echo $transaction->getLibelle(); ?></h3>
<p>
  le <?php echo format_date($transaction->getDateTransaction(), 'D', 'fr') ?><br/>
  <?php echo format_currency($transaction->getMontant(), '€', 'fr_FR') ?> sur <em><?php echo $transaction->getCompteBanquaire()->getNom() ?></em><br/>
  <?php if(is_null($transaction->getDateRapprochement())) {
    echo '<b>Non rapproché !</b>';
  } else {
    echo 'Rapproché le '. format_date($transaction->getDateRapprochement(), 'D', 'fr');
  }
  ?><br/>
  Payé par <?php echo $transaction->getTransactionMoyen()?> : <?php echo $transaction->getMoyenCommentaire() ?><br/><br/>
  <em>Commentaire : </em><br/>
  <?php echo nl2br($transaction->getCommentaire()); ?>
  <?php if(!is_null($transaction->getNoteDeFraisId())):
    $ndf = $transaction->getNoteDeFrais(); ?>
    <br/><br/>
    <b>Cet achat a été remboursé par la note de frais du <?php echo format_date($ndf->getCreatedAt(), 'D', 'fr') ?> à <?php echo $ndf->getNom() ?></b>
  <?php endif; ?>
  <?php if(!is_null($transaction->getBudgetPosteId())):
    $poste = $transaction->getBudgetPoste(); ?>
    <br/><br/>
    Cette transaction est liée au budget <a href=<?php echo url_for('budget_show', $poste->getBudget()) ?>><?php echo $poste ?></a>
  <?php endif; ?>
</p>

<h3>Documents Liés</h3>
  <?php if(count($documents) == 0): ?>
    <p>Aucun document lié, merci de scanner et d'ajouter la facture pour cette transaction.</p>
  <?php else: ?>
  <table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Date</th>
        <th>Type</th>
        <th>Actions</th>
      </tr>
    </thead>
    <?php foreach($documents as $document): ?>
      <tr>
        <td><a href="<?php echo url_for('document_show', $document); ?>"><?php echo $document ?></a></td>
        <td><?php echo $document->getCreatedAt() ?></td>
        <td><?php echo $document->getDocumentType() ?></td>
        <td><?php echo link_to('<i class="icon-trash icon-white"></i>', 'document/deleteFromTransaction?id='.$document->getPrimaryKey(), array('method' => 'delete', 'confirm' => "Attention, après suppresion il sera impossible de récupérer ce fichier.\nSupprimer quand même ?", 'class' => 'btn btn-danger')) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <?php endif; ?>
<p>
  <a class="btn btn-primary" href="#" id="btn-add-document"><i class="icon-plus icon-white"></i> Ajouter un document</a>
</p>

<div id="form-add-document">
  <?php include_partial('document/transaction_form', array('transaction' => $transaction, 'form' => $form)) ?>
</div>