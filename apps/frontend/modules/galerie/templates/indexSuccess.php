<h1>Liste des galeries photos</h1>

<table>
  <thead>
    <tr>
      <th>Titre</th>
      <th>Evènement</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($galerie_photos as $galerie_photo): ?>
    <tr>
       <td><a href="<?php echo url_for('galerie/show?id='.$galerie_photo->getId()) ?>"><?php echo $galerie_photo->getTitle() ?></a></td>
      <td><?php echo EventTable::getInstance()->find($galerie_photo->getEventId()) ?></td>     
      <td><?php echo $galerie_photo->getDescription() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
