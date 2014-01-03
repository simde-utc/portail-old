<table>
  <tbody>
    <tr>
      <th>Evènement:</th>
      <td><?php echo EventTable::getInstance()->find($galerie_photo->getEventId())?></td>
    </tr>
    <tr>
      <th>Titre:</th>
      <td><?php echo $galerie_photo->getTitle() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $galerie_photo->getDescription() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('galerie/edit?id='.$galerie_photo->getId()) ?>">Editer</a>
&nbsp;
<a href="<?php echo url_for('galerie/index') ?>">Liste</a>
