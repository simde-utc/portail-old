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

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Admin Portail</a>
          <div class="btn-group pull-right">
            <?php if(!$sf_user->isAuthenticated()): ?>
              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#drop-connexion">
                <i class="icon-user"></i> Connexion
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu pull-right">
                <li><a href="<?php echo url_for('cas') ?>">Je suis étudiant</a></li>
                <li><a href="<?php echo url_for('sf_guard_signin') ?>">Extérieur</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo url_for('sf_guard_register') ?>">Inscription extérieur</a></li>
              </ul>
            <?php else: ?>
              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#drop-connexion">
                <i class="icon-user"></i> <?php echo $sf_user->getGuardUser()->getName() ?>
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu pull-right">
                <li><a href="<?php echo url_for('cas_logout') ?>">Déconnexion du CAS</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo url_for('sf_guard_signout') ?>">Déconnexion du portail</a></li>
              </ul>
            <?php endif ?>
          </div>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="<?php echo url_for('homepage') ?>">Home</a></li>
              <li><a href="<?php echo url_for('sf_guard_user') ?>">Users</a></li>
              <li><a href="<?php echo url_for('asso') ?>">Assos</a></li>
              <li><a href="<?php echo url_for('asso_member') ?>">Membres</a></li>
              <li><a href="<?php echo url_for('role') ?>">Roles</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Utilisateurs</li>
              <li><a href="<?php echo url_for('sf_guard_user') ?>">Utilisateurs</a></li>
              <li><a href="<?php echo url_for('sf_guard_group') ?>">Groupes</a></li>
              <li><a href="<?php echo url_for('sf_guard_permission') ?>">Permissions</a></li>
              <li class="nav-header">Associations</li>
              <li><a href="<?php echo url_for('asso') ?>">Liste des associations</a></li>
              <li><a href="<?php echo url_for('asso_new') ?>">Nouvelle association</a></li>
              <li><a href="<?php echo url_for('asso_member') ?>">Liste des membres assos</a></li>
              <li><a href="<?php echo url_for('asso_member_new') ?>">Nouveau membre asso</a></li>
              <li class="nav-header">Données du portail</li>
              <li><a href="<?php echo url_for('role') ?>">Liste des rôles</a></li>
              <li><a href="<?php echo url_for('role_new') ?>">Nouveau rôle</a></li>
              <li><a href="<?php echo url_for('semestre') ?>">Liste des semestres</a></li>
              <li><a href="<?php echo url_for('semestre_new') ?>">Nouveau semestre</a></li>
              <li><a href="<?php echo url_for('event_type') ?>">Liste des types d'événements</a></li>
              <li><a href="<?php echo url_for('event_type_new') ?>">Nouveau type d'événements</a></li>
              <li class="nav-header">SiMDE</li>
              <li><a href="<?php echo url_for('charte_info') ?>">Signatures Chartes Info</a></li>
              <li><a href="<?php echo url_for('charte_info_new') ?>">Nouvelle Charte Info</a></li>
              <li class="nav-header">Elections BDE</li>
              <li><a href="<?php echo url_for('vote_liste') ?>">Edition des listes</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">
          <div class="well">
            <?php echo $sf_content ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
