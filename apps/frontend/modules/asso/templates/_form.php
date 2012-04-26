<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="editform well" action="<?php echo url_for('asso/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <th></th>
        <td>
          <?php echo $form->renderHiddenFields(false) ?>
          <input class="btn btn-primary" type="submit" value="Enregistrer" />
          <?php if($form->getObject()->isNew()): ?>
          &nbsp;<a class="btn" href="<?php echo url_for('asso/index') ?>">Retour à la liste des assos</a>
          <?php else: ?>
          &nbsp;<a class="btn" href="<?php echo url_for('assos_show',$form->getObject()) ?>">Retour à l'association</a>
          <?php endif ?>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
