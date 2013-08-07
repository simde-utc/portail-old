<form method="post" action="<?php echo url_for('profile_infoPerso_update',array('id' => $profile->getId()))?>">
  <?php echo $form->renderHiddenFields() ?>
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form ?>
  <input type="submit" class="btn-success" value="Valider" />
</form>