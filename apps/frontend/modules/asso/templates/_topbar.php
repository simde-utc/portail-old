<?php use_helper('Thumb') ?>
<h1>
  <?php echo $asso->getName() ?> en bref
  <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x01)): ?>
    <span class="titleaction"><i class="icon-edit icon-white"></i> <a href="<?php echo url_for('asso_edit', $asso) ?>">Éditer</a></span>
  <?php endif ?>
</h1>
<div id="topbar">
  <div class="logo_asso"><?php echo showThumb($asso->getLogo(), 'assos', array('width' => 150, 'height' => 150), 'scale') ?></div>

  <div class="desc">
    <?php echo nl2br($asso->getDescription()) ?>
  </div>
  <a class="website" href="<?php echo $asso->getUrlSite() ?>"><?php echo $asso->getUrlSite() ?></a><br />
  <a class="email "href="mailto:<?php echo $asso->getLogin() ?>@assos.utc.fr"><?php echo $asso->getLogin() ?>@assos.utc.fr</a><br />
  <br />
  <?php if($asso->getJoignable()): ?>
    <?php if($sf_user->isAuthenticated()): ?>
      <?php if(!$sf_user->getGuardUser()->isMember($asso->getLogin())): ?>
        <a href="<?php echo url_for('asso_join', $asso) ?>" class="btn"><i class="icon-ok"></i> Rejoindre cette association</a><br />
      <?php else: ?>
      <a href="<?php echo url_for('asso_leave',$asso) ?>" class="btn"><i class="icon-remove"></i> Quitter cette association</a><br />
    <?php endif; ?>
        <?php if(!$sf_user->getGuardUser()->isFollower($asso->getId())): ?>
      <a href="<?php echo url_for('asso_follow',$asso) ?>" class="btn"><i class="icon-ok"></i> Suivre les actualités de cette association</a><br />
    <?php else: ?>
      <a href="<?php echo url_for('asso_unfollow',$asso) ?>" class="btn"><i class="icon-remove"></i> Ne plus suivre les actualités de cette association</a><br />
    <?php endif; ?>
  <?php else: ?>
    Connectez-vous pour rejoindre cette association
  <?php endif ?>
  <?php endif; ?>
</div>
