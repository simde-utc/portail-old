<div id="my_flux">
  <h1>Mon Flux</h1>
  <?php if($abonnements && $abonnements->count() > 0): ?>
    <?php foreach ($abonnements as $abonnement):?>
      <?php if($abonnement['article'] == 'event'): ?>
        <div class="events_abonnements">
          <b><a href="<?php echo url_for('event/show?id='.$abonnement['id']) ?>"><?php echo $abonnement['assoName'].' : '.$abonnement['name'] ?></a></b>
          <?php echo $abonnement['summary'] ?>
          <div class="barre"></div>
        </div>
      <?php endif; ?>
      <?php if($abonnement['article'] == 'article'): ?>
        <div class="articles_abonnements">
          <b><a href="<?php echo url_for('article/show?id='.$abonnement['id']) ?>"><?php echo $abonnement['assoName'].' : '.$abonnement['name'] ?></a></b>
          <?php echo $abonnement['summary'] ?>
          <div class="barre"></div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php else: ?>
    Vous ne suivez aucune association.
  <?php endif; ?>
</div>