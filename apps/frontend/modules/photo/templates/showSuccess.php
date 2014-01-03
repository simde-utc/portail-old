<table>
  <tbody>
    <tr>
      <th>Galerie photo:</th>
      <td><?php echo $photo->getGaleriephotoId() ?></td>
    </tr>
    <tr>
      <th>Titre:</th>
      <td><?php echo $photo->getTitle() ?></td>
    </tr>
    <tr>
      <th>Photographe:</th>
      <td><?php echo $photo->getAuthor() ?></td>
    </tr>
    <tr>
      <th>Visible:</th>
      <td><?php echo $photo->getIsPublic() ?></td>
    </tr>
    <tr>
      <th>Photo:</th>
      <td><?php echo showThumb($photo->getImage(), 'galeries', array(
      'width' => 350,
      'height' => 250,
      'class' => 'pull-right img-polaroid'
    ), 'scale') ?><br/></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('photo/edit?id='.$photo->getId()) ?>">Editer</a>

