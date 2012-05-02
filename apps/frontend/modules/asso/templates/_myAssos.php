<div id="my_assos">
  <h1>Mes associations</h1>
  <?php if($assos && $assos->count() > 0): ?>
    <?php foreach($assos as $asso): ?>
      <div class="my_asso">
        <a href="<?php echo url_for('assos_show',$asso) ?>"><img src="<?php echo $asso->getLogo() ?>" width="32" height="32" alt="<?php echo $asso->getName() ?>" /></a>
        <h2>
          <a href="<?php echo url_for('assos_show',$asso) ?>"><?php echo $asso->getName() ?></a>
        </h2>
        <div class="barre"></div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    Vous ne participez à aucune association.
  <?php endif; ?>
</div>