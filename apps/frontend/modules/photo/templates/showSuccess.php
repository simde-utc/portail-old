<!-- FOr the facebook like button on the sidebar-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=238586716159701";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Custom js and css for fullscreen photo view-->
<?php use_javascript('fullscreen-photo-viewer');?>
<?php use_stylesheet('fullscreen-photo-viewer');?>

<!-- The main div, maximized when you go fullscreen-->
<div class="photo_viewer">
  
  <!-- The actual image-->
  <div class="main-image">
  <?php echo showThumb($photo->getImage(), 'galeries', array(
        'width' => 1600,
        'height' => 900
        ,'onclick' => '$(".nextpict")[0].click();'
      ), 'scale') ?>
  </div>

  <!-- Sidebar for the photos info-->
  <div class="photo_meta_infos">

    <!-- Galery title and link-->
    <div class="photo-meta-galerie">
      <a class="photo-galery-link" href="<?php echo url_for('galerie/show?id='.$photo->getGaleriePhoto()->getId()) ?>">
      <h4><?php echo $galerie ?></h4>
      </a>
    </div>

    <!-- Photo author-->
    <div class="photo-meta-author">
      Par <?php echo $author; ?>
    </div>

    <!-- Photo title -->
    <div class="photo-meta-title">
      <?php echo $photo->getTitle() ?>
    </div>

    <!-- Previous and Next Photo button (not always displayed) -->
    <?php foreach ($nextPict as $Button): ?>
       <div class="photo-next">
        Suivant :
        <a class="photo-samegalery nextpict"  href="<?php echo url_for('photo/show?id='.$Button->getId()) ?>">
          <?php echo showThumb($Button->getImage(), 'galeries', array(
          'width' => 80,
          'height' => 80), 
          'center') ?> 
        </a>
    </div>
    <?php endforeach; ?>
       <?php foreach ($prevPict as $Button): ?>
        <div class="photo-next">
        Precedent :
        <a class="photo-samegalery prevpict" href="<?php echo url_for('photo/show?id='.$Button->getId())  ?>">
          <?php echo showThumb($Button->getImage(), 'galeries', array(
          'width' => 80,
          'height' => 80), 
          'center') ?> 
        </a>
    </div>
    <?php endforeach; ?>

    <!-- Edit button -->
    <div>
      <a class="photo-edit-button btn btn-primary" href="<?php echo url_for('photo/edit?id='.$photo->getId()) ?>">Editer</a>
    </div>
    <!-- Like button -->
    <div class="photo-like-button">
      <div class="fb-like" data-href="http://assos.utc.fr/photo/show/<?php
      echo $photo->getId() . "?pass=" . $passCode;
       ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
    </div>
  </div>
</div>