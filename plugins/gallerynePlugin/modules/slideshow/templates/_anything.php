<?php use_helper("I18N") ?>
<?php use_stylesheet("../gallerynePlugin/slideshow/anything/css/anythingslider.css") ?>
<?php use_javascript("../gallerynePlugin/slideshow/anything/js/jquery.anythingslider.js");?>
<?php use_javascript("../gallerynePlugin/slideshow/anything/js/jquery.anythingslider.fx.js");?>
<?php use_javascript("../gallerynePlugin/slideshow/anything/js/jquery.easing.1.2.js");?>

    <?php $picture = getimagesize(sfConfig::get('sf_web_dir').$gallery->getPhotos()->getFirst()->getFullPath(true, sfConfig::get('app_gallerynePlugin_skitter_size'))); ?>    
                    
        <ul id="slider_anything_<?php echo $gallery->getSlug()?>" style="height:<?php echo $picture['1'];?>px;">
            <?php foreach ($gallery->getPhotos() as $photo) { ?>
            <?php $picture = getimagesize(sfConfig::get('sf_web_dir').$photo->getFullPath(true, sfConfig::get('app_gallerynePlugin_skitter_size'))); ?>    
               
            <li style="width:<?php echo $picture['0'];?>px;height:<?php echo $picture['1'];?>px;">
                <img src="<?php echo $photo->getFullPath(true, sfConfig::get('app_gallerynePlugin_skitter_size')) ?>" <?php echo $picture[3]; ?> alt="<?php echo $photo->getTitle() ?>" />
            </li>
                
            <?php } ?>

        </ul>

<style type="text/css">
    .anythingSlider span.arrow{
        margin: 50px -80px 0 0;
    }
    .anythingSlider span.arrow.forward{
        margin: 50px 0 0 -80px;
    }
</style>
<script type="text/javascript">
$('#slider_anything_<?php echo $gallery->getSlug()?>').anythingSlider({
    theme           : 'metallic',
    easing          : 'easeInOutCubic',
    resizeContents  : false, // If true, solitary images/objects in the panel will expand to fit the viewport    
//    width               : null,      // Override the default CSS width
//    height              : null,      // Override the default CSS height
				
    autoPlayLocked  : true,  // If true, user changing slides will not stop the slideshow
    resumeDelay     : 10000 // Resume slideshow after user interaction, only if autoplayLocked is true (in milliseconds).
});
//$('#slider2').anythingSlider({
//				width               : 600,       // if resizeContent is false, this is the default width if panel size is not defined
//				height              : 350,       // if resizeContent is false, this is the default height if panel size is not defined
//				resizeContents      : false,     // If true, solitary images/objects in the panel will expand to fit the viewport
//				autoPlay            : false     // This turns off the entire slideshow FUNCTIONALY, not just if it starts running or not
//
//			})

</script>