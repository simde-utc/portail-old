<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="editform well" action="<?php echo url_for('galerie/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <th></th>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <input class="btn btn-primary" type="submit" value="Enregistrer" />
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Supprimer', 'galerie/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Est-ce votre dernier choix?', 'class' => 'btn btn-danger')) ?>
          <?php endif; ?>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['title']->renderLabel() ?></th>
        <td>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['description']->renderLabel() ?></th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
      <?php if (!$form->getObject()->isNew()): ?>
        <tr>
          <th></th>
          <td colspan="2">
            <p>
              <a class="btn btn-primary" href="<?php echo url_for('photo/new?id='. $form->getObject()->getId()) ?>">Ajouter des photos</a>
            </p>
          </td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</form>
