<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>
<div class="part">
  <h1>Les Partenaires du BDE UTC</h1>
  <ul id="partenaires_list">
    <?php foreach ($partenaires as $partenaire): ?>
      <li>
        <a href="<?php echo $partenaire->getUrl() ?>" style="float:left;">
            <?php echo showThumb($partenaire->getLogo(), 'partenaires', array('width' => 85, 'height' => 85, 'class' => 'logo'), 'center') ?>
          </a>
          <a href="<?php echo $partenaire->getUrl() ?>">
            <h3><?php echo $partenaire->getNom() ?></h3>
          </a>
          <div class="desc">
            <?php echo $partenaire->getDescription() ?>
            <br />
          </div>
      </li>
    <?php endforeach ?>
  </ul>
  <h1>Le Carnet Avantage 2.0</h1>
  <ul id="carnetAvantages_list">
    <?php foreach ($carnetAvantages as $carnetAvantage): ?>
        <li>
            <h3><?php echo $carnetAvantage->getNom() ?></h3>
          <div class="desc">
            <?php echo $carnetAvantage->getDescription() ?>
            <br />
          </div>
          <div class="adresse">
            Adresse: <?php echo $carnetAvantage->getAdresse() ?>
            <br />
          </div>
          <div class="tel">
            <p> Tel: <?php echo $carnetAvantage->getTel() ?></p>
          </div>
        </li>
    <?php endforeach ?>
  </ul>
</div>
