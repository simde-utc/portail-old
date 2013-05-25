<form action="<?php echo url_for('transaction/addDocument?id='.$transaction->getPrimaryKey())?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="sf_method" value="put" />
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <input class="btn btn-primary" type="submit" value="Ajouter" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['type_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['type_id']->renderError() ?>
          <?php echo $form['type_id'] ?>
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
        <th><?php echo $form['fichier']->renderLabel() ?></th>
        <td>
          <?php echo $form['fichier']->renderError() ?>
          <?php echo $form['fichier'] ?>
        </td>
      </tr>
      <!--
      <tr>
        <th><?php echo $form['reference']->renderLabel() ?></th>
        <td>
          <?php echo $form['reference']->renderError() ?>
          <?php echo $form['reference'] ?>
        </td>
      </tr>-->
    </tbody>
  </table>
</form>
