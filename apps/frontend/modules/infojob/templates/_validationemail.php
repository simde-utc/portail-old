<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
</head>
<body>
  <div>
    <img src="<?php echo public_path('images/logo_bde.png', true); ?>" alt="BDE UTC" width="163px" height="110px">
  </div>
  <div>
  	<h1>Merci d&#39;avoir choisi InfoJob ! </h1>
    <p>Votre offre a bien été enregistré sur le service InfoJob du portail des associations de l'UTC. Afin de valider la publication de votre offre, veuillez cliquez sur le lien suivant : </p>
    <a href="<?php echo url_for('infojob/activate?key=' . $annonce->getEmailkey(), true); ?>"><?php echo url_for('infojob/activate?key=' . $annonce->getEmailkey(), true); ?></a>
  </div>
  <div>
    <p>Vous pouvez à tout moment gérer votre annonce en cliquant sur le lien suivant : </p><a href="<?php echo url_for('infojob/edit?key=' . $annonce->getEmailkey(), true); ?>"><?php echo url_for('infojob/edit?key=' . $annonce->getEmailkey(), true); ?></a>
  </div>
</body>
</html>
