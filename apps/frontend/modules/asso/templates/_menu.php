<div class="wrap">
  <div id="asso-menu" style="background: <?php echo $asso->getPole()->getCouleur() ?>;">
    <a href="<?php echo url_for('assos_show', $asso) ?>">Home</a>
    <a href="<?php echo url_for('asso_articles', $asso) ?>">Articles</a>
    <a href="<?php echo url_for('asso_events', $asso) ?>">Evénements</a>
    <a href="<?php echo url_for('asso_trombi', $asso) ?>">Trombinoscope</a>
    <a href="<?php echo url_for('asso_bureau', $asso) ?>">Bureau</a>
    <a href="<?php echo url_for('agenda_detail') ?>">Calendrier</a>
  </div>
</div>