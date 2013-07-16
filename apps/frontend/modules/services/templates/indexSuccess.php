<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>
<div class="part">
  <h1> Les Services Asso</h1>
  <ul id="services_list">
    <?php foreach ($services as $service): ?>
      <?php if ($service->getTypeId() == '1') : ?>
        <li>
          <a href="<?php echo $service->getUrl() ?>" style="float:left;">
            <?php echo showThumb($service->getLogo(), 'assos', array('width' => 85, 'height' => 85, 'class' => 'logo'), 'center') ?>
          </a>
          <a href="<?php echo $service->getUrl() ?>">
            <h3><?php echo $service->getNom() ?></h3>
          </a>
          <div class="desc">
            <?php echo $service->getResume() ?>
            <br />
            <?php if ($sf_user->isAuthenticated()): ?>
              <?php if (!$sf_user->getGuardUser()->isFollowerService($service)): ?>
                <a href="<?php echo url_for('services_follow', $service) ?>" class="btn"><i class="icon-plus"></i>
                  Ajouter aux favoris</a><br/>
              <?php else: ?>
                <a href="<?php echo url_for('services_unfollow', $service) ?>" class="btn"><i class="icon-remove"></i>
                  Retirer des favoris</a><br/>
              <?php endif; ?>
            <?php else: ?>
              Connectez-vous pour ajouter ce service à vos favoris.
            <?php endif; ?>
          </div>
        </li>
      <?php endif; ?>
    <?php endforeach ?>
  </ul>
  <h1> Les Services UTC</h1>
  <ul id="services_list">
    <?php foreach ($services as $service): ?>
      <?php if ($service->getTypeId() == '2') : ?>
        <li>
          <a href="<?php echo $service->getUrl() ?>" style="float:left;">
            <?php echo showThumb($service->getLogo(), 'assos', array('width' => 85, 'height' => 85, 'class' => 'logo'), 'center') ?>
          </a>
          <a href="<?php echo $service->getUrl() ?>">
            <h3><?php echo $service->getNom() ?></h3>
          </a>
          <div class="desc">
            <?php echo $service->getResume() ?>
            <br />
            <?php if ($sf_user->isAuthenticated()): ?>
              <?php if (!$sf_user->getGuardUser()->isFollowerService($service)): ?>
                <a href="<?php echo url_for('services_follow', $service) ?>" class="btn"><i class="icon-plus"></i>
                  Ajouter aux favoris</a><br/>
              <?php else: ?>
                <a href="<?php echo url_for('services_unfollow', $service) ?>" class="btn"><i class="icon-remove"></i>
                  Retirer des favoris</a><br/>
              <?php endif; ?>
            <?php else: ?>
              Connectez-vous pour ajouter ce service à vos favoris.
            <?php endif; ?>
          </div>
        </li>
      <?php endif; ?>
    <?php endforeach ?>
  </ul>
  <h1> Les Services de la Ville</h1>
  <ul id="services_list">
    <?php foreach ($services as $service): ?>
      <?php if ($service->getTypeId() == '3') : ?>
        <li>
          <a href="<?php echo $service->getUrl() ?>" style="float:left;">
            <?php echo showThumb($service->getLogo(), 'assos', array('width' => 85, 'height' => 85, 'class' => 'logo'), 'center') ?>
          </a>
          <a href="<?php echo $service->getUrl() ?>">
            <h3><?php echo $service->getNom() ?></h3>
          </a>
          <div class="desc">
            <?php echo $service->getResume() ?>
            <br />
            <?php if ($sf_user->isAuthenticated()): ?>
              <?php if (!$sf_user->getGuardUser()->isFollowerService($service)): ?>
                <a href="<?php echo url_for('services_follow', $service) ?>" class="btn"><i class="icon-plus"></i>
                  Ajouter aux favoris</a><br/>
              <?php else: ?>
                <a href="<?php echo url_for('services_unfollow', $service) ?>" class="btn"><i class="icon-remove"></i>
                  Retirer des favoris</a><br/>
              <?php endif; ?>
            <?php else: ?>
              Connectez-vous pour ajouter ce service à vos favoris.
            <?php endif; ?>
          </div>
        </li>
      <?php endif; ?>
    <?php endforeach ?>
  </ul>
</div>
