<?php use_helper('Number') ?>
<?php include_component('cotisants', 'searchForm') ?>
<hr />
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="alert alert-error"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif ?>

<?php if(!empty($cotisant)): ?>
<h3>Infos</h3>
<table class="table table-striped">
  <tr>
    <td>Nom</td>
    <td><?php echo $cotisant->prenom." ".$cotisant->nom ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $cotisant->mail ?></td>
  </tr>
  <tr>
    <td>Adulte</td>
    <td><?php echo ($cotisant->is_adulte) ? "Oui" : "Non" ?></td>
  </tr>
  <tr>
    <td>Cotisant</td>
    <td>
      <form action="<?php echo url_for('cotisants/cotisation') ?>" method="POST" class="form form-inline">
        <?php echo $cotisant->is_cotisant_texte ?> 
        <?php echo $formcotisation ?> <input type="submit" name="type" value="<?php echo ($cotisant->is_cotisant) ? "Radier" : "Cotiser" ?>" />
      </form>
    </td>
  </tr>
</table>

<h3>Historique des cotisations</h3>
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
<?php else: ?>
<p>Erreur : <?php echo $error ?></p>
<?php endif; ?>


