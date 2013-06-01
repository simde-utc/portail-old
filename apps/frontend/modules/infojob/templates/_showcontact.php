<?php if($sf_user->isAuthenticated()): ?>
  <!-- TODO -->
<?php else: ?>
  <a href="http://portail.local/frontend_dev.php/infojob/offres" class="btn"><i class="icon-arrow-left"></i> Retour</a>
  <a href="http://portail.local/frontend_dev.php/infojob/new" class="btn btn-warning">Connectez-vous <i class="icon-white icon-share-alt"></i></a>
<?php endif; ?>
