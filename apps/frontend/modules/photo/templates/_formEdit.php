<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<form action="<?php echo url_for('photo/update?id='.$form->getObject()->getId()) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
  <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<div>
  <?php echo $form->renderGlobalErrors() ?>
  <div>
    <?php echo $form['title']->renderError() ?>
    <label>
      Titre
      <?php echo $form['title'] ?>
    </label>
    <?php echo $form['is_public']->renderError() ?>
    <label class="checkbox" id="PrependedInput"> 
      Visible des étudiants non UTCéens 
      <?php echo $form['is_public'] ?>
    </label>
  </div>
  <div>
    </br>
    <input class="btn btn-primary" type="submit" value="Enregistrer" />
    <?php if (!$form->getObject()->isNew()): ?>
      <?php echo link_to('Supprimer', 'photo/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Est-ce votre dernier choix?', 'class' => 'btn btn-danger')) ?>
    <?php endif; ?>
  </div>
</form>
