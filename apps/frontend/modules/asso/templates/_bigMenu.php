<div id="bigmenu">
  <div class="row-fluid">
    <?php $first = " offset1" ?>
    <?php foreach($poles as $pole): ?>
      <div class="bm_pole span2<?php echo $first; $first = ""; ?>">
        <h5><a href="<?php echo url_for('asso/show?login=' . $pole[0]->getPole()->getInfos()->getLogin()) ?>" title="<?php echo $pole[0]->getPole()->getInfos()->getName() ?>"><?php echo $pole[0]->getPole()->getInfos()->getName() ?></a></h5>
        <ul>
          <?php foreach($pole as $asso): ?>
            <li>
              <a href="<?php echo url_for('asso/show?login=' . $asso->getLogin()) ?>" title="<?php echo $asso->getName() ?>"><?php echo $asso->getName() ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endforeach; ?>
  </div>
</div>