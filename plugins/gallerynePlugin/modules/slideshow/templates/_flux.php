<?php use_javascript("../gallerynePlugin/slideshow/flux/js/flux.js"); ?>
<?php use_stylesheet("../gallerynePlugin/slideshow/flux/css/flux.css"); ?>

<div id="slider_flux_<?php echo $gallery->getSlug() ?>">
        <?php foreach ($gallery->getPhotos() as $photo) { ?>
                <a name="<?php echo $photo->getTitle() ?>"  rel="gallery" class="fancybox-gallery"  href="<?php echo $photo->getFullPath(true) ?>" title="<?php echo $photo->getTitle() ?>">
                    <img src="<?php echo $photo->getFullPath(true, sfConfig::get('app_gallerynePlugin_skitter_size')) ?>" height="350" width="800" alt="<?php echo $photo->getTitle() ?>" />
                </a>
        <?php } ?>
</div>


<script src="" type="text/javascript" charset="utf-8"></script> 
<script type="text/javascript" charset="utf-8"> 
    $(document).ready(function(){
        if(!flux.browser.supportsTransitions)
            alert("Flux Slider requires a browser that supports CSS3 transitions");
					
        window.f = new flux.slider('#slider_flux_<?php echo $gallery->getSlug() ?>', {
            pagination: <?php echo $isNavigable ?>,
            autoplay: true
        });
    });
</script>