<div class="part" >
  <?php include_partial('infojob/topbar') ?>
  <h1>InfoJob TODO : page d'accueil, à modifier.</h1>
  <div class="well">
    <b>Les annonces postées sur ce portail ne traitent pas les catégories suivantes :</b><br><br>
    <ul>
      <li>les offres de logements de particulier ou d'agence car gérées par l'association <a href="http://www.utc.fr/alesc/">ALESC</a></li>
      <li>les offres de stage en entreprise car gérées par le service de l'UTC sur : <a href="http://utcenligne.utc.fr/">http://utcenligne.utc.fr/</a></li>
      <li>les offres de job de type projets car gérées par la Junior Entreprise <a href="http://wwwassos.utc.fr/usec">USEC</a></li>
      <li>les offres de covoiturage car gérées par l'association <a href="http://assos.utc.fr/edi">EDI</a></li>
      <li>les offres de soutien scolaire entre étudiants car gérées par l'association <a href="http://assos.utc.fr/tutorutc">Tutor'utc</a></li>
      <li>D'autres annonces sont également disponibles sur <a href="http://interne.utc.fr/spip.php?page=all-pa#annonce">le site interne de l'UTC</a></li>
    </ul>
  </div>

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
    <a href="<?php echo url_for('infojob/new') ?>" style="float:right;color:#FFF" class="btn btn-primary">Poster une annonce</a><br />
  <?php endif ?>
  <br />

  <?php foreach($annonces as $annonce): ?>
    <div class="well">
      <?php if($sf_user->isAuthenticated() && $annonce->getUserId() == $sf_user->getGuardUser()->getId()): ?>
        <a href="<?php echo url_for('annonce/edit?id=' . $annonce->getId()) ?>"  style="float:left;margin-top:12px; margin-right: 5px;"><i class="icon-pencil"></i></a>
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
