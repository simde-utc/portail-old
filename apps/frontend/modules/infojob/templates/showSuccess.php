<div class="part" >
  <?php include_partial('infojob/topbar') ?>
  <div class="well"  style="border:1 px grey solid">
    <?php if($sf_user->isAuthenticated() && $annonce->getUserId() == $sf_user->getGuardUser()->getId()): ?>
      <a href="<?php echo url_for('annonce/edit?id=' . $annonce->getId()) ?>"  style="float:left;margin-top:12px; margin-right: 5px;"><i class="icon-pencil"></i></a>
    <?php endif ?>
    <h2><?php echo $annonce->getTitre() ?></h2>
    <p><?php echo $annonce->getTexte() ?></p>
    <p>
      <?php if($annonce->getRemuneration() != '0.00'): ?>Prix : <?php echo $annonce->getRemuneration() ?>€<br /><?php endif ?>
      <?php if($annonce->getLieu()): ?><b>Lieu:</b> <?php echo $annonce->getLieu() ?><br /><?php endif ?>
    </p>
    <p style="font-style: italic;">
      Posté le <?php echo $annonce->getCreatedAt() ?>
      <?php if($sf_user->isAuthenticated()): ?>
        par : <?php if($annonce->getUserId() != NULL): ?>
          <a href="mailto:<?php echo $annonce->getUser()->getEmailAddress() ?>"><?php echo $annonce->getUser()->getName(); ?></a>
          <?php
        else: echo $annonce->getEmail();
        endif;
        ?>
      <?php endif; ?>
    </p>
    <?php include_partial('infojob/showcontact') ?>
  </div>
</div>
