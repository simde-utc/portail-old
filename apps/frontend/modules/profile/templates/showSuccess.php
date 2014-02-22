<h1 class="partie">Mon profil</h1>
<div class="part" id="profile">
  <h2>
    Identité
    <?php if($sf_user->getGuardUser()->getId() == $user->getId()) : ?>
      <a class="btn pull-right editIdentite"
         data-url="<?php echo url_for('profile_identite_edit', array('id' => $profile->getId())) ?>">
        <i class="icon-pencil"></i>
      </a>
    <?php endif ?>
  </h2>
  <img id="trombi" style="float: left;"
       src="https://demeter.utc.fr/pls/portal30/portal30.get_photo_utilisateur?username=<?php echo $sf_user->getGuardUser()->getUsername() ?>">

  <div class="row">
    <?php if ($profile->getDomain() == "etu"): ?>
      <div class="span4"
           style="background-image: url('/images/tampon_utc.png'); background-repeat:no-repeat; background-position: right -11px;"/>
    <?php elseif ($profile->getDomain() == "escom"): ?>
      <div class="span4"
           style="background-image: url('/images/tampon_escom.png'); background-repeat:no-repeat; background-position: right -4px;"/>
    <?php else: ?>
      <div class="span4"
           style="background-image: url('/images/tampon_ext.png'); background-repeat:no-repeat; background-position: right -10px;"/>
    <?php endif; ?>

    <b>Nom</b> : <?php echo $user->getLastName() ?><br>
    <b>Prénom</b> : <?php echo $user->getFirstName() ?><br><br>
    <b>Login</b> : <?php echo $user->getUsername() ?><br><br>

    <div id="identite">
      <?php $birthday = explode("-", $profile->getBirthday());
      if (count($birthday) == 3): ?>
        <b>Date de Naissance</b> : <?php echo $birthday[2] . '/' . $birthday[1] . '/' . $birthday[0] ?><br>
      <?php endif; ?>
    </div>
    <div id="identite-form">
    </div>
  </div>
  <div class="span2">
    <?php if ($profile->getBranche()): ?>
      <div id='semestre'>
        <b>Branche</b> : <?php echo $profile->getBranche() ?><br>
      </div>
    <?php endif ?>
    <?php if ($profile->getFiliere()): ?>
      <div id='filiere'>
        <b>Filière</b> : <?php echo $profile->getFiliere() ?><br>
      </div>
    <?php endif ?>
    <?php if ($profile->getSexe() == "M"): ?>
      <img src="/images/male.png" title="Sexe" alt="Homme"/>
    <?php elseif ($profile->getSexe() == "F"): ?>
      <img src="/images/female.png" title="Sexe" alt="Femme"/>
    <?php endif ?>
  </div>
</div>
<h2>
  Informations personnelles
  <?php if($sf_user->getGuardUser()->getId() == $user->getId()) : ?>
    <a class="btn pull-right editInfoPerso"
     data-url="<?php echo url_for('profile_infoPerso_edit', array('id' => $profile->getId())) ?>">
      <i class="icon-pencil"></i>
    </a>
  <?php endif; ?>
</h2>
<div id="infoPerso">
  <?php
  $i = 0;
  //infos persos
  if ($profile->getMobile() != "") {
    $i++;
    echo "<div class='row'><div class='span2'><b>Portable</b> : </div>
    <div class='span6'>" . $profile->getMobile() . '<br></div></div>';
  }
  if ($profile->getHomePlace() && (
       $profile->getHomePlace()->getStreet() != ""
    || $profile->getHomePlace()->getZipCode() != ""
    || $profile->getHomePlace()->getCity() != ""
    || $profile->getHomePlace()->getCountry() != ""
  )) {
    $i++;
    echo "<div class='row'><div class='span2'><b>Adresse Etu</b> : </div>
    <div class='span6'>" . $profile->getHomePlace()->getStreet() . '<br>
    ' . $profile->getHomePlace()->getZipCode() . ' ' . $profile->getHomePlace()->getCity() . '<br>
    ' . $profile->getHomePlace()->getCountry() . '<br></div></div>';
  }

  if ($profile->getFamilyPlace() && (
      $profile->getFamilyPlace()->getStreet() != ""
    || $profile->getFamilyPlace()->getZipCode() != ""
    || $profile->getFamilyPlace()->getCity() != ""
    || $profile->getFamilyPlace()->getCountry() != ""
  )) {
    $i++;
    echo "<div class='row'><div class='span2'><b>Autre Adresse</b> : </div>
    <div class='span6'>" . $profile->getFamilyPlace()->getStreet() . '<br>
    ' . $profile->getFamilyPlace()->getZipCode() . ' ' . $profile->getFamilyPlace()->getCity() . '<br>
    ' . $profile->getFamilyPlace()->getCountry() . '</div></div>';
  }

  if ($i == 0) {
    echo "<div class='row' style='text-align:center;'><i>Pas d'informations disponibles. </i></div>";
  }

  ?>
</div>
<div id="infoPerso-form">
</div>
<h2>
  Informations supplémentaires
  <?php if($sf_user->getGuardUser()->getId() == $user->getId()) : ?>
    <a class="btn pull-right editInfoSupp"
       data-url="<?php echo url_for('profile_infoSupp_edit', array('id' => $profile->getId())) ?>">
      <i class="icon-pencil"></i>
    </a>
  <?php endif ; ?>
</h2>
<div id="infoSupp">
  <?php
  //infos supp
  $i = 0;
  if ($profile->getDevise()) {
    $i++;
    echo "<div class='row'><div class='span1'><b>Devise</b> : </div>
    <div class='span7'>" . $profile->getDevise() . '<br></div></div>';
  }
  if ($profile->getNickname()) {
    $i++;
    echo "<div class='row'><div class='span1'><b>Surnom</b> : </div>
    <div class='span7'>" . $profile->getNickname() . '<br></div></div>';
  }
  if ($i == 0) {
    echo "<div class='row' style='text-align:center;'><i>Pas d'informations disponibles. </i></div>";
  }
  ?>
</div>
<div id="infoSupp-form">
</div>
<?php /*
<h2>
  Parcours UTC
</h2>
<div id="parcoursUTC">
  <?php if (count($semestres) > 0): ?>
    <?php foreach ($semestres as $semestre): ?>
      <?php if ($semestre): ?>
        <div class='row'>
          <div class='span1'>
            <b><?php echo $semestre->getBranche() . ' 0' . $semestre->getNum() ?></b> :
          </div>
        <?php if ($semestre->getAbroad()): ?>
          <div class='span7'><?php echo $semestre->getAbroad() ?></div>
        <?php else: ?>
          <?php foreach ($semestre->getUserUv() as $uv) : ?>
            <div class='span1'>
             <?php echo $uv->getUv()->getCode() ?>
              <?php if ($uv->getNote()): ?>
              (<?php echo $uv->getNote() ?>)
              <?php endif ?>
            </div>
          <?php endforeach; ?>
        <?php endif ?>
        </div>
      <?php endif ?>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="row" style="text-align:center;">
      <i>Pas d'historique des UVs disponible. </i>
    </div>
  <?php endif ?>
</div>
*/ ?>
<h2>Parcours Asso</h2>
<?php if (count($user->getAssoMember()) > 0): ?>
  <?php foreach ($user->getAssoMember() as $assoMember) : ?>
    <div class='row'>
      <div class='span1'>
        <b><?php echo $assoMember->getSemestre()->getName() ?></b> :
      </div>
      <div class="span7">
        <?php echo $assoMember->getAsso()->getName() ?>
        (<?php echo $assoMember->getRole()->getName() ?>)
      </div>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <div class="row" style="text-align:center;">
    <i>Pas d'activités associatives enregistrées.</i>
  </div>
<?php endif ?>
</div>
