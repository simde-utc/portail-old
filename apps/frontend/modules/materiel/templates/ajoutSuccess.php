<div class="part">
  <h1>Modification du stock disponible</h1>
  <br />
  <form class="editform well" action="<?php echo url_for('materiel/' . ($form->getObject()->isNew() ? 'createAjout' : 'updateAjout') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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

            &nbsp;<a class="btn" href="<?php echo url_for('materiel', array('login' => $materiel->getAsso()->getLogin())) ?>">Retour au matériel</a>
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