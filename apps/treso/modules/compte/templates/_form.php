<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('compte/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('compte',(!$form->getObject()->isNew()) ? $form->getObject()->getAsso() : $asso) ?>" class="btn">Retour liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Supprimer', 'compte/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Voulez-vous vraiment supprimer ce compte ?', 'class' => 'btn btn-danger')) ?>
          <?php endif; ?>
          <input type="submit" value="Valider" class="btn btn-primary"/>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
