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
  <a href="<?php echo url_for('annonce/new') ?>" style="float:right;color:#FFF" class="btn btn-primary">Poster une annonce</a><br />
  <br />

  <?php foreach($annonces as $annonce): ?>
    <div class="well">
      <?php if($sf_user->isAuthenticated() && $annonce->getUserId() == $sf_user->getGuardUser()->getId()): ?>
        <a href="<?php echo url_for('annonce/edit?id='.$annonce->getId()) ?>"  style="float:left;margin-top:12px; margin-right: 5px;"><i class="icon-pencil"></i></a>
      <?php endif ?>
      <h2><?php echo $annonce->getTitre() ?></h2>
      <h3><?php echo $annonce->getCategorie() ?></h3>
      <?php echo ($annonce->getOffre() ? 'Je propose' : 'Je cherche' ) ?><br />
      <p><?php echo $annonce->getTexte() ?></p>
      <p>
        <?php if($annonce->getPrix() != '0.00'): ?>Prix: <?php echo $annonce->getPrix() ?><br /><?php endif ?>
        <?php if($annonce->getVille()): ?>Ville: <?php echo $annonce->getVille() ?><br /><?php endif ?>
        <?php if($annonce->getDepartement()): ?>Département : <?php echo $annonce->getDepartement() ?><br /><?php endif ?>
        <?php if($annonce->getBranche()): ?>Formation : <?php echo $annonce->getBranche() ?><br /><?php endif ?>
        <?php if($annonce->getDebut()): ?>Début : <?php echo $annonce->getDebut() ?><br /><?php endif ?>
        <?php if($annonce->getFin()): ?>Fin : <?php echo $annonce->getFin() ?><br /><?php endif ?>
        Posté le <?php echo $annonce->getCreatedAt() ?><br />
        <?php if($sf_user->isAuthenticated()): ?>
          Posté par : <?php if($annonce->getUser()): ?>
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