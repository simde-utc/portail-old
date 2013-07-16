<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>
<div class="part">
  <h1> Les Services Asso</h1>
  <ul id="services_list">
    <br>
    <?php foreach ($services as $service):?>
      <?php if($service->getTypeId() =='1') : ?>
        <li>
        <a href="<?php echo $service->getUrl() ?>"><h3><?php echo $service->getNom() ?></h3> </a><br />

          <?php echo showThumb($service->getLogo(), 'assos', array('width'=>85, 'height'=>85, 'class'=>'logo'), 'center') ?>
          <div class="desc">
            <br>
            <?php echo $service->getResume() ?>
            <?php if($sf_user->isAuthenticated()): ?>
              <br>
              <br>
              <?php if(!$sf_user->getGuardUser()->isFollowerService($service)): ?>
                <a href="<?php echo url_for('services_follow', $service) ?>" class="btn"><i class="icon-ok"></i> Ajouter dans les services favoris</a><br />
              <?php else: ?>
                <a href="<?php echo url_for('services_unfollow', $service) ?>" class="btn"><i class="icon-remove"></i> Retirer des favoris</a><br />
              <?php endif; ?>
            <?php else: ?>
              Connectez-vous pour ajouter ce service à vos favoris.
            <?php endif; ?>
            </br>
          </div>
        </li>
      <?php endif ;?>
    <?php endforeach ?>
    <br>
  </ul>
</div>

<div class="part">
  <h1> Les Services UTC</h1>
  <ul id="services_list">
    <br>
    <?php foreach ($services as $service):?>
      <?php if($service->getTypeId() =='2') : ?>
        <li>
          <a href="<?php echo $service->getUrl() ?>"><h3><?php echo $service->getNom() ?></h3> </a><br />
          <?php echo showThumb($service->getLogo(), 'assos', array('width'=>85, 'height'=>85, 'class'=>'logo'), 'center') ?>
          <div class="desc">
            <br>
            <?php echo $service->getResume() ?>
            <?php if($sf_user->isAuthenticated()): ?>
              <br>
              <br>
              <?php if(!$sf_user->getGuardUser()->isFollowerService($service)): ?>
                <a href="<?php echo url_for('services_follow', $service) ?>" class="btn"><i class="icon-ok"></i> Ajouter dans les services favoris</a><br />
              <?php else: ?>
                <a href="<?php echo url_for('services_unfollow', $service) ?>" class="btn"><i class="icon-remove"></i> Retirer des favoris</a><br />
              <?php endif; ?>
            <?php else: ?>
              Connectez-vous pour ajouter ce service à vos favoris.
            <?php endif; ?>
            </br>
          </div>
        </li>
      <?php endif ;?>
    <?php endforeach ?>
    <br>
  </ul>
</div>

<div class="part">
  <h1> Les Services de la Ville</h1>
  <ul id="services_list">
    <br>
    <?php foreach ($services as $service):?>
      <?php if($service->getTypeId() =='3') : ?>
        <li>
          <a href="<?php echo $service->getUrl() ?>"><h3><?php echo $service->getNom() ?></h3> </a><br />
          <?php echo showThumb($service->getLogo(), 'assos', array('width'=>85, 'height'=>85, 'class'=>'logo'), 'center') ?>
          <div class="desc">
            <br>
            <?php echo $service->getResume() ?>
            <?php if($sf_user->isAuthenticated()): ?>
              <br>
              <br>
              <?php if(!$sf_user->getGuardUser()->isFollowerService($service)): ?>
                <a href="<?php echo url_for('services_follow', $service) ?>" class="btn"><i class="icon-ok"></i> Ajouter dans les services favoris</a><br />
              <?php else: ?>
                <a href="<?php echo url_for('services_unfollow', $service) ?>" class="btn"><i class="icon-remove"></i> Retirer des favoris</a><br />
              <?php endif; ?>
            <?php else: ?>
              Connectez-vous pour ajouter ce service à vos favoris.
            <?php endif; ?>
            </br>
          </div>
        </li>
      <?php endif ;?>
    <?php endforeach ?>
    <br>
  </ul>
</div>
