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
<?php if($sf_user->isAuthenticated()
   && $sf_user->getGuardUser()->hasAccess(EventTable::getInstance()->find($galerie_photo->getEventId())->getAsso()->getLogin(), 0x200)): ?>
  <a href="<?php echo url_for('photo_new', $galerie_photo) ?>">Ajouter des photos</a>
<?php endif ?>