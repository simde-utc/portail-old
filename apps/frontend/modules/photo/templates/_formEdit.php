<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<form action="<?php echo url_for('photo/update?id='.$form->getObject()->getId()) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
  <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
          <td colspan="2">
            <br>
            <input class="btn btn-primary" type="submit" value="Enregistrer" />
            <?php if (!$form->getObject()->isNew()): ?>
              <?php echo link_to('Supprimer', 'photo/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Es-tu certain?')) ?>
            <?php endif; ?>
          </td>
        
      </tr>
    </tfoot>
    <tbody>
      <div>
        Titre:
        <?php echo $form['title'] ?>
      </div>
      <div> 
        Est publique 
        <?php echo $form['is_public'] ?>
    </tbody>
  </table>
</form>
