<h1>Budgets List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Asso</th>
      <th>Nom</th>
      <th>Semestre</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Deleted at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($budgets as $budget): ?>
    <tr>
      <td><a href="#"><?php echo $budget->getId() ?></a></td>
      <td><?php echo $budget->getAssoId() ?></td>
      <td><?php echo $budget->getNom() ?></td>
      <td><?php echo $budget->getSemestreId() ?></td>
      <td><?php echo $budget->getCreatedAt() ?></td>
      <td><?php echo $budget->getUpdatedAt() ?></td>
      <td><?php echo $budget->getDeletedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="#">New</a>
