

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>

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
<div class="container-fluid">
   <div class="row-fluid"style="margin-right:3%;">
      <div class="span3"style=" height:500px;">
     
        	<div data-role="collapsible" data-mini="true" data-content-theme="c">
  							 <h3>Emploi</h3>
  							 <div  data-role="fieldcontain" data-count-theme="c" >
                				<fieldset data-role="controlgroup" data-count-theme="c" style="width:200px;" data-mini="true">
                   			
                   				 <input type="checkbox" name="checkbox-1a" id="checkbox-1a"  class="custom" />
                   				 
                   				 <label for="checkbox-1a">
                   				 Vente
                   				 
                   				 </label>
                   				
                   				
                   				 

                  			   <input type="checkbox" name="checkbox-2a" data-bind="checked: myValue, click: myAction"  id="checkbox-2a" class="custom" />
                    		  <label for="checkbox-2a">Cours particuliers</label>

                    		 <input type="checkbox" name="checkbox-3a" id="checkbox-3a" class="custom" />
                    		<label for="checkbox-3a">Babysitting</label>

                   			 <input type="checkbox" name="checkbox-4a" id="checkbox-4a" class="custom" />
                   			 <label for="checkbox-4a">Aide scolaire</label>
                			</fieldset>
            			</div>
			</div>
				<div data-role="collapsible"  data-mini="true"data-content-theme="c">
  							 <h3>Disponibilités</h3>
   							<div  data-role="fieldcontain" style="width:210px;">
                				<fieldset data-role="controlgroup" style="width:200px;"data-mini="true">
                   
                   				 <input type="checkbox" name="checkbox-1a" id="checkbox-1a" class="custom" />
                   				 <label for="checkbox-1a">Soir</label>

                  			   <input type="checkbox" name="checkbox-2a" id="checkbox-2a" class="custom" />
                    		  <label for="checkbox-2a">Weekend</label>

                    		 <input type="checkbox" name="checkbox-3a" id="checkbox-3a" class="custom" />
                    		<label for="checkbox-3a">Jour Fériés</label>

                   			 <input type="checkbox" name="checkbox-4a" id="checkbox-4a" class="custom" />
                   			 <label for="checkbox-4a">Ete</label>
                			</fieldset>
            			</div>
    			</div>
    			
      </div>
      <div class="span8" style="height:600px;">
		<div data-role="collapsible"  date-mini="true"data-collapsed="false" data-theme="a" data-content-theme="c">
    		<h4>Post récemment ajoutés</h4>
    			<ul data-role="listview" id="listesAnnonces">
    			<?php foreach($annonces as $annonce): ?>
    			//faire un switch sur l'annonce catégorie pour l'icone 
 					<li data-icon="arrow-r">
 					
 					<span class=""></span>
 					
 					<a href="<?php echo url_for('infojob/show?id='.$annonce->getId()) ?>">
     				 <?php echo $annonce->getTitre() ?>	
      				<p>
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
      					</a></li>
    	
 					 <?php endforeach; ?>
					
					
				</ul>
     </div>
     </div>
   </div>
    

</div>
 		