<script type="text/javascript">


$(document).ready(function() {
	var i=0;
	//stocker annonces

$("#checkbox-1a").change(function() {
	if(i==0) {alert("box is checked");
			  //faire un filtre sur le label
			  //reafficher annonces
			  $("#listesAnnonces").empty().append('<li>Box is checked</li>');
			  i=1;}
			  
		else{alert("box unchecked") ;
			   $("#listesAnnonces").empty().append('<li>Box is unchecked</li>');
			   	//récuperer toutes les box qui sont checked
			   	//reafficher annonces
			   	
			 i=0;}
		
});
	


});

</script>

<div class="part" >

  <?php include_partial('infojob/topbar') ?>

      <div class="well"  style=" width:770px;height:100px;">
      	<h1>Rechercher une offre</h1>
    		<div class="row-fluid">  
    			<div class="span6">
   					 <form method="post">
        			 <fieldset>
                		<h3>Catégories</h3>
                
        			</fieldset>
       
       			 </div>
       			 
        		<div class="span6">
        
				</div>
        	</div>
      </div>
  
    <?php foreach($annonces as $annonce): ?>
    <div class="well">
      <?php if($sf_user->isAuthenticated() && $annonce->getUserId() == $sf_user->getGuardUser()->getId()): ?>
        <a href="<?php echo url_for('annonce/edit?id=' . $annonce->getEmailkey()) ?>"  style="float:left;margin-top:12px; margin-right: 5px;"><i class="icon-pencil"></i></a>
      <?php endif ?>
      <h2><?php echo $annonce->getTitre() ?></h2>
      <p><?php echo $annonce->getTexte() ?></p>
      <p>
        <?php if($annonce->getRemuneration() != '0.00'): ?>Prix : <?php echo $annonce->getRemuneration() ?>€<br /><?php endif ?>
        <?php if($annonce->getLieu()): ?>Lieu : <?php echo $annonce->getLieu() ?><br /><?php endif ?>
      </p>
      <p style="font-style: italic;">
        Posté le <?php echo $annonce->getCreatedAt() ?>
        <?php if($sf_user->isAuthenticated()): ?>
          par : <?php if($annonce->getUserId() != NULL): ?>
            <a href="mailto:<?php echo $annonce->getUser()->getEmailAddress() ?>"><?php echo $annonce->getUser()->getName(); ?></a>
            <?php
          else: echo $annonce->getEmail();
          endif;
          ?>
        <?php endif; ?>
      </p>
     <a  class="btn-jaune" href="<?php echo url_for('infojob/show?id=' . $annonce->getId()) ?>">Voir la fiche</a>
     
    </div>
  <?php endforeach; ?>
    

</div>
 		
