<div class="part" >

  <h1>Critères de recherche</h1>
  <br />
  <form class="form-horizontal form-filters well" method="post" action="">
    <?php foreach($filters as $row): ?>
      <div>
        <?php if(!$row->isHidden()): ?>
          <?php echo $row->renderLabel(); ?>
        <?php endif ?>
        <?php echo $row->render(); ?>
      </div>
    <?php endforeach ?>
    <input type="submit" value="Rechercher" class="btn btn-primary" />
  </form>
  <h1>Consultation des annonces</h1>
  <?php if($sf_user->isAuthenticated()): ?>
  <a href="<?php echo url_for('annonce/new') ?>" style="float:right;color:#FFF" class="btn btn-primary">Poster une annonce</a><br />
  <?php endif ?>
  <br />

  <?php foreach($annonces as $annonce): ?>
    <div class="well">
      <?php if($sf_user->isAuthenticated() && $annonce->getUserId() == $sf_user->getGuardUser()->getId()): ?>
        <a href="<?php echo url_for('annonce/edit?id='.$annonce->getId()) ?>"  style="float:left;margin-top:12px; margin-right: 5px;"><i class="icon-pencil"></i></a>
      <?php endif ?>
      <h2><?php echo $annonce->getTitre() ?></h2>
      <h3><?php echo ($annonce->getOffre() ? 'Je propose' : 'Je cherche' ) ?> <?php echo $annonce->getCategorie() ?></h3>
      <p><?php echo $annonce->getTexte() ?></p>
      <p>
        <?php if($annonce->getPrix() != '0.00'): ?>Prix : <?php echo $annonce->getPrix() ?>€<br /><?php endif ?>
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
    </div>
  <?php endforeach; ?>

</div>