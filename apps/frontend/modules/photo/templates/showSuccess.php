<table>
  <tbody>
    <tr>
      <th>Galerie photo:</th>
      <td><?php echo $photo->getGaleriephotoId() ?></td>
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
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('photo/edit?id='.$photo->getId()) ?>">Edit</a>

