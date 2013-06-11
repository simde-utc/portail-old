<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="well" action="<?php echo url_for('infojob/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?key='.$form->getObject()->getEmailkey() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <?php if(!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
  <?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <th></th>
        <td>
          <input class="btn btn-primary" type="submit" value="Enregistrer" />

          &nbsp;<a href="<?php echo url_for('infojob/index') ?>"class="btn active">Retour à l'acceuil <i class="icon-home"></i></a>
          <?php if(!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'infojob/delete?key='.$form->getObject()->getEmailkey(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'btn btn-danger')) ?>
          <?php endif; ?>

          <?php echo $form->renderHiddenFields(false) ?>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
