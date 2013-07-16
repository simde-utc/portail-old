<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('treso-notedefrais-form.js') ?>

<form action="<?php echo url_for('noteDeFrais/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('ndf', $asso) ?>" class="btn">Retour</a>
          <input type="submit" value="Enregistrer" class="btn btn-primary" />
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
        <th><?php echo $form['transactions']->renderLabel() ?></th>
        <td id="liste-achats">
          <?php echo $form['transactions']->renderError() ?>
          <?php echo $form['transactions'] ?>
        </td>
      </tr>
      <tr>
        <th><label>Montant total</label></th>
        <td>
          <p id="montant-total">
          0,00 €
          </p>
        </td>
      <tr>
      <tr>
        <th><?php echo $form['compte_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['compte_id']->renderError() ?>
          <?php echo $form['compte_id'] ?>
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
    </tbody>
  </table>
</form>
