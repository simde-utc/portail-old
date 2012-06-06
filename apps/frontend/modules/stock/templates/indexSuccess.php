<h1>Stocks List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Materiel</th>
      <th>Etat</th>
      <th>Nombre</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($stocks as $stock): ?>
    <tr>
      <td><a href="<?php echo url_for('stock/edit?id='.$stock->getId()) ?>"><?php echo $stock->getId() ?></a></td>
      <td><?php echo $stock->getMaterielId() ?></td>
      <td><?php echo $stock->getEtatId() ?></td>
      <td><?php echo $stock->getNombre() ?></td>
      <td><?php echo $stock->getCreatedAt() ?></td>
      <td><?php echo $stock->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('stock/new') ?>">New</a>
