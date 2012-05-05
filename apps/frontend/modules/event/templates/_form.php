<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="editform well" action="<?php echo url_for('event/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
          
          &nbsp;<a class="btn" href="<?php echo url_for('assos_show',array('login' => ($form->getObject()->isNew()) ? $sf_request->getParameter('login',null) : $form->getObject()->getAsso()->getLogin())) ?>">Retour à l'association</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'event/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'btn btn-danger')) ?>
          <?php endif; ?>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
