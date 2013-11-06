<?php use_helper('Thumb') ?>
<div id="my_assos">
  <h1 class="bulle">Mes assos</h1>
  <?php if($assos && $assos->count() > 0): ?>
      <ul class="thumbnails">
      <?php foreach($assos as $asso): ?>
      <li class="span2">
        <div class="thumbnail">
          <div class="media">
              <a class="pull-left" href="<?php echo url_for('assos_show',$asso) ?>">
                  <?php echo showThumb($asso->getLogo(), 'assos', array('width'=>32, 'height'=>32, 'class'=>'media-object'), 'center') ?>
              </a>
              <div class="media-body">
                  <h2 class="media-heading"><a href="<?php echo url_for('assos_show',$asso) ?>"><?php echo $asso->getName() ?></a></h2>
              </div>
          </div>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>Vous ne participez à aucune association.</p>
  <?php endif; ?>
  <?php if($prev_assos && $prev_assos->count() > 0): ?>
    <h1>Précédentes assos</h1>
    <?php foreach($prev_assos as $asso): ?>
      <div class="my_asso">
        <a href="<?php echo url_for('assos_show',$asso) ?>"><?php echo showThumb($asso->getLogo(), 'assos', array('width'=>32, 'height'=>32), 'center') ?></a>
        <h2>
          <a href="<?php echo url_for('assos_show',$asso) ?>"><?php echo $asso->getName() ?></a>
        </h2>
        <div class="barre"></div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>