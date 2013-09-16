<?php if($asso): ?>
<div class="row">
  <div id="asso-menu" class="span12" style="background:<?php echo $couleur ?>">
    <a href="<?php echo url_for('assos_show', $asso) ?>"><i class="icon-home icon-white"></i> <?php echo $asso->getName() ?></a>
    <i class="icon-play icon-white"></i>
    <a href="<?php echo url_for('asso_articles', $asso) ?>">Articles</a>
    <a href="<?php echo url_for('asso_events', $asso) ?>">Événements</a>
    <a href="<?php echo url_for('asso_trombi', $asso) ?>">Trombinoscope</a>
    <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x02)): ?>
      <a href="<?php echo url_for('asso_member', $asso) ?>">Gestion des membres</a>
    <?php endif ?>
    <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x80)): ?>
      <a href="<?php echo url_for('gesmail', $asso) ?>">Gestion des mails</a>
    <?php endif ?>
    <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x40)): ?>
      <a href="<?php echo url_for('materiel', $asso) ?>">Matériel</a>
    <?php endif ?>
    <?php if($charte): ?>
      <a href="<?php echo url_for('asso_charte', $asso) ?>">Passation</a>
    <?php endif ?>
    <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->isMember($asso->getLogin())):  ?>
	  <a href="<?php echo url_for('locaux_charte', $asso) ?>">Charte Locaux</a>
	<?php endif ?>
  </div>
</div>
<?php endif ?>
