<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('budgetPoste/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> class="form-horizontal">
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <?php echo $form->renderGlobalErrors() ?>
  <?php foreach ($form as $label => $widget) : ?>
    <?php if (!$widget->isHidden()): ?>
    <div class="control-group">
      <label class="control-label"><?php echo $widget->renderLabel() ?></label>
      <div class="controls">
        <?php echo $widget->render() ?>
      </div>
      <?php echo $widget->renderError() ?>
    </div>
    <?php endif ?>
  <?php endforeach; ?>
  <?php echo $form->renderHiddenFields(false) ?>

  <div class="control-group">
    <div class="controls">
      <?php echo link_to('Retour', 'budget/show?id='.$form->getObject()->getBudget()->getId(), array('class'=>'btn')) ?>
      <input class="btn btn-primary" type="submit" value="Enregistrer" />
    </div>
  </div>
</form>
