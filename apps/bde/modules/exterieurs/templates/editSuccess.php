<?php use_helper('Number') ?>
<?php include_component('exterieurs', 'searchForm') ?>
<hr />
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="alert alert-error"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif ?>
<?php if (!(empty($cotisant))): ?>
<h3>Infos sur la carte <?php echo $tag;?></h3>
<?php echo $editForm->renderFormTag('edit?tag='.$tag) ?>
<table class="table table-striped">
<?php echo $editForm ?>
	<tr>
	  <td colspan="2">
	    <input type="submit" name="btnEdit" value="Modifier"/>
	  </td>
	</tr>
</table>
<hr>
<h4>Gestion de la cotisation</h4>
<p>Les cotisations s'arrêtent <b>le 31 août</b> de l'année suivante au plus tard. <br />
Deux cotisations ne peuvent être en même temps.</p>
<?php echo $cotizForm->renderFormTag('cotiser?tag='.$tag) ?>
<table class="table table-striped">
<?php echo $cotizForm;?>
	<tr>
	  <td colspan="2">
	    <input type="submit" name="btnCotiser" value="Cotiser"/>
	  </td>
	</tr>
</table>
<h5>Historique des cotisations</h5>
<?php if(!empty($cotisations)): ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Date de début</th>
      <th>Date de fin</th>
      <th>Montant</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($cotisations as $cotisation): ?>
    <tr>
      <td><?php echo $cotisation->debut ?></td>
      <td><?php echo $cotisation->fin ?></td>
      <td><?php echo format_currency($cotisation->montant, "€") ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
<p>Aucune cotisation à afficher</p>
<?php endif ?>
<?php endif; ?>
<?php if(!empty($error)): ?>
<p>Erreur : <?php echo $error ?></p>
<?php endif; ?>