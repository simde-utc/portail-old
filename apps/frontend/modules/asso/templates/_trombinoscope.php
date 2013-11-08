<?php use_helper('Thumb') ?>
<div id="trombi">
   <?php if ($membres->count() > 0): ?>
    <ul class="thumbnails">
      <?php foreach ($membres as $membre) : ?>
        <li class="span2">
          <div class="thumbnail">
          <?php if ($sf_user->isAuthenticated()): ?>
            <img class="avatar" src="https://demeter.utc.fr/pls/portal30/portal30.get_photo_utilisateur?username=<?php echo $membre->getUser()->getUsername() ?>" alt="Photo non disponible" /><br />
          <?php else: ?>
            <img src="/images/default.jpg" />
          <?php endif ?>
          <h5><a href="mailto:<?php echo $membre->getUser()->getEmailAddress() ?>"><?php echo $membre->getUser()->getName() ?></a></h5>
          <p><?php echo $membre->getRole()->getName() ?> <?php echo $membre->getSemestre() ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    Aucun membre dans cette catégorie.
  <?php endif ?>
</div>