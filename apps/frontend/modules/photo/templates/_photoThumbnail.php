<?php use_helper('Thumb') ?>
<li class="span3 thumb-container">
  <a class="thumbnail "  href="<?php echo url_for('photo/show?id='.$photo->getId()) ?>">
    <?php echo showThumb($photo->getImage(), 'galeries', array(
    'width' => 250,
    'height' => 250,
    'class' => 'cute-small-pict'
    ), 
    'center') ?> 
  </a>
  <a href="<?php echo url_for('photo/show?id='.$photo->getId()) ?>">
    <?php echo showThumb($photo->getImage(), 'galeries', array(
    'width' => 1000,
    'height' => 1000,
    'class' => 'big-ass-pict',
    'style '=> 'display:none;', 
    ),'center'); ?> 
  </a>
</li>   