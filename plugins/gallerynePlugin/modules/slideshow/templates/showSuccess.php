<?php 
foreach ($slideshowOptions as $name=>$option) {
    $options[$name] = $option;    
}
$options["gallery"] = $gallery;
include_partial("anything", $options) ; ?>