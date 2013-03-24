<?php use_stylesheet('bootstrap.min.css') ?>

<h1>Budget Categories @ <?php echo $asso->getName() ?></h1>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Categorie</th>
      <th>Commentaire</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($budget_categories as $budget_categorie): ?>
    <tr>
      <td><?php echo $budget_categorie->getNom() ?></td>
      <td><?php echo $budget_categorie->getCommentaire() ?></td>
      <td><a href="<?php echo url_for('budget_categorie_edit', $budget_categorie) ?>" class="btn"><i class="icon-pencil"></i> Editer</a>&nbsp;
        <?php echo link_to('<i class="icon-trash icon-white"></i>&nbsp;&nbsp;Supprimer', 'budgetCategorie/delete?id='.$budget_categorie->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'btn btn-danger')) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('budget_categorie_new', $asso) ?>" class="btn btn-success"><i class="icon-plus icon-white"></i> Ajouter</a>
