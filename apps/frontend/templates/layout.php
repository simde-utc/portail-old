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
    <div id="top_bar" class="navbar">
      <div class="wrap" >
        <a href="<?php echo url_for('homepage') ?>" id="logo">
          <img src="/images/logo_bde.png" alt="BDE UTC" width="163px" height="110px" />
        </a>
        <?php if(0): ?>
        <form class="form-inline"><label>Rechercher une info</label>
          <input type="text" class="input-medium" />
          <button type="submit" class="btn">Chercher</button>
        </form>
        <span class="barre"></span>
        <?php endif; ?>
        <?php if(!$sf_user->isAuthenticated()): ?>
          <ul class="nav pull-right">
            <li class="dropdown" id="drop-connexion">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#drop-connexion">
                Connexion
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo url_for('cas') ?>">Étudiant UTC (CAS)</a></li>
                <?php /*<li><a href="<?php echo url_for('sf_guard_signin') ?>">Extérieur</a></li>*/ ?>
              </ul>
            </li>
          </ul>
        <?php else: ?>
          <ul class="nav pull-right">
            <li class="dropdown" id="drop-connexion">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#drop-connexion">
                <i class="icon-user icon-white"></i> <?php echo $sf_user->getGuardUser()->getName() ?>
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo url_for('sf_guard_signout') ?>">Se déconnecter</a></li>
              </ul>
            </li>
          </ul>
        <?php endif ?>
      </div>
    </div>

    <div id="menu">
      <div class="wrap" >
        <a href="<?php echo url_for('homepage') ?>">Accueil</a>
        <a href="<?php echo url_for('asso/index') ?>" class="barre" id="lienlisteassos">Toutes les associations</a>
        <a href="<?php echo url_for('agenda_detail') ?>" class="barre">Calendrier</a>
        <?php /*<a href="<?php echo url_for('annonce') ?>" class="barre">Annonces</a>*/ ?>
        <span class="horloge">
          <?php echo format_date(time(), "D", 'fr') ?>
          <span class="barre"><?php echo format_date(time(), "t", 'fr') ?></span>
        </span>
      </div>
    </div>
    <?php include_component('asso', 'bigMenu') ?>
    <?php if($sf_request->getParameter('module') == 'home'): ?>
      <?php include_component('event', 'carousel') ?>
    <?php elseif($sf_request->getParameter('login') || $sf_request->getParameter('asso')): ?>
      <?php include_component('asso', 'menu') ?>
    <?php endif ?>
    <div class="wrap">
      <div id="column-left">
        <?php if($sf_user->isAuthenticated()): ?>
          <?php include_component('asso', 'myAssos') ?>
        <?php else: ?>
          <?php include_partial('home/bienvenue') ?>
        <?php endif ?>
      </div> 
      <div id="content">
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
          <a href="http://www.utc.fr">UTC</a>
        </div>
      </div>
    </div>
  </body>
</html>
