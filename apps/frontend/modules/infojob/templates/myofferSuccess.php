<div class="part" >
  <?php include_partial('infojob/topbar'); ?>
  <h1>Modifier votre annonce</h1>
  <div class="well">
    <p>Si cette annonce vous appartient et que vous souhaitez la modifier ou la retirer du site, vous pouvez effectuer ces opérations à partir du lien qui vous a été envoyé après la création de l'annonce.</p><br/>
    <p>Si vous n'avez plus accès à cet email, vous pouvez recevoir un nouveau email :</p>
    <form class="infojob-form" action="<?php echo url_for('infojob/myofferdo')?>" method="post">
      <input type="hidden" name="offre_id" value="<?php echo $annonce->getId(); ?>" />
      <input class="btn btn-primary" type="submit" value="Renvoyer un email au créateur de l'annonce" />
    </form>
    <br/>
    &nbsp;<a href="<?php echo url_for('infojob/show?id=' . $annonce->getId()) ?>"class="btn active">Retour à l'annonce</i></a>
  </div>
</div>
