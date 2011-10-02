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
      <div style="width: 1200px; margin-left: auto; margin-right: auto; text-align: right;" >
          <span>RECHERCHER UNE INFO <input type="text" /><button>CHERCHER</button></span> 
	  <span>| F T +1 | S'IDENTIFIER | S'INSCRIRE</span>
      </div>
    </div>
    <div id="wrap">
      <div id="header">
        <div id="header_login">
          <?php if($sf_user->isAuthenticated()): ?>
	    <?php print($sf_user); ?>
          <?php else: ?>
            <?php include_component('sfGuardAuth','signin_form') ?>
          <?php endif ?>
        </div>
        <div id="header_logo">
          <img src="/images/logo_bde.jpg" alt="BDE UTC" width="256px" height="150px" />
        </div>
        <div id="header_titre">
          <center><h1>Portail des étudiants UTC</h1></center>
        </div>
        <div id="header_menu">
          <div class="menu"><a href="<?php echo url_for('@homepage') ?>">Accueil</a></div>
          <div class="menu"><a href="<?php echo url_for('asso/index') ?>">Associations</a></div>
          <div class="menu"><a href="<?php echo url_for('article/index') ?>">Articles</a></div>
          <div class="menu"><a href="<?php echo url_for('event/calendar') ?>">Événements</a></div>
        </div>
      </div>
      <div id="column-left">
	<p>Colonne Gauche</p>
      </div>
      <div id="column-right">
	<p>Colonne Droite</p>
      </div>      
      <div id="content">
        <?php echo $sf_content ?>
      </div>
    </div>
    <div id="footer"> <center> Copyright SiMDE 2011 - Ce projet est une création d'étudiant UTCéen. </center> </div>
  </body>
</html>
