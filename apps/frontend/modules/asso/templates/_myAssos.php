<?php use_helper('Thumb') ?>
<div id="my_assos">
  <h1>Mes associations</h1>
  <?php if($assos && $assos->count() > 0): ?>
    <?php foreach($assos as $asso): ?>
      <div class="my_asso">
        <a href="<?php echo url_for('assos_show',$asso) ?>"><?php echo showThumb($asso->getLogo(), 'assos', array('width'=>32, 'height'=>32), 'center') ?></a>
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