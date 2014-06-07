<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>
<div class="part">
  <h1>Les Partenaires du BDE-UTC</h1>
    <?php foreach ($partenaires as $partenaire): ?>
        <div class="media">
          <a class="pull-left" href="<?php echo $partenaire->getUrl() ?>">
            <?php echo showThumb($partenaire->getLogo(), 'partenaires', array('width' => 85, 'height' => 85, 'class' => 'media-object'), 'center') ?>
          </a>
          <div class="media-body">
            <h4 class="media-heading">
              <a href="<?php echo $partenaire->getUrl() ?>">
                <?php echo $partenaire->getNom() ?>
              </a>
            </h4>
            <?php echo $partenaire->getDescription() ?>
          </div>
        </div>
    <?php endforeach ?>
  <h1>Le Carnet Avantage 2.0</h1>
    <div class="row-fluid">
      <ul class="thumbnails">
        <?php foreach ($carnetAvantages as $carnetAvantage): ?>
          <li class="span4">
            <div class="thumbnail list">
              <div class="media">
                <a class="pull-left" href="#">
                  <?php echo showThumb($carnetAvantage->getLogo(), 'carnetavantages', array('width' => 32, 'height' => 32, 'class' => 'media-object'), 'center') ?>
                </a>
                <h3 class="media-heading"><?php echo $carnetAvantage->getNom() ?></h3>
             </div>
              <p><?php echo $carnetAvantage->getDescription() ?></p>
              <?php if($carnetAvantage->getAdresse()): ?>
                <i class="fa fa-home"></i> <?php echo $carnetAvantage->getAdresse() ?><br />
              <?php endif ?>
              <?php if($carnetAvantage->getTel()): ?>
                <i class="fa fa-phone"></i> <?php echo $carnetAvantage->getTel() ?>
              <?php endif ?>
            </div>
          </li>
      <?php endforeach ?>
    </ul>
  </div>
</div>
<script type="text/javascript">
function equalHeight(group) {    
    tallest = 0;    
    group.each(function() {       
        thisHeight = $(this).height();       
        if(thisHeight > tallest) {          
            tallest = thisHeight;       
        }    
    });    
    group.each(function() { $(this).height(tallest); });
} 

$(document).ready(function() {   
    equalHeight($(".thumbnail.list")); 
});
</script>
