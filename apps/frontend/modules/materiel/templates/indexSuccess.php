<h1>Materiels List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nom</th>
      <th>Asso</th>
      <th>Description</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($materiels as $materiel): ?>
    <tr>
      <td><a href="<?php echo url_for('materiel/edit?id='.$materiel->getId()) ?>"><?php echo $materiel->getId() ?></a></td>
      <td><?php echo $materiel->getNom() ?></td>
      <td><?php echo $materiel->getAssoId() ?></td>
      <td><?php echo $materiel->getDescription() ?></td>
      <td><?php echo $materiel->getCreatedAt() ?></td>
      <td><?php echo $materiel->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('materiel/new') ?>">New</a>
