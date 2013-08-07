<?php use_stylesheet("../gallerynePlugin/slideshow/skitter/css/skitter.styles.css") ?>
<?php use_javascript("../gallerynePlugin/slideshow/skitter/js/jquery.skitter.min.js");?>

<?php
$correctPath = GalleryneUtils::gallery_path();
?>

<div class="box_skitter box_skitter_large" id="slider_skitter_<?php echo $gallery->getSlug()?>">
    <ul>
        <?php foreach ($gallery->getPhotos() as $photo) { ?>
            <li>
                <a class="block" name="<?php echo $photo->getTitle() ?>"  rel="gallery" class="fancybox-gallery"  href="<?php echo $photo->getFullPath(true) ?>" title="<?php echo $photo->getTitle() ?>">
                    <img src="<?php echo $photo->getFullPath(true,sfConfig::get('app_gallerynePlugin_skitter_size')) ?>" alt="<?php echo $photo->getTitle() ?>" />
                </a>
                <div class="label_text">
                    <p>Texte : <?php echo $photo->getTitle() ?></p>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>


<?php 
/* expect 
 * animation : 
 *  cube
 *  cubeRandom
 *  block
 *  cubeStop
 *  cubeHide
 *  cubeSize
 *  horizontal
 *  showBars
 *  showBarsRandom
 *  tube
 *  fade
 *  fadeFourparalell
 *  blind
 *  blindHeight
 *  blindWidth
 *  directionTop
 *  directionBottom
 *  directionRight
 *  directionLeft
 *  cubeStopRandom
 *  cubeSpread
 *  cubeJelly
 *  glassCube
 *  glassBlock
 *  circlesnew
 *  circlesInsidenew 
 *  circlesRotatenew
 *  random
 *  randomSmart
 * 
 */ 

?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#slider_skitter_<?php echo $gallery->getSlug() ?>').skitter(
        {
            velocity: 1,
            interval: <?php echo $interval ?>,
            animation: '<?php echo $animation ?>',
            numbers: <?php echo $hasNumber ?>,
            navigation: <?php echo $isNavigable ?>,
            label:  <?php echo $hasLabel ?>,
            hideTools: <?php echo $hideTools ?>,
            thumbs: <?php echo $hasThumbs ?>,
            fullscreen: <?php echo $isFullscreen ?>
        }
    );
    });


</script>