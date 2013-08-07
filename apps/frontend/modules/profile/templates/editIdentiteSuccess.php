<form method="post" action="<?php echo url_for('profile_identite_update', array('id' => $profile->getId()))?>">
  <?php echo $form ?>
  <INPUT type="submit" class="btn-success" value="Valider">
</form>