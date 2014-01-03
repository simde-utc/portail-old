<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $photo->getId() ?></td>
    </tr>
    <tr>
      <th>Galerie photo:</th>
      <td><?php echo $photo->getGaleriePhotoId() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $photo->getTitle() ?></td>
    </tr>
    <tr>
      <th>Author:</th>
      <td><?php echo $photo->getAuthor() ?></td>
    </tr>
    <tr>
      <th>Is public:</th>
      <td><?php echo $photo->getIsPublic() ?></td>
    </tr>
    <tr>
      <th>Image:</th>
      <td><?php echo $photo->getImage() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $photo->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $photo->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('photo/edit?id='.$photo->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('photo/index') ?>">List</a>
