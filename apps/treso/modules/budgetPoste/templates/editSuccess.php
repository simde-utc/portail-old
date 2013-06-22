<h1>Modifier la ligne <?php echo $poste->getNom() ?> du budget <?php echo $poste->getBudget()->getNom() ?></h1>

<?php include_partial('form', array('form' => $form)) ?>
