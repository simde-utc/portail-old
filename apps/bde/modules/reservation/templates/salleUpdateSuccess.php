<?php include_partial("insideMenu",array("param" => $param)) ?>

<?php use_javascript("jscolor/jscolor.js") ?>

<h2>Modification de la salle</h2>
  
<p><?php echo link_to ('<< retour', 'reservation_salle') ?></p>

<?php if (!$update): ?> 

  <form action="<?php echo url_for('reservation_salle_update',array('id' => $id)) ?>" method="post">

     <?php echo $form ?>
     <br />
     <input type="submit" />

  </form>
  
<?php else: ?>

  <p>Modification réalisée avec succès !</p>

  <?php include_partial("showSalle",array('salle'=>$salle_modif)) ?>
  

<?php endif; ?>

