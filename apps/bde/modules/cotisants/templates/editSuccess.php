<?php include_component('cotisants', 'searchForm') ?>
<hr />
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
        <?php echo ($cotisant->is_cotisant) ? "Oui" : "Non" ?> 
        <?php echo $formcotisation ?> <input type="submit" name="type" value="<?php echo ($cotisant->is_cotisant) ? "Radier" : "Cotiser" ?>" />
      </form>
    </td>
  </tr>
</table>

<h3>Historique des cotisations</h3>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Date de début</th>
      <th>Date de fin</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($cotisations as $cotisation): ?>
    <tr>
      <td><?php echo $cotisation->debut ?></td>
      <td><?php echo $cotisation->fin ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
<p>Utilisateur non trouvé.</p>
<?php endif; ?>


