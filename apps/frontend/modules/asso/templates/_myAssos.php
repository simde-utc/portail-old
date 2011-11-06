<div id="my_assos">
  <h1>Mes associations</h1>
  <?php if($assos && $assos->count() > 0): ?>
    <?php foreach($assos as $asso): ?>
      <div class="my_asso">
        <img src="<?php echo $asso->getLogo() ?>" width="64" height="64" alt="<?php echo $asso->getName() ?>" />
        <h2>
          <?php echo $asso->getName() ?>
        </h2>
        <div class="barre"></div>
        <a href="<?php echo url_for('assos_show',$asso) ?>" class="more">>> En savoir plus</a>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    Vous ne participez à aucune association.
  <?php endif; ?>
</div>