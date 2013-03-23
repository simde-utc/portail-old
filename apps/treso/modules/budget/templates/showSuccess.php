<?php use_helper('Number') ?>

<h1>Budget <?php echo $budget->getNom() ?> pour <?php echo $budget->getAsso()->getName() ?></h1>

<p>
    <a class="btn btn-success" href="<?php echo url_for('budget_categorie_new', $budget->getAsso()) ?>">
        <i class="icon-plus icon-white"></i>&nbsp;&nbsp;
        Ajouter une catégorie
    </a>
</p>

<?php if(count($categories) > 0): ?>
<table class="table table-striped table-bordered table-hover">
  <tbody>
    <?php foreach ($categories as $categorie): ?>
    <tr data-categorie-id="<?php echo $categorie->getPrimaryKey() ?>">
      <td><b><?php echo $categorie->getNom() ?></b> (<?php echo format_currency($categorie->getTotal(), '€', 'fr_FR') ?>)</td>
      <td><a href="#" class="btn btn-primary">Ajouter un poste</a></td>
      <td><a href="#" class="btn btn-danger">Supprimer</a></td>
      <td><a href="#" class="btn">Modifier</a></td>
    </tr>
	   	<?php foreach ($categorie->getPostesForBudget($budget) as $poste): ?>
	   		<tr data-poste-id="<?php echo $poste->getPrimaryKey() ?>">
          <td><?php echo $poste->getNom() ?> (<?php echo format_currency($poste->getTotal(), '€', 'fr_FR') ?>)</td>
          <td></td>
          <td><a href="#" class="btn btn-danger">Supprimer</a></td>
          <td><a href="#" class="btn">Modifier</a></td>
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