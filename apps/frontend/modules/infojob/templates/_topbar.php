<!-- Menu du haut commun au service infojob TODO, voir exemple dans apps/frontend/modules/assos/templates/_topbar.php -->
<div class="well">
<div class="row-fluid">
  <div class="<?php if($sf_user->isAuthenticated()) { echo 'span4'; } else { echo 'span6'; } ?>" style="height:150px;">
  	<h1><center>Etudiants</center>
  	</h1>
  	<center><span>
  	<img src="/images/icones/job.png" style="witdh:90px; height:70px">
  	</span>
  	</center>
  	
  	 <br/>
  	<center><a class="btn-job" href="<?php echo url_for('infojob/offres') ?>">Voir les offres</a></center>
  </div>
  
  <div class="<?php if($sf_user->isAuthenticated()) { echo 'span4'; } else { echo 'span6'; } ?>" style="height:100px">
  <h1><center>Entreprise et particuliers</center></h1>
 	<center><span>
 
 	 <img src="/images/icones/entreprise.jpg" style="line-height:normal;witdh:90px; height:70px">
  	</span>
  	</center>
  	  <br/>
  	
  	 	<center><a class="btn-offres" href="<?php echo url_for('infojob/new') ?>">Déposer une offre</a></center>
  </div>
  
  <?php if($sf_user->isAuthenticated()): ?>
    <div class="span4" style="height:100px">
    	<h1><center>Etudiants</center></h1>
	   <center>
      <span>
        <img src="/images/icones/etudiant.jpg" style="witdh:90px; height:70px">
	    </span>
	   </center>
	   <br/>
	   <center>
      <a class="btn-comptes" href="<?php echo url_for('infojob/monprofil') ?>">Gérer mon compte</a>
     </center>
    </div>
  <?php endif; ?>
</div>
</div>
