<?php use_helper('Date') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php use_javascript('jquery-1.7.2.min.js') ?> <!-- à laisser ? -->
    <?php include_javascripts() ?>   
  </head>
  <body>
<!-- SUPERTAG CODE ASYNC v2.9.8.6 -->
<script type="text/javascript">
(function(s,d,src) {
    var st = d.createElement(s); st.type = 'text/javascript';st.async = true;st.src = src;
    var sc = d.getElementsByTagName(s)[0]; sc.parentNode.insertBefore(st, sc);
})('script', document, '//c.supert.ag/p/0002be/supertag-async.js');
</script>
    <div class="navbar navbar-inverse navbar-static-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="<?php echo url_for('homepage') ?>" title="Accueil"><img src="/images/logo_bde.png" alt="BDE UTC" /></a>
                <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                        <li><a href="https://assos.utc.fr/bde/bdecotiz/">Cotiser en ligne</a></li>
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
                                <li><a href="<?php echo url_for('profile/show?username=' . $sf_user->getGuardUser()->getUsername()) ?>">Mon Profil</a></li>
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
              <a href="<?php echo url_for('asso/index') ?>" class="lienlisteassos">Associations</a>
              <a href="<?php echo url_for('agenda_detail') ?>" class="lienlistereservation" > Calendrier</a> <!-- à changer url-for-->
              <a href="<?php echo url_for('infojob_home') ?>">InfoJob</a>              
              <a href="<?php echo url_for('services')?>">Services</a>
              <a href="<?php echo url_for('partenaires')?>">Partenaires</a>
              <a href="/wiki">Wiki des Assos</a>
            </div>
          </div>
        </div>
        

        <?php include_component('asso', 'bigMenu') ?>
        <?php include_component('reservation', 'calendarMenu') ?>


        
        <?php if($sf_request->getParameter('module') == 'home'): ?>
          <?php include_component('event', 'carousel') ?>
        <?php elseif($sf_request->getParameter('login') || $sf_request->getParameter('asso')): ?>
          <?php include_component('asso', 'menu') ?>
        <?php endif ?>    
        <div class="row">
          <div class="span3" id="column-left">
            <?php if($sf_user->isAuthenticated()): ?>
              <?php include_component('asso', 'myAssos') ?>
              <?php include_component('services', 'myServicesFavoris') ?>
              <?php include_component('abonnement', 'myFlux') ?>
              <?php include_component('asso', 'myPreviousAssos') ?>
            <?php else: ?>
              <?php include_partial('home/bienvenue') ?>
            <?php endif ?>
          </div>
          <div class="span9">
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
    <div id="footer" class="row">
      <div class="span4 offset2" id="splash">
        <div>
          <img src="/images/splash_footer.png">
        </div>
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
<?php if(sfConfig::get('app_portail_piwik_is_enable', false)): ?>
<!-- Piwik -->
<script type="text/javascript"> 
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://<?php echo sfConfig::get('app_portail_piwik_address') ?>//";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', <?php echo sfConfig::get('app_portail_piwik_site_id') ?>]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
    g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="http://<?php echo sfConfig::get('app_portail_piwik_address') ?>/piwik.php?idsite=<?php echo sfConfig::get('app_portail_piwik_site_id') ?>" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Code -->
<?php endif ?>
  </body>
</html>
