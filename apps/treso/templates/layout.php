<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php include_javascripts() ?>
  </head>
  <body>

    <div class="navbar navbar-fixed-top navbar-inverse">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar pull-left" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <?php include_component('asso', 'myAssos', array('current_asso' => get_slot('current_asso'))) ?>
          <div class="btn-group pull-right">
            <?php if(!$sf_user->isAuthenticated()): ?>
              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#drop-connexion">
                <i class="icon-user"></i> Connexion
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu pull-right">
                <li><a href="<?php echo url_for('cas') ?>">Je suis étudiant</a></li>
                <li><a href="<?php echo url_for('sf_guard_signin') ?>">Extérieur</a></li>
              </ul>
            <?php else: ?>
              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#drop-connexion">
                <i class="icon-user"></i> <?php echo $sf_user->getGuardUser()->getName() ?>
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu pull-right">
                <li><a href="<?php echo url_for('cas_logout') ?>">Déconnexion du CAS</a></li>
              </ul>
            <?php endif ?>
          </div>
          <?php include_component('asso', 'menu', array('asso' => get_slot('current_asso'), 'cm' => get_slot('current_module'))) ?>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="well">
            <?php echo $sf_content ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
