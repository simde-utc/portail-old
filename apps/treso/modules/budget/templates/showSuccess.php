<?php use_helper('Number');

function format_montant($montant) {
  $tot = '<td>' . format_currency(abs($montant), '€', 'fr_FR') . '</td>';
  return ($montant >= 0) ? "<td></td>".$tot : $tot."<td></td>";
}
?>

<h1>Budget <?php echo $budget->getNom() ?> pour <?php echo $budget->getAsso()->getName() ?></h1>

<p>
    <a class="btn btn-success" href="<?php echo url_for('budget_categorie_new', $budget->getAsso()) ?>">
        <i class="icon-plus icon-white"></i>&nbsp;&nbsp;
        Ajouter une catégorie
    </a>
</p>

<?php if(count($categories) > 0): ?>
<table class="table table-striped table-bordered table-hover table-treso-budget">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Dépense</th>
      <th>Recette</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categories as $categorie): ?>
    <tr class="table-treso-categorie">
      <td><?php echo $categorie->getNom() ?></td>
      <?php echo format_montant($categorie->getTotal()) ?>
      <td><a href="<?php echo url_for('budget_poste_new', array('budget' => $budget->getPrimaryKey(), 'categorie' => $categorie->getPrimaryKey())) ?>" class="btn btn-primary">Ajouter un poste</a></td>
      <td>
          <?php echo link_to('<i class="icon-trash icon-white"></i>&nbsp;&nbsp;Supprimer', 'budgetCategorie/delete?id='.$categorie->getPrimaryKey(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'btn btn-danger')) ?>
          <a href="<?php echo url_for('budget_categorie_edit', $categorie) ?>" class="btn">Modifier</a>
      </td>
    </tr>
      <?php foreach ($categorie->getPostesForBudget($budget) as $poste): ?>
        <tr class="table-treso-ligne">
          <td><?php echo $poste->getNom() ?></td>
          <?php echo format_montant($poste->getTotal()) ?>
          <td></td>
          <td>
              <a href="<?php echo url_for('budget_poste_delete', $poste) ?>" class="btn btn-danger">Supprimer</a>
              <a href="<?php echo url_for('budget_poste_edit', $poste) ?>" class="btn">Modifier</a></td>
        </tr>
	   	<?php endforeach; ?>
    <?php endforeach; ?>
  </tbody>
</table>
<?php endif ?>

<p>
    <a class="btn btn-danger" href="<?php echo url_for('budget_delete', $budget) ?>">
        <i class="icon-trash icon-white"></i>&nbsp;&nbsp;
        Supprimer le budget
    </a>
    <a class="btn btn-info" href="<?php echo url_for('budget_edit', $budget) ?>">
        <i class="icon-pencil icon-white"></i>&nbsp;&nbsp;
        Modifier le nom du budget
    </a>
</p>