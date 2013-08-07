<?php 
if($sf_data->getRaw("gallery") instanceof Gallery && count($gallery->getPhotos())){
    foreach ($slideshowOptions as $name=>$option) {
        $options[$name] = $option;    
    }
    $options["gallery"] = $gallery;
    include_partial("slideshow/".$slideshowOptions['template'], $options) ; 
}else{ ?>
    <?php echo __("backend.gallery.nophotos", array(), "galleryne") ?>
<?php } ?>