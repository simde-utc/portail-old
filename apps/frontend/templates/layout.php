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
    <div class="navbar navbar-inverse navbar-static-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="<?php echo url_for('homepage') ?>" title="Accueil"><img src="/images/logo_bde.png" alt="BDE UTC" /></a>
                <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <?php if(!$sf_user->isAuthenticated()): ?>
                        <li><a href="<?php echo url_for('cas') ?>"><i class="icon-lock icon-white"></i> Connexion CAS</a></li>
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
            </div>
          </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="span12">
                <img src="/images/background.jpg" />
            </div>
        </div>
        
        <div id="menu">
          <div class="row">
            <div class="span12">
              <a href="<?php echo url_for('homepage') ?>" class="first">Accueil</a>
              <a href="<?php echo url_for('asso/index') ?>" id="lienlisteassos">Associations</a>
              <a href="<?php echo url_for('agenda_detail') ?>">Calendrier</a>
              <a href="<?php echo url_for('infojob_home') ?>">InfoJob</a>              
              <a href="<?php echo url_for('services')?>">Services</a>
            </div>
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
          <div class="span10">
            <?php if($sf_user->hasFlash('error')): ?>
            <div class="alert alert-block alert-error">
              <?php echo $sf_user->getFlash('error'); ?>
            </div>
            <?php endif ?>
            <?php if($sf_user->hasFlash('warning')): ?>
            <div class="alert alert-block">
              <?php echo $sf_user->getFlash('warning'); ?>
            </div>
            <?php endif ?>
            <?php if($sf_user->hasFlash('info')): ?>
            <div class="alert alert-block alert-info">
              <?php echo $sf_user->getFlash('info'); ?>
            </div>
            <?php endif ?>
            <?php if($sf_user->hasFlash('success')): ?>
            <div class="alert alert-block alert-success">
              <?php echo $sf_user->getFlash('success'); ?>
            </div>
            <?php endif ?>
            <?php echo $sf_content ?>
          </div>
        </div>
    </div>
    <div id="footer">
      <div class="row-fluid">
        <div class="span4 offset2" id="splash">
          
        </div>
        <div class="span2 offset1">
          <h4>Services assos</h4>
          <a href="/gesmail">Gestion des mails assos</a><br/>
          <a href="/mail">Webmail assos</a><br />
          <a href="/treso.php">Outil trésorerie</a><br />
          <a href="/simde">SiMDE</a><br/>
          <a href="/wiki">Wiki des assos</a><br/>
        </div>
        <div class="span2">
          <h4>Liens</h4>
          <a href="http://ent.utc.fr">ENT</a><br/>
          <a href="http://www.utc.fr">UTC</a><br/>
          <a href="https://github.com/simde-utc/portail">Le portail sur GitHub</a>
        </div>
      </div>
    </div>
  </body>
</html>
