<h2>Edit Sport</h2>

<form action="<?php echo url_for('profile_infoSupp_submit',array('id' => $profile->getId())) ?>" method="post">
  <?php echo $form->renderHiddenFields() ?>
  <?php echo $form['sport_id']->renderLabel()?> <?php echo $form['sport_id']->renderError()?> <?php echo $form['sport_id'] ?>
  <input type="submit" value="Save" />
</form>

<a href="<?php echo url_for('profile_show')?>">Back to index</a>