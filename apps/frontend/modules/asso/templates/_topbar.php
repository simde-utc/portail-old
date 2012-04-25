<h1>
  Notre description
  <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x01)): ?>
    <span class="titleaction"><i class="icon-edit icon-white"></i> <a href="<?php echo url_for('asso_edit', $asso) ?>">Éditer</a></span>
  <?php endif ?>
</h1>
<div id="topbar">
  <div class="logo_asso"><img src="<?php echo $asso->getLogo() ?>"></div>

  <div class="desc">
    <?php echo html_entity_decode($asso->getDescription()) ?>
  </div>
  <a class="website" href="<?php echo $asso->getUrlSite() ?>"><?php echo $asso->getUrlSite() ?></a><br />
  <a class="email "href="mailto:<?php echo $asso->getLogin() ?>@assos.utc.fr"><?php echo $asso->getLogin() ?>@assos.utc.fr</a><br />
  <br />
  <?php if($sf_user->isAuthenticated()): ?>
    <?php if(!$sf_user->getGuardUser()->isMember($asso->getLogin())): ?>
      <a href="#">Je souhaite rejoindre cette association</a><br />
    <?php else: ?>
        <?php if($sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x04)): ?>
        <a href="<?php echo url_for('article_new', $asso) ?>">Ajouter un article</a><br />
      <?php endif ?>
        <?php if($sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x08)): ?>
        <a href="<?php echo url_for('event_new', $asso) ?>">Ajouter un événement</a><br />
      <?php endif ?>
    <?php endif ?>
  <?php else: ?>
    Vous devez être connecté pour rejoindre cette association.
  <?php endif ?>
</div>
