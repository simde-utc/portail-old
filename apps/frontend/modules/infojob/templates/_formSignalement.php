<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<form class="well infojob-form" action="<?php echo url_for('infojob/signaldo')?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <input type="hidden" name="sf_method" value="put" />
  <table>
    <tfoot>
      <tr>
        <th></th>
        <td>
          <input class="btn btn-primary" type="submit" value="Signaler" />
          &nbsp;<a href="<?php echo url_for('infojob/show?id=' . $form->getObject()->getOffreId()) ?>"class="btn active">Retour à l'annonce</i></a>
          <?php echo $form->renderHiddenFields(false) ?>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
