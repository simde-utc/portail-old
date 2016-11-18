<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('locaux/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('locaux/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'locaux/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['date']->renderLabel() ?></th>
        <td>
          <?php echo $form['date']->renderError() ?>
          <?php echo $form['date'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ip']->renderLabel() ?></th>
        <td>
          <?php echo $form['ip']->renderError() ?>
          <?php echo $form['ip'] ?>
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
        <th><?php echo $form['pole_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['pole_id']->renderError() ?>
          <?php echo $form['pole_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['asso_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['asso_id']->renderError() ?>
          <?php echo $form['asso_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['asso_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['asso_name']->renderError() ?>
          <?php echo $form['asso_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['login']->renderLabel() ?></th>
        <td>
          <?php echo $form['login']->renderError() ?>
          <?php echo $form['login'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['nom']->renderLabel() ?></th>
        <td>
          <?php echo $form['nom']->renderError() ?>
          <?php echo $form['nom'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['prenom']->renderLabel() ?></th>
        <td>
          <?php echo $form['prenom']->renderError() ?>
          <?php echo $form['prenom'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['statut']->renderLabel() ?></th>
        <td>
          <?php echo $form['statut']->renderError() ?>
          <?php echo $form['statut'] ?>
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
    </tbody>
  </table>
</form>
