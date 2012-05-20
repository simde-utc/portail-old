<div id="trombi">
  <?php if ($membres->count() > 0): ?>
    <ul>
      <?php foreach ($membres as $membre) : ?>
        <li><?php echo $membre->getUser() ?> - <a href="<?php echo url_for('member_edit',$membre) ?>"><?php echo $membre->getRole()->getName() ?></a></li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    Cette association n'a pas de membre.
  <?php endif ?>
</div>
