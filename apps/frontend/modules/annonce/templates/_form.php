<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="well" action="<?php echo url_for('annonce/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <?php if(!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
  <?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <th></th>
        <td>
          <input class="btn btn-primary" type="submit" value="Save" />

          &nbsp;<a href="<?php echo url_for('annonce/index') ?>" class="btn">Retour aux annonces</a>
          <?php if(!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'annonce/delete?id='.$form->getObject()->getEmailkey(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'btn btn-danger')) ?>
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
