<?php use_helper('Thumb') ?>
<h1>Editer une photo</h1>

<div class = "row-fluid">
  <div class="span12">
    <div class="media">
      <div class="pull-left">
        <?php echo showThumb($photo->getImage(), 'galeries', array(
          'width' => 80,
          'height' => 80), 
          'center') 
        ?>
      </div>
      <div class="media-body">
       <?php include_partial('formEdit', array('form' => $form)) ?>
      </div>
    </div>
  </div>
</div>


