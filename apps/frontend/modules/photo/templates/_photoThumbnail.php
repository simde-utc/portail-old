<?php 
use_helper('Thumb');
echo showThumb(
  $photo->getImage(),
  'galeries',
  array(
    'width' => sfConfig::get('app_portail_photos_thumb_res_x'),
    'height' => sfConfig::get('app_portail_photos_thumb_res_y'),
    'class' => 'galery-thumbnail',
    'alt' => $photo->getTitle(),
    'title' => $photo->getTitle()), 
  'center');
