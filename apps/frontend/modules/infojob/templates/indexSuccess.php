<div class="part" >
  <?php include_partial('infojob/topbar') ?>
  <h1>InfoJob, le service emploi du BDE-UTC</h1>
  <div class="well">
    <p>Bienvenue sur le service InfoJob du BDE-UTC. Ici mettre le texte de présentation et la vidéo. TODO</p>
  </div>
  <a href="<?php echo url_for('infojob/new') ?>" style="color:#FFF" class="btn btn-primary btn-large">Poster une offre d'emploi</a><br />
  <br />

  <h1>Dernières annonces postées</h1>

  <?php foreach($annonces as $annonce): ?>
    <div class="well">
      <?php if($sf_user->isAuthenticated() && $annonce->getUserId() == $sf_user->getGuardUser()->getId()): ?>
        <a href="<?php echo url_for('annonce/edit?id=' . $annonce->getEmailkey()) ?>"  style="float:left;margin-top:12px; margin-right: 5px;"><i class="icon-pencil"></i></a>
      <?php endif ?>
      <h2><?php echo $annonce->getTitre() ?></h2>
      <p><?php echo $annonce->getTexte() ?></p>
      <p>
        <?php if($annonce->getRemuneration() != '0.00'): ?>Prix : <?php echo $annonce->getRemuneration() ?>€<br /><?php endif ?>
        <?php if($annonce->getLieu()): ?>Lieu : <?php echo $annonce->getLieu() ?><br /><?php endif ?>
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
      <a href="<?php echo url_for('infojob/show?id=' . $annonce->getId()) ?>">Voir la fiche</a>
    </div>
  <?php endforeach; ?>

 
</div>
