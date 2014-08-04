<?php include_partial("insideMenu",array("param" => $param)) ?>

<h4><?php echo link_to('<< retour','reservation_gestion') ?></h4>

<h3>Gestion des reservations</h3>

<?php include_partial('showReservation',array('reservation'=>$reservation)) ?>

<?php if ($delete): ?>

  <h4>Supprimée !</h4>
  
  <?php echo nl2br($mail) ?>

<?php else: ?>

  <form method="post" action="<?php echo url_for('reservation_gestion_id',array('id'=>$id)) ?>">

    <textarea name="comment" placeholder="Your comment here"></textarea>

    <input type="submit" value="Supprimer" name="delete" />

  </form>
  
<?php endif ?>
