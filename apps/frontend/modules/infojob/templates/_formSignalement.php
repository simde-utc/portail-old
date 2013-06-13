<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<h1>Signaler une annonce </h1>

<form class="well" action="<?php echo url_for('infojob/signaldo')?>" method="post" <?php $form-> isMultipart() and print 'enctype="multipart/form-data" ' ?>>
	Le contenu de cette annonce vous a paru inaproprié.Dites nous pourquoi?
	<br/>
	<br/>
    <input type="hidden" name="sf_method" value="put" />
  <table>
    <tfoot>
      <tr>
        <th></th>
        <td>
          <input class="btn btn-primary" type="submit" value="Signaler" />

          &nbsp;<a href="<?php echo url_for('infojob/index') ?>"class="btn active">Retour<i class="icon-home"></i></a>

          <?php echo $form->renderHiddenFields(false) ?>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>