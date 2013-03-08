<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<div class="well">
  Emprunt de : <?php echo $materiel->getNom() ?><br />
  Propriétaire : <?php echo $materiel->getAsso()->getName() ?><br />
  Emprunteur : <?php echo $sf_user->getUsername() ?><br />
  <br />
  <form class="editform" action="<?php echo url_for('emprunt/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if(!$form->getObject()->isNew()): ?>
      <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
      <tfoot>
        <tr>
          <th></th>
          <td>
            <?php echo $form->renderHiddenFields(false) ?>
            <input class="btn btn-primary" type="submit" value="Enregistrer" />

            &nbsp;<a class="btn" href="<?php echo url_for('materiel', array('login' => ($form->getObject()->isNew()) ? $materiel->getAsso()->getLogin() : $form->getObject()->getAsso()->getLogin())) ?>">Retour au matériel</a>
            <?php if(!$form->getObject()->isNew()): ?>
              &nbsp;<?php echo link_to('Annuler l\'emprunt', 'emprunt/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'btn btn-danger')) ?>
            <?php endif; ?>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php echo $form->renderGlobalErrors() ?>
        <?php echo $form ?>
      </tbody>
    </table>
  </form>
</div>