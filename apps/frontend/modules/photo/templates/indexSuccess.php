<h1>Liste des photos</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Galerie photo</th>
      <th>Title</th>
      <th>Author</th>
      <th>Is public</th>
      <th>Image</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($photos as $photo): ?>
    <tr>
      <td><a href="<?php echo url_for('photo/show?id='.$photo->getId()) ?>"><?php echo $photo->getId() ?></a></td>
      <td><?php echo $photo->getGaleriePhotoId() ?></td>
      <td><?php echo $photo->getTitle() ?></td>
      <td><?php echo $photo->getAuthor() ?></td>
      <td><?php echo $photo->getIsPublic() ?></td>
      <td><?php echo $photo->getImage() ?></td>
      <td><?php echo $photo->getCreatedAt() ?></td>
      <td><?php echo $photo->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

