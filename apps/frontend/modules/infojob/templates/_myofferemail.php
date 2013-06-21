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
  	<h1>Votre annonce sur InfoJob </h1>
    <p>Afin de modifier ou de retirer votre annonce "<?php echo $annonce->getTitre(); ?>" du service InfoJob, vous pouvez suivre le lien suivant : </p><a href="<?php echo url_for('infojob/edit?key=' . $annonce->getEmailkey(), true); ?>"><?php echo url_for('infojob/edit?key=' . $annonce->getEmailkey(), true); ?></a>
  </div>
  <div>
    <p>Si vous n'avez pas demandé l'envoie de cet email, vous pouvez l'ignorer et le supprimer.</a>
  </div>
</body>
</html>
