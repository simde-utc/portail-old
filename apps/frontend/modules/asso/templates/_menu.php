<div class="wrap">
<div id="asso-menu">
  <a href="<?php echo url_for('assos_show',array('login' => $sf_request->getParameter('login'))) ?>">Home</a>
  <a href="<?php echo url_for('asso_articles',array('login' => $sf_request->getParameter('login'))) ?>">Articles</a>
  <a href="<?php echo url_for('asso_events',array('login' => $sf_request->getParameter('login'))) ?>">Evénements</a>
  <a href="<?php echo url_for('asso_trombi',array('login' => $sf_request->getParameter('login'))) ?>">Trombinoscope</a>
  <a href="<?php echo url_for('asso_bureau',array('login' => $sf_request->getParameter('login'))) ?>">Bureau</a>
  <a href="">Calendrier</a>
</div>
</div>