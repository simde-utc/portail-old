<?php use_stylesheet('bootstrap.min.css') ?>

<h1>Budget Categories @ <?php echo $asso->getName() ?></h1>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Categorie</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($budget_categories as $budget_categorie): ?>
    <tr>
      <td><?php echo $budget_categorie->getNom() ?></td>
      <td><a href="<?php echo url_for('budget_categorie_edit', $budget_categorie) ?>" class="btn">Edit</a></td>
      <td><a href="<?php echo url_for('budget_categorie_delete', $budget_categorie) ?>" class="btn btn-danger">Delete</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('budget_categorie_new', $asso) ?>" class="btn btn-primary">New</a>
