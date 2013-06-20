
<!-- Menu du haut commun au service infojob TODO, voir exemple dans apps/frontend/modules/assos/templates/_topbar.php -->


<div class="well">
  <div class="row-fluid" style="text-align:center;">
    <div class="span6">
    	<h1>Etudiants</h1>
    	<div><a href="<?php echo url_for('infojob/offres') ?>#infojob-annonces"><img src="/images/icones/job.jpg" style="witdh:90px; height:70px;"></a></div>
      <br/>
    	<div><a href="<?php echo url_for('infojob/offres') ?>#infojob-annonces" class="btn btn-success" style="color: #FFFFFF;">Voir les offres</a></div>
    </div>
    
    <div class="span6">
      <h1>Entreprise et particuliers</h1>
      <div><a href="<?php echo url_for('infojob/new') ?>"><img src="/images/icones/entreprise.jpg" style="line-height:normal;witdh:90px; height:70px;"></a></div>
	    <br/>
	   	<div><a href="<?php echo url_for('infojob/new') ?>" class="btn btn-warning" style="color: #FFFFFF;">Déposer une offre</a></div>
    </div>
  </div>
</div>



