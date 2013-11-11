<?php use_helper('Thumb') ?>
<div id="my_assos">
  <?php if($assos && $assos->count() > 0): ?>
      <ul class="thumbnails">
      <?php foreach($assos as $asso): ?>
      <li class="span3">
        <div class="thumbnail">
          <div class="media">
              <a class="pull-left" href="<?php echo url_for('assos_show',$asso) ?>">
                  <?php echo showThumb($asso->getLogo(), 'assos', array('width'=>32, 'height'=>32, 'class'=>'media-object'), 'center') ?>
              </a>
              <div class="media-body">
                  <h5 class="media-heading"><a href="<?php echo url_for('assos_show',$asso) ?>"><?php echo $asso->getName() ?></a></h5>
              </div>
          </div>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>Vous ne participez à aucune association.</p>
  <?php endif; ?>
</div>
