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
        </tr>
      </thead>
      <tbody>
        <?php foreach($roles as $role): ?>
        <tr>
          <td style="font-weight: bold;"><?php echo $role->getName() ?></td>
          <td><?php echo ( $role->getBureau() ? 'Oui' : 'Non') ?></td>
          <td><?php echo ($role->getDroits() & 0x01) ? 'Oui' : 'Non' ?></td>
          <td><?php echo ($role->getDroits() & 0x02) ? 'Oui' : 'Non' ?></td>
          <td><?php echo ($role->getDroits() & 0x04) ? 'Oui' : 'Non' ?></td>
          <td><?php echo ($role->getDroits() & 0x08) ? 'Oui' : 'Non' ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>
</div>