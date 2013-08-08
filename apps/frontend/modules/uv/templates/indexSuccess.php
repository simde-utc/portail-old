<h1>Uvs List</h1>

<table>
  <thead>
    <tr>
      <th>Code</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($uvs as $uv): ?>
    <tr>
      <td><a href="<?php echo url_for('uv/edit?code='.$uv->getCode()) ?>"><?php echo $uv->getCode() ?></a></td>
      <td><?php echo $uv->getName() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('uv/new') ?>">New</a>
