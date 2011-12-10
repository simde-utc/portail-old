<div id="bureau">
  <?php if($bureau->count() > 0): ?>
    <ul>
      <?php foreach($bureau as $membre) : ?>
        <li><?php echo $membre->getUser() ?>
          <ul>
            <li>Rôle : <?php echo $membre->getRole()->getName() ?> (<?php echo $membre->getSemestre() ?>)</li>
            <li>Email : <?php echo $membre->getUser()->getEmailAddress() ?></li>
            <li>Semestre : <?php echo $membre->getUser()->getProfile()->getBranche() . '0' .$membre->getUser()->getProfile()->getSemestre() ?> <?php echo $membre->getUser()->getProfile()->getFiliere() ?></li>
          </ul>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    Cette association n'a pas de membre dans son bureau.
  <?php endif ?>
</div>