
<h1>Images List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Legend</th>
      <th>Album</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($images as $image): ?>
    <tr>
      <td><a href="<?php echo url_for('image/show?id='.$image->getId()) ?>"><?php echo $image->getId() ?></a></td>
      <td><?php echo $image->getName() ?></td>
      <td><?php echo $image->getLegend() ?></td>
      <td><?php echo $image->getAlbumId() ?></td>
      <td><?php echo $image->getCreatedAt() ?></td>
      <td><?php echo $image->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('image/new') ?>">New</a>
