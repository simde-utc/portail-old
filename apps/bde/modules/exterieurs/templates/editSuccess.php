<?php use_helper('Number') ?>
<?php include_component('exterieurs', 'searchForm') ?>
<hr />
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="alert alert-error"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif ?>
<h3>Infos sur la carte <?php echo $tag;?></h3>
<?php echo $form->renderFormTag('exterieurs/edit') ?>
<table class="table table-striped">
<?php echo $form ?>
</table>