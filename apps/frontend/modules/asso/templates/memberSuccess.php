<div class="part">
  <h1>Gestion des membres</h1>
  <div class="well">
    <?php if($membres->count() > 0): ?>
      <em>Note: Le président n'apparait pas, la passation se fait via la page correspondante et est accessible uniquement au dernier président.</em><br /><br />
      <ul>
        <?php foreach($membres as $membre) : ?>
          <li>
            <?php echo $membre->getUser()->getFirstName() ?> <?php echo $membre->getUser()->getLastName() ?> - <?php echo $membre->getRole()->getName() ?>
            <a href="<?php echo url_for('member_edit', $membre) ?>" ><i class="icon-pencil"></i>&nbsp;Modifier</a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      Cette association n'a pas de membre.
    <?php endif ?>
  </div>
  <div class="well">
    <h2>Liste des rôles</h2>
    <table class="table table-striped">
      <thead style="font-weight: bold;">
        <tr>
          <td>Rôle</td>
          <td>Bureau</td>
          <td>Gestion des infos de l'asso</td>
          <td>Gestion des membres</td>
          <td>Gestion des articles</td>
          <td>Gestion des événements</td>
          <td>Gestion des droits</td>
          <td>Gestion de la trésorerie</td>
          <td>Gestion des photos</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach($roles as $role): ?>
        <tr>
          <td style="font-weight: bold;"><?php echo $role->getName() ?></td>
          <td><?php echo ($role->getBureau() ? '<i class="icon-ok"></i>' : '<i class="icon-remove"></i>') ?></td>
          <td><?php echo ($role->getDroits() &  0x01) ? '<i class="icon-ok"></i>' : '<i class="icon-remove"></i>' ?></td>
          <td><?php echo ($role->getDroits() &  0x02) ? '<i class="icon-ok"></i>' : '<i class="icon-remove"></i>' ?></td>
          <td><?php echo ($role->getDroits() &  0x04) ? '<i class="icon-ok"></i>' : '<i class="icon-remove"></i>' ?></td>
          <td><?php echo ($role->getDroits() &  0x08) ? '<i class="icon-ok"></i>' : '<i class="icon-remove"></i>' ?></td>
          <td><?php echo ($role->getDroits() &  0x10) ? '<i class="icon-ok"></i>' : '<i class="icon-remove"></i>' ?></td>
          <td><?php echo ($role->getDroits() & 0x100) ? '<i class="icon-ok"></i>' : '<i class="icon-remove"></i>' ?></td>
          <td><?php echo ($role->getDroits() & 0x200) ? '<i class="icon-ok"></i>' : '<i class="icon-remove"></i>' ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>
</div>