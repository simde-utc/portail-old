<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('budgetPrevisionnel/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('budgetPrevisionnel/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'budgetPrevisionnel/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
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
      <tr>
        <th><?php echo $form['semestre_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['semestre_id']->renderError() ?>
          <?php echo $form['semestre_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['date_trx']->renderLabel() ?></th>
        <td>
          <?php echo $form['date_trx']->renderError() ?>
          <?php echo $form['date_trx'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['budget_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['budget_id']->renderError() ?>
          <?php echo $form['budget_id'] ?>
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
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['deleted_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['deleted_at']->renderError() ?>
          <?php echo $form['deleted_at'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
