<h1>Budgets List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nom</th>
      <th>Budget categorie</th>
      <th>Nombre</th>
      <th>Prix unitaire</th>
      <th>Commentaire</th>
      <th>Semestre</th>
      <th>Date trx</th>
      <th>Budget</th>
      <th>Moyen</th>
      <th>Moyen commentaire</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Deleted at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($budgets as $budget): ?>
    <tr>
      <td><a href="<?php echo url_for('budgetPrevisionnel/edit?id='.$budget->getId()) ?>"><?php echo $budget->getId() ?></a></td>
      <td><?php echo $budget->getNom() ?></td>
      <td><?php echo $budget->getBudgetCategorieId() ?></td>
      <td><?php echo $budget->getNombre() ?></td>
      <td><?php echo $budget->getPrixUnitaire() ?></td>
      <td><?php echo $budget->getCommentaire() ?></td>
      <td><?php echo $budget->getSemestreId() ?></td>
      <td><?php echo $budget->getDateTrx() ?></td>
      <td><?php echo $budget->getBudgetId() ?></td>
      <td><?php echo $budget->getMoyenId() ?></td>
      <td><?php echo $budget->getMoyenCommentaire() ?></td>
      <td><?php echo $budget->getCreatedAt() ?></td>
      <td><?php echo $budget->getUpdatedAt() ?></td>
      <td><?php echo $budget->getDeletedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('budgetPrevisionnel/new') ?>">New</a>
