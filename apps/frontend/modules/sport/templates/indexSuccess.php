<h1>Sports List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sports as $sport): ?>
    <tr>
      <td><a href="<?php echo url_for('sport/edit?id='.$sport->getId()) ?>"><?php echo $sport->getId() ?></a></td>
      <td><?php echo $sport->getName() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('sport/new') ?>">New</a>
