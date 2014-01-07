<?php use_helper('Thumb') ?>

<!-- FOr the facebook like button on the sidebar-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=238586716159701";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<table>
  <tbody>
    <tr>
      <th>Evènement:</th>
      <td><?php echo $galerie_photo->getEvent()?></td>
    </tr>
    <tr>
      <th>Titre:</th>
      <td><?php echo $galerie_photo->getTitle() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $galerie_photo->getDescription() ?></td>
    </tr>
  </tbody>
</table>

<?php if($sf_user->isAuthenticated()
   && $sf_user->getGuardUser()->hasAccess($galerie_photo->getEvent()->getAsso()->getLogin(), 0x200)): ?>
  <a class="btn btn-primary" href="<?php echo url_for('galerie/edit?id='.$galerie_photo->getId()) ?>">Editer la galerie</a>
&nbsp;
  <a class="btn btn-primary" href="<?php echo url_for('photo/new?id='.$galerie_photo->getId()) ?>">Ajouter des photos</a>
<?php endif ?>

<hr />


<div class="row-fluid galery-photo-list">
  <ul class="thumbnails thumbfix">
    <?php foreach ($photos as $index=>$photo): ?>
        <li class="span3 thumb-container">
          <a
          class="thumbnail"
          onclick="slideTo(<?php echo $index ?>); return false;"
          title="<?php echo $photo->getTitle(); ?>"
          data-pass="<?php echo $photo->getPass(); ?>"
          href="<?php
                echo doThumb($photo->getImage(), 'galeries', array(
                'width' => 1600,
                'height' => 900
              ), 'scale'); 
          ?>">
            <?php echo showThumb($photo->getImage(), 'galeries', array(
            'width' => 250,
            'height' => 250,
            'class' => 'galery-thumbnail',
            'alt' => $photo->getTitle(),
            'title' => $photo->getTitle()
            ), 
            'center') ?> 
          </a>
        </li>   
    <?php endforeach;?>
  </ul>
</div>

<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls blueimp-gallery-fullscreen">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <div class="social-sidebar"></div>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>


<?php use_javascript('galery_photo_list.js'); ?>
<?php use_javascript('blueimp/jquery.blueimp-gallery.min.js'); ?>
<?php use_javascript('blueimp/blueimp-gallery-fullscreen.js'); ?>
<?php use_stylesheet('blueimp/blueimp-gallery.min.css');?>
<?php use_stylesheet('galerie_photo_list.css');?>
