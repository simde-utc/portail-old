<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $image->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $image->getName() ?></td>
    </tr>
    <tr>
      <th>Legend:</th>
      <td><?php echo $image->getLegend() ?></td>
    </tr>
    <tr>
      <th>Album:</th>
      <td><?php echo $image->getAlbumId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $image->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $image->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('image/edit?id='.$image->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('image/index') ?>">List</a>
