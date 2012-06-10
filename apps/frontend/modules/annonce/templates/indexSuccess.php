<div class="part" >
  <h1>Consultation des annonces</h1>
  <a href="<?php echo url_for('annonce/new') ?>" style="float:right;color:#FFF" class="btn btn-primary">Poster une annonce</a><br />
  <br />

  <?php foreach($annonces as $annonce): ?>
    <div class="well">
      <a href="<?php echo url_for('annonce/edit?id='.$annonce->getId()) ?>"  style="float:left;margin-top:12px; margin-right: 5px;"><i class="icon-pencil"></i></a><h2><?php echo $annonce->getTitre() ?></h2>
      <h3><?php echo $annonce->getCategorie() ?></h3>
      <?php echo ($annonce->getOffre() ? 'Je propose' : 'Je cherche' ) ?><br />
      <p><?php echo $annonce->getTexte() ?></p>
      <p>
        Prix: <?php echo $annonce->getPrix() ?><br />
        Ville: <?php echo $annonce->getVille() ?><br />
        Département : <?php echo $annonce->getDepartement() ?><br />
        Formation : <?php echo $annonce->getBranche() ?><br />
        Début : <?php echo $annonce->getDebut() ?><br />
        Fin : <?php echo $annonce->getFin() ?><br />
        Posté le <?php echo $annonce->getCreatedAt() ?><br />
      </p>
    </div>
  <?php endforeach; ?>

</div>