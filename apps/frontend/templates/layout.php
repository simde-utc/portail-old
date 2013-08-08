<?php use_helper('Date') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="<?php echo url_for('homepage') ?>" title="Accueil"><img src="/images/logo_bde.png" alt="BDE UTC" /></a>
                <ul class="nav">
                    <li><a href="<?php echo url_for('asso/index') ?>" id="lienlisteassos">Associations<span class="caret"></span></a></li>
                    <li><a href="<?php echo url_for('agenda_detail') ?>">Calendrier</a></li>
                    <li><a href="<?php echo url_for('services')?>" class="barre" id="lienlisteservices">Services</a></li>
                </ul>
                <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <?php if(!$sf_user->isAuthenticated()): ?>
                        <li><a href="<?php echo url_for('cas') ?>">Connexion CAS</a></li>
                    <?php else: ?>
                        <li class="dropdown" id="drop-connexion">
                            <a href="#drop-connexion" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-user icon-white"></i>
                                <?php echo $sf_user->getGuardUser()->getName() ?>
                                <b class="caret"></b>
                            </a>              
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo url_for('profile_show') ?>">Mon Profil</a></li>
                                <li><a href="<?php echo url_for('sf_guard_signout') ?>">Se déconnecter</a></li>
                            </ul>
                        </li>
                    <?php endif ?>
                </ul>
                <form class="navbar-search pull-right" action="<?php echo url_for("search") ?>">
                    <input type="text" id="search-box" class="search-query span2" placeholder="Rechercher" name="query" value="">
                </form>
                <div id="search-results"></div>
            </div>
          </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="span12" id="top_bar">
                <img src="/images/background.jpg" />
            </div>
        </div>
        
        <?php include_component('asso', 'bigMenu') ?>
        
        <?php if($sf_request->getParameter('module') == 'home'): ?>
          <?php include_component('event', 'carousel') ?>
        <?php elseif($sf_request->getParameter('login') || $sf_request->getParameter('asso')): ?>
          <?php include_component('asso', 'menu') ?>
        <?php endif ?>    
        <div class="row">
          <div class="span2" id="column-left">
            <?php if($sf_user->isAuthenticated()): ?>
              <?php include_component('asso', 'myAssos') ?>
              <?php include_component('abonnement', 'myFlux') ?>
              <?php include_component('services', 'myServicesFavoris') ?>
            <?php else: ?>
              <?php include_partial('home/bienvenue') ?>
            <?php endif ?>
          </div>
          <div class="span10" id="content">
            <?php if($sf_user->hasFlash('error')): ?>
            <div class="alert alert-block alert-error">
              <strong>Erreur !</strong>
              <?php echo $sf_user->getFlash('error'); ?>
            </div>
            <?php endif ?>
            <?php if($sf_user->hasFlash('warning')): ?>
            <div class="alert alert-block">
              <strong>Avertissement !</strong>
              <?php echo $sf_user->getFlash('warning'); ?>
            </div>
            <?php endif ?>
            <?php if($sf_user->hasFlash('info')): ?>
            <div class="alert alert-block alert-info">
              <strong>Information !</strong>
              <?php echo $sf_user->getFlash('info'); ?>
            </div>
            <?php endif ?>
            <?php if($sf_user->hasFlash('success')): ?>
            <div class="alert alert-block alert-success">
              <strong>Succès !</strong>
              <?php echo $sf_user->getFlash('success'); ?>
            </div>
            <?php endif ?>
            <?php echo $sf_content ?>
          </div>
        </div>
    </div>
    <div id="footer">
      <div class="wrap">
        <div id="splash"></div>
        <div id="footer-left">
          <h2>Services</h2>
          <a href="/gesmail">Gestion des mails assos</a><br/>
          <a href="/resa">Réservation de salles</a><br/>
          <a href="/mail">Webmail assos</a><br /><br />
        </div>
        <div id="footer-right">
          <h2>Liens</h2>
          <a href="http://ent.utc.fr">ENT</a><br/>
          <a href="/simde">SiMDE</a><br/>
          <a href="/wiki">Wiki des assos</a><br/>
          <a href="http://www.utc.fr">UTC</a><br/>
          <a href="https://github.com/simde-utc/portail">Dépôt GitHub</a>
        </div>
      </div>
    </div>
  </body>
</html>
