<h1>Emprunts List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Materiel</th>
      <th>User</th>
      <th>Asso</th>
      <th>Nombre</th>
      <th>Rendu</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($emprunts as $emprunt): ?>
    <tr>
      <td><a href="<?php echo url_for('emprunt/edit?id='.$emprunt->getId()) ?>"><?php echo $emprunt->getId() ?></a></td>
      <td><?php echo $emprunt->getMaterielId() ?></td>
      <td><?php echo $emprunt->getUserId() ?></td>
      <td><?php echo $emprunt->getAssoId() ?></td>
      <td><?php echo $emprunt->getNombre() ?></td>
      <td><?php echo $emprunt->getRendu() ?></td>
      <td><?php echo $emprunt->getCreatedAt() ?></td>
      <td><?php echo $emprunt->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('emprunt/new') ?>">New</a>
