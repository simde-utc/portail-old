<div class="part" id="profile">
    <?php $profile = $sf_user->getGuardUser()->getProfile();  ?>
        <script type="text/javascript">
            function editIdentite(){
                $.get('/frontend_dev.php/profile/identite/edit/<?php echo $profile->getId() ?>', function(data) {
                    $('#dateNaissance').html(data);
                });
            };
            
            function editInfoPerso(){
                $.get('/frontend_dev.php/profile/infoPerso/edit/<?php echo $profile->getId() ?>', function(data) {
                    $('#infoPerso').html(data);
                });
            };
            
            function editInfoSupp(){
                $.get('/frontend_dev.php/profile/infoSupp/edit/<?php echo $profile->getId() ?>', function(data) {
                    $('#infoSupp').html(data);
                });
            };
            
            function editParcoursUTC(){
                $.get('/frontend_dev.php/profile/parcoursUTC/edit/<?php echo $profile->getId() ?>', function(data) {
                    $('#parcoursUTC').html(data);
                });
            };
        </script>
	<h1>Mon Profil</h1>
	
	<h2><a href="#" onclick="editIdentite();">Identité</a></h2>
  <?php 
	
	
	//identité
        echo '<img id="trombi" style="float: left;" src="https://demeter.utc.fr/pls/portal30/portal30.get_photo_utilisateur?username='.$sf_user->getGuardUser()->getUsername().'">'
   ?>
        <div class="row">
            <div class="span4" style="background-image: url('/images/tampon2.png'); background-repeat:no-repeat; background-position: right -10px;">
    <?php
            echo "<b>Nom</b> : ".$sf_user->getGuardUser()->getLastName().'<br>';
            echo "<b>Prénom</b> : ".$sf_user->getGuardUser()->getFirstName().'<br><br>';
            echo "<b>Login</b> : ".$sf_user->getGuardUser()->getUsername().'<br><br>';
            $birthday = explode("-",$profile->getBirthday());
            echo "<div id='dateNaissance'> <b>Date de Naissance</b> : ".$birthday[2].'/'.$birthday[1].'/'.$birthday[0].'<br></div>';
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
  <h2><a href="#" onclick="editInfoPerso();">Informations personnelles</a></h2>
  <div id="infoPerso">
  <?php
	//infos persos
	echo "<div class='row'><div class='span2'><b>Portable</b> : </div><div class='span6'>".$profile->getMobile().'<br></div></div>';
	echo "<div class='row'><div class='span2'><b>Adresse Etu</b> : </div><div class='span6'>".$profile->getHomePlace()->getStreet().'<br>'.$profile->getHomePlace()->getZipCode().' '.$profile->getHomePlace()->getCity().'<br>'.$profile->getHomePlace()->getCountry().'<br></div></div>';
	echo "<div class='row'><div class='span2'><b>Autre Adresse</b> : </div><div class='span6'>".$profile->getFamilyPlace()->getStreet().'<br>'.$profile->getFamilyPlace()->getZipCode().' '.$profile->getFamilyPlace()->getCity().'<br>'.$profile->getFamilyPlace()->getCountry().'</div></div>';
	
  ?>
  </div>
  <h2><a href="#" onclick="editInfoSupp();">Informations supplémentaires</a></h2>  
  <div id="infoSupp">
  <?php
	//infos supp
        echo "<div class='row'><div class='span1'><b>Devise</b> : </div><div class='span7'>".$profile->getDevise().'<br></div></div>';
        echo "<div class='row'><div class='span1'><b>Surnom</b> : </div><div class='span7'>".$profile->getNickname().'<br></div></div>';
        echo "<div class='row'><div class='span1'><b>Sport(s)</b> : </div><div class='span7'>";
        foreach ($profile->getUserSport() as $sport) :
            echo $sport->getSport()->getName().'<br>';
	endforeach;
  ?>
      </div></div> 
  </div>
  <h2><a href="#" onclick="editParcoursUTC();">Parcours UTC</a></h2>
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