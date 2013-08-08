<div id="my_services">
  <h1 class="bulle">Services Favoris</h1>
  <?php if (count($services) > 0): ?>
    <?php foreach ($services as $service): ?>
      <div class="my_asso">
        <a href="<?php echo $service->getService()->getUrl() ?>"><?php echo showThumb($service->getService()->getLogo(), 'assos', array('width'=>32, 'height'=>32), 'center') ?></a>
        <h2>
          <a href="<?php echo $service->getService()->getUrl() ?>"><?php echo $service->getService()->getNom() ?></a>
        </h2>
        <div class="barre"></div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Vous n'avez aucun service favori.</p>
  <?php endif; ?>
</div>
