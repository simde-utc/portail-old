<?php 
use_helper('Thumb');
echo showThumb(
  $photo->getImage(),
  'galeries',
  array(
    'width' => 250,
    'height' => 250,
    'class' => 'galery-thumbnail',
    'alt' => $photo->getTitle(),
    'title' => $photo->getTitle()), 
  'center');
