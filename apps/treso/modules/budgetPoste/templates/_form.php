<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="budget_poste-form" action="<?php echo url_for('budgetPoste/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
            &nbsp;<?php echo link_to('Retour', 'budget/show?id='.$form->getObject()->getBudget()->getId(), array('class'=>'btn')) ?>
          <input class="btn btn-primary" type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <br>
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
        <th><?php echo $form['budget_categorie_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['budget_categorie_id']->renderError() ?>
          <?php echo $form['budget_categorie_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['nombre']->renderLabel() ?></th>
        <td>
          <?php echo $form['nombre']->renderError() ?>
          <?php echo $form['nombre'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['prix_unitaire']->renderLabel() ?></th>
        <td>
          <?php echo $form['prix_unitaire']->renderError() ?>
          <?php echo $form['prix_unitaire'] ?> 
        </td>
      </tr>
      <tr>
        <th><?php echo $form['commentaire']->renderLabel() ?></th>
        <td>
          <?php echo $form['commentaire']->renderError() ?>
          <?php echo $form['commentaire'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
