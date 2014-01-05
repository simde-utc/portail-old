<?php use_helper('Thumb') ?>
<li class="span3">
  <a class="thumbnail"  href="<?php echo url_for('photo/show?id='.$photo->getId()) ?>">
    <?php echo showThumb($photo->getImage(), 'galeries', array(
    'width' => 250,
    'height' => 250), 
    'center') ?> 
  </a>
</li>   