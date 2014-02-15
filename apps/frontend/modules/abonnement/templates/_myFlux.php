<?php use_helper('Thumb') ?>
<div id="my_flux">
  <h5 class="bulle">Mon Flux</h5>
  <?php if($abonnements && $abonnements->count() > 0): ?>
  <ul class="thumbnails">
    <?php foreach ($abonnements as $abonnement):?>
    <li class="span3">
      <div class="thumbnail">
        <div class="media">
          <a class="pull-left" href="<?php echo url_for('asso/show?login=' . $abonnement['assoName']) ?>">
            <?php echo showThumb($abonnement['assoLogo'], 'assos', array('width'=>32, 'height'=>32, 'class'=>'media-object'), 'center') ?>
          </a>
          <div class="media-body">
            <?php if($abonnement['article'] == 'event'): ?>
              <h5 class="media-heading">
                <a href="<?php echo url_for('event/show?id='.$abonnement['id']) ?>">
                  <?php echo $abonnement['name'] ?>
                </a>
                <i class="fa fa-calendar pull-right"></i>
              </h5>
              <?php echo $abonnement['summary'] ?>
            <?php elseif($abonnement['article'] == 'article'): ?>
              <h5 class="media-heading">
                <a href="<?php echo url_for('article/show?id='.$abonnement['id']) ?>">
                  <?php echo $abonnement['name'] ?>
                </a>
                <i class="fa fa-file-text pull-right"></i>
              </h5>
              <?php echo $abonnement['summary'] ?>
            <?php elseif($abonnement['article'] == 'galerie'): ?>
              <h5 class="media-heading">
                <a href="<?php echo url_for('galerie/show?id='.$abonnement['id']) ?>">
                  <?php echo $abonnement['name'] ?>
                </a>
                <i class="fa fa-camera pull-right"></i>
              </h5>
              <?php echo $abonnement['summary'] ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php else: ?>
    <p>Vous ne suivez aucune association.</p>
  <?php endif; ?>
</div>