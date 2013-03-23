<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('budget/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a class="btn" href="<?php echo url_for('budget_'.($form->getObject()->isNew() ? 'list' : 'show'), (!$form->getObject()->isNew() ? $form->getObject() : $asso)) ?>">Retour</a>
          <input class="btn btn-primary" type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['nom']->renderLabel() ?></th>
        <td>
          <?php echo $form['nom']->renderError() ?>
          <?php echo $form['nom'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['semestre_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['semestre_id']->renderError() ?>
          <?php echo $form['semestre_id'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
