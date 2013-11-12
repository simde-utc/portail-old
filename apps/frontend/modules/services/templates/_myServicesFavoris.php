<?php use_helper('Thumb') ?>
<div id="my_assos">
  <h5 class="bulle">Services Favoris</h4>
  <?php if (count($services) > 0): ?>
    <ul class="thumbnails">
      <?php foreach ($services as $service): ?>
        <li class="span3">
          <div class="thumbnail">
            <div class="media">
              <a class="pull-left" href="<?php echo $service->getService()->getUrl() ?>">
                <?php echo showThumb($service->getService()->getLogo(), 'services', array('width'=>32, 'height'=>32, 'class'=>'media-object'), 'center') ?>
              </a>
              <div class="media-body">
                <h5 class="media-heading"><a href="<?php echo $service->getService()->getUrl() ?>"><?php echo $service->getService()->getNom() ?></a></h5>
              </div>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>Vous n'avez aucun service favori.</p>
  <?php endif; ?>
</div>