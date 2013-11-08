<?php use_helper('Thumb') ?>
<div id="trombi">
   <?php if ($membres->count() > 0): ?>
    <ul class="membres">
      <?php foreach ($membres as $membre) : ?>
        <li>
          <?php if ($sf_user->isAuthenticated()): ?>
            <img class="avatar" src="https://demeter.utc.fr/pls/portal30/portal30.get_photo_utilisateur?username=<?php echo $membre->getUser()->getUsername() ?>" alt="Photo non disponible" style="background: url(web/images/default.jpg);" /><br />
          <?php else: ?>
            <img src="/images/default.jpg" />
          <?php endif ?>
          <a href="mailto:<?php echo $membre->getUser()->getEmailAddress() ?>"><?php echo $membre->getUser()->getName() ?></a><br />
          <?php echo $membre->getRole()->getName() ?> <?php echo $membre->getSemestre() ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    Aucun membre dans cette catégorie.
  <?php endif ?>
  <br class="clear" />
</div>