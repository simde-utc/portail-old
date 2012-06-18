<form action="<?php echo url_for('profile_infoSupp_update',array('id' => $profile->getId())) ?>" method="post">
  <?php echo $form->renderHiddenFields() ?>
  <?php echo $form->renderGlobalErrors() ?>
  <?php 
    echo $form ;
  ?>
  
  <INPUT type="submit" class="btn-success" value="Valider">
</form>
