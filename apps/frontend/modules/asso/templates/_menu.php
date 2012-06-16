<div class="wrap">
  <div id="asso-menu" style="background:<?php echo $couleur ?>">
    <a href="<?php echo url_for('assos_show', $asso) ?>"><i class="icon-home icon-white"></i> <?php echo $asso->getName() ?></a>
    <span class="arrow-e"></span>
    <a href="<?php echo url_for('asso_articles', $asso) ?>">Articles</a>
    <a href="<?php echo url_for('asso_events', $asso) ?>">Événements</a>
    <a href="<?php echo url_for('asso_trombi', $asso) ?>">Trombinoscope</a>
    <a href="<?php echo url_for('asso_bureau', $asso) ?>">Bureau</a>
    <a href="<?php echo url_for('asso_albums', $asso) ?>">Albums photos</a>
  </div>
</div>