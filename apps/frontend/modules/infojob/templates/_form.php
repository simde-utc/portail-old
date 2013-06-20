<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="well infojob-form" action="<?php echo url_for('infojob/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?key=' . $form->getObject()->getEmailkey() : '')); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <?php if($form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
  <?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <th></th>
        <td>
          <input class="btn btn-primary" type="submit" value="Enregistrer" />

          <?php if($form->getObject()->isNew()) : ?>
            &nbsp;<a href="<?php echo url_for('infojob/index'); ?>" class="btn active">Retour à l'accueil <i class="icon-home"></i></a>
          <?php else: ?>
            &nbsp;<?php echo link_to('Retour à l\'annonce', 'infojob/show?id='.$form->getObject()->getId(), array('class' => 'btn active')) ?>
            &nbsp;<?php echo link_to('Supprimer l\'annonce', 'infojob/delete?key='.$form->getObject()->getEmailkey(), array('method' => 'delete', 'confirm' => 'Etes-vous sûr de vouloir supprimer l\'annonce ?', 'class' => 'btn btn-danger')) ?>
          <?php endif;
          echo $form->renderHiddenFields(false) ?>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
