<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('treso-avance-form.js') ?>

<form action="<?php echo url_for('avances/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('avances', $asso) ?>" class="btn">Retour</a>
          <input type="submit" value="Enregistrer" class="btn btn-primary" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['asso_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['asso_id']->renderError() ?>
          <?php echo $form['asso_id'] ?>
        </td>
      </tr>
      <?php if(!$form->getObject()->getAsso()->isNew()): ?>
      <tr>
        <th><?php echo $form['commentaire']->renderLabel() ?></th>
        <td>
          <?php echo $form['commentaire']->renderError() ?>
          <?php echo $form['commentaire'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['emetteur_compte_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['emetteur_compte_id']->renderError() ?>
          <?php echo $form['emetteur_compte_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['asso_compte_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['asso_compte_id']->renderError() ?>
          <?php echo $form['asso_compte_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['montant']->renderLabel() ?></th>
        <td>
          <?php echo $form['montant']->renderError() ?>
          <?php echo $form['montant'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['moyen_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['moyen_id']->renderError() ?>
          <?php echo $form['moyen_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['moyen_commentaire']->renderLabel() ?></th>
        <td>
          <?php echo $form['moyen_commentaire']->renderError() ?>
          <?php echo $form['moyen_commentaire'] ?>
        </td>
      </tr>
    <?php endif; ?>
    </tbody>
  </table>
</form>
