<?php use_helper('Number', 'Date'); ?>
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