<div class="part" id="profile">
    <?php $profile = $sf_user->getGuardUser()->getProfile();  ?>
        <script type="text/javascript">
            function editIdentite(){
                $.get('/frontend_dev.php/profile/identite/edit/<?php echo $profile->getId() ?>', function(data) {
                    $('#identite').hide();
                    $('#identite').html(data);
                    $('#identite').fadeIn(1000);
                });
            };
            
            function editInfoPerso(){
                $.get('/frontend_dev.php/profile/infoPerso/edit/<?php echo $profile->getId() ?>', function(data) {
                    $('#infoPerso').hide();
                    $('#infoPerso').html(data);
                    $('#infoPerso').fadeIn(1000);
                });
            };
            
            function editInfoSupp(){
                $.get('/frontend_dev.php/profile/infoSupp/edit', function(data) {
                    $('#infoPerso').hide();
                    $('#infoSupp').html(data);
                    $('#infoPerso').fadeIn(1000);
                });
            };
            
            function editParcoursUTC(){
                $.get('/frontend_dev.php/profile/parcoursUTC/edit/<?php echo $profile->getId() ?>', function(data) {
                    $('#infoPerso').hide();
                    $('#parcoursUTC').html(data);
                    $('#infoPerso').fadeIn(1000);
                });
            };
        </script>
	<h1>Mon Profil</h1>
	
	<h2><a href="#" class="modifier" onclick="editIdentite();return false;">Identité</a></h2>
  <?php 
	
	
	//identité
        echo '<img id="trombi" style="float: left;" src="https://demeter.utc.fr/pls/portal30/portal30.get_photo_utilisateur?username='.$sf_user->getGuardUser()->getUsername().'">'
   ?>
        <div class="row">
    <?php
            if ( !strcmp($profile->getDomain(), "utc")) {
            echo "<div class=\"span4\" style=\"background-image: url('/images/tampon_utc.png'); background-repeat:no-repeat; background-position: right -11px;\" /> ";
            } else if ( !strcmp($profile->getDomain(), "escom")) {
            echo "<div class=\"span4\" style=\"background-image: url('/images/tampon_escom.png'); background-repeat:no-repeat; background-position: right -4px;\" /> ";
            } else {
                echo "<div class=\"span4\" style=\"background-image: url('/images/tampon_ext.png'); background-repeat:no-repeat; background-position: right -10px;\" /> ";
            }

            echo "<b>Nom</b> : ".$sf_user->getGuardUser()->getLastName().'<br>';
            echo "<b>Prénom</b> : ".$sf_user->getGuardUser()->getFirstName().'<br><br>';
            echo "<b>Login</b> : ".$sf_user->getGuardUser()->getUsername().'<br><br>';
            $birthday = explode("-",$profile->getBirthday());
            echo "<div id='identite'>";
            if (count($birthday)==3)
                echo "<b>Date de Naissance</b> : ".$birthday[2].'/'.$birthday[1].'/'.$birthday[0].'<br>';
            echo "</div>";
    ?>
            </div>
            <div class="span2">
    <?php            
            echo "<b>Filière</b> : ".$profile->getFiliere().'<br>';
            if ($profile->getSexe()=="M") {
                    echo '<img src="/images/male.png" title="Sexe" alt="Homme"/>';
            }	else if ($profile->getSexe()=="F") {
                    echo '<img src="/images/female.png" title="Sexe" alt="Femme"/>';
            }
    ?>
            </div>
        </div>
  <h2><a href="#" onclick="editInfoPerso();return false;" title="Editer">Informations personnelles</a></h2>
  <div id="infoPerso">
  <?php
	//infos persos
	echo "<div class='row'><div class='span2'><b>Portable</b> : </div><div class='span6'>".$profile->getMobile().'<br></div></div>';
	echo "<div class='row'><div class='span2'><b>Adresse Etu</b> : </div><div class='span6'>".$profile->getHomePlace()->getStreet().'<br>'.$profile->getHomePlace()->getZipCode().' '.$profile->getHomePlace()->getCity().'<br>'.$profile->getHomePlace()->getCountry().'<br></div></div>';
	echo "<div class='row'><div class='span2'><b>Autre Adresse</b> : </div><div class='span6'>".$profile->getFamilyPlace()->getStreet().'<br>'.$profile->getFamilyPlace()->getZipCode().' '.$profile->getFamilyPlace()->getCity().'<br>'.$profile->getFamilyPlace()->getCountry().'</div></div>';
	
  ?>
  </div>
  <h2><a href="#" onclick="editInfoSupp();return false;" title="Editer">Informations supplémentaires</a></h2>  
  <div id="infoSupp">
  <?php
	//infos supp
        echo "<div class='row'><div class='span1'><b>Devise</b> : </div><div class='span7'>".$profile->getDevise().'<br></div></div>';
        echo "<div class='row'><div class='span1'><b>Surnom</b> : </div><div class='span7'>".$profile->getNickname().'<br></div></div>';
        echo "<div class='row'><div class='span1'><b>Sport(s)</b> : </div><div class='span7'>";

        foreach ($profile->getUserSport() as $sp) :            
            echo $sp->getSport()->getName().'<br>';
  ?>
            <a href="<?php echo url_for('profile/editInfoSupp?id='.$sp->getId())?>">edit Sport</a> <br>
  <?php
	endforeach;
  ?>    
  
      </div></div> 
  </div>
  <h2><a href="#" onclick="editParcoursUTC();return false;" title="Editer">Parcours UTC</a></h2>
  <div id="parcoursUTC">
  <?php
	//parcours UTC
	foreach ($profile->getUserSemestre() as $semestre) : 
		echo "<div class='row'><div class='span1'><b>".$semestre->getBranche().' 0'.$semestre->getNum().'</b> : </div>';
                if ($semestre->getAbroad()) {
                  echo "<div class='span7'>".$semestre->getAbroad().'</div>';  
                } else {
                    foreach ($semestre->getUserUv() as $uv) :
                            echo "<div class='span1'>".$uv->getUv()->getCode();
                            if ($uv->getNote())
                                echo "(".$uv->getNote().')';
                            echo "</div>";
                    endforeach;
                }
		echo "</div>";
	endforeach;
  ?>
  </div>
      
  <h2>Parcours Asso</h2>
  <?php
	//parcours assos
	foreach ($sf_user->getGuardUser()->getAssoMember() as $assoMember) : 
		echo "<div class='row'><div class='span1'><b>".$assoMember->getSemestre()->getName().'</b> : </div><div class="span7">'.$assoMember->getAsso()->getName().' ('.$assoMember->getRole()->getName().')</div></div>';
	endforeach;
  ?>
	
  
</div>