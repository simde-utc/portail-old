<div class="part">
  <h1>Gestion des membres</h1>
  <div class="well">
    <?php if($membres->count() > 0): ?>
      <em>Note: Le président n'apparait pas, la passation se fait via la page correspondante et est accessible uniquement au dernier président.</em><br /><br />
      <ul>
        <?php foreach($membres as $membre) : ?>
          <li><?php echo $membre->getUser() ?> - <a href="<?php echo url_for('member_edit', $membre) ?>"><?php echo $membre->getRole()->getName() ?></a></li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      Cette association n'a pas de membre.
    <?php endif ?>
  </div>
</div>