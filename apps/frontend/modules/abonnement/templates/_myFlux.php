<div id="my_flux">
  <h5 class="bulle">Mon Flux</h5>
  <?php if($abonnements && $abonnements->count() > 0): ?>
    <?php foreach ($abonnements as $abonnement):?>
      <?php if($abonnement['article'] == 'event'): ?>
        <p class="events_abonnements thumbnail">
          <b><a href="<?php echo url_for('event/show?id='.$abonnement['id']) ?>"><?php echo $abonnement['assoName'].' : '.$abonnement['name'] ?></a></b>
          <?php echo $abonnement['summary'] ?></br>
          Evènement
        </p>
      <?php elseif($abonnement['article'] == 'article'): ?>
        <p class="articles_abonnements thumbnail">
          <b><a href="<?php echo url_for('article/show?id='.$abonnement['id']) ?>"><?php echo $abonnement['assoName'].' : '.$abonnement['name'] ?></a></b>
          <?php echo $abonnement['summary'] ?></br>
          Article
          <div class="barre"></div>
        </p>
      <?php elseif($abonnement['article'] == 'galerie'): ?>
        <p class="galeries_abonnements thumbnail">
          <b><a href="<?php echo url_for('galerie/show?id='.$abonnement['id']) ?>"><?php echo $abonnement['assoName'].' : '.$abonnement['name'] ?></a></b>
          <?php echo $abonnement['summary'] ?></br>
          Galerie Photo
          <div class="barre"></div>
        </p>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Vous ne suivez aucune association.</p>
  <?php endif; ?>
</div>