
<div class="part" >
  <?php include_partial('infojob/topbar') ?>

  <div class="well">
    <h1>Filtrer les offres</h1> 
    <form class="form-horizontal form-filters well" method="post" action="">
      <?php foreach($filters as $row): ?>
      <div>
        <?php if(!$row->isHidden()): ?>

        <br/>
        <b><?php echo $row->renderLabel(); ?></b>
        <?php endif ?>
        <?php echo $row->render(); ?>

      </div>
      <?php endforeach ?>
      <br/>
      <input type="submit" value="Rechercher" class="btn btn-primary" />
    </form>
  </div>


  <h1>Annonces</h1>
  <?php foreach($annonces as $annonce): ?>
  <div class="well">
  

    <?php if($sf_user->isAuthenticated() && $annonce->getUserId() == $sf_user->getGuardUser()->getId()): ?>
      <a href="<?php echo url_for('annonce/edit?id=' . $annonce->getEmailkey()) ?>"  style="float:left;margin-top:12px; margin-right: 5px;"><i class="icon-pencil"></i></a>
    <?php endif ?>
    <h2>Annonce n°<?php echo $annonce->getId() ?>:<?php echo $annonce->getTitre() ?></h2>
    <p><?php echo $annonce->getTexte() ?></p>
    <p>
      <?php if($annonce->getRemuneration() != '0.00'): ?><strong>Prix</strong> : <?php echo $annonce->getRemuneration() ?>€<br /><?php endif ?>
      <?php if($annonce->getLieu()): ?><strong>Lieu :</strong> <?php echo $annonce->getLieu() ?><br /><?php endif ?>
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
    <a href="<?php echo url_for('infojob/show?id=' . $annonce->getId()) ?>" class="btn btn-info" style="color: #FFFFFF;">Voir la fiche</a>
  </div>

  <?php endforeach; ?>
</div>
