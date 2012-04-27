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
    <div id="top_bar">
      <div class="wrap" >
        <a href="<?php echo url_for('homepage') ?>" id="logo">
          <img src="/images/logo_bde.png" alt="BDE UTC" width="163px" height="110px" />
        </a>
        <form class="form-inline"><label>Rerchercher une info</label>
          <input type="text" class="input-medium" />
          <button type="submit" class="btn">Chercher</button>
        </form>
        <span class="barre"></span>
        <?php if(!$sf_user->isAuthenticated()): ?>
        <ul class="nav nav-pills">
          <li class="dropdown" id="drop-connexion">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#drop-connexion">
              Connexion
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu pull-right">
              <li><a href="<?php echo url_for('cas') ?>">Je suis étudiant</a></li>
              <li><a href="<?php echo url_for('sf_guard_signin') ?>">Extérieur</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo url_for('sf_guard_register') ?>">Inscription extérieur</a></li>
            </ul>
          </li>
        </ul>
        <?php else: ?>
        <ul class="nav nav-pills">
          <li class="dropdown" id="drop-connexion">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#drop-connexion">
              <?php echo $sf_user->getGuardUser()->getName() ?>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu pull-right">
              <li><a href="<?php echo url_for('cas_logout') ?>">Déconnexion du CAS</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo url_for('sf_guard_signout') ?>">Déconnexion du portail</a></li>
            </ul>
          </li>
        </ul>
        <?php endif ?>
      </div>
    </div>

    <div id="menu">
      <div class="wrap" >
        <a href="<?php echo url_for('homepage') ?>">Accueil</a>
        <a href="<?php echo url_for('asso/index') ?>" class="barre" id="lienlisteassos">Liste des associations</a>
        <a href="" class="barre">Services</a>
        <a href="" class="barre">Fonctionnement de l'UTC</a>
        <span class="horloge">
          <?php echo format_date(time(), "D", 'fr') ?>
          <span class="barre"><?php echo format_date(time(), "t", 'fr') ?></span>
        </span>
      </div>
    </div>
    <?php include_component('asso', 'bigMenu') ?>
    <?php if($sf_request->getParameter('module') == 'home'): ?>
      <?php include_component('event', 'carousel') ?>
    <?php elseif($sf_request->getParameter('login')): ?>
      <?php include_component('asso', 'menu') ?>
    <?php endif ?>;
    <div class="wrap">
      <div id="column-left">
        <?php if($sf_user->isAuthenticated()): ?>
          <?php include_component('asso', 'myAssos') ?>
        <?php else: ?>
          <?php include_partial('home/bienvenue') ?>
        <?php endif ?>
      </div>
      <div id="column-right">
        <div id="contact">
          <p>Contacter le BDE-UTC</p>
          <p>rue Roger Couttolenc<br />
            60200 Compiègne</p>
          <p>
            Tél : +33 3 44 23 43 71
          </p>
          <p>
            bde@assos.utc.fr<br />
            <?php echo url_for('asso/show?login=bde', true) ?>
          </p>
          <a href="" class="nousecrire">Nous écrire</a>
        </div>
      </div>      
      <div id="content">
        <?php echo $sf_content ?>
      </div>
      <div style="clear: both;"></div>
    </div>
    <div id="footer">
      <div class="wrap">
        <div id="splash"></div>
        <div id="footer-left">
          <p>
            <h2>Accueil</h2>
          </p>
          <p>
            <h2>Services</h2>
            <a href="">Matmatronch</a><br />
            <a href="">eboutic</a><br />
            <a href="">stocks à souvenir</a><br />
            <a href="">laverie</a><br />
            <a href="">weekmail</a><br />
            <a href="">forum</a><br />
            <a href="">pédagogie</a><br />
            <a href="">covoiturage</a><br />
            <a href="">prêt de matériel</a><br />
          </p>
        </div>
        <div id="footer-right">
          <p>
            <h2>Fonctionnement de l’utc</h2>
            <a href="">l’utc c’est quoi ?</a><br />
            <a href="">candidater à l’utc</a><br />
            <a href="">la vie d’étudiant</a><br />
            <a href="">les études proposées</a><br />
          </p>
          <p>
            <h2>Liste des assos</h2>
            <a href="">Vie du campus</a><br />
            <a href="">Artistique et évènementiel</a><br />
            <a href="">Solidarité et citoyenneté</a><br />
            <a href="">Technologie et entreprenariat</a><br />
            <a href="">sport</a><br />
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
