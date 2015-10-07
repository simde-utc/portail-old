<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('weekmail/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form ?>
    </tbody>
	<tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('weekmail/index') ?>" class="btn">Retour</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Supprimer', 'weekmail/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'btn btn-danger')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" class="btn btn-primary" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
