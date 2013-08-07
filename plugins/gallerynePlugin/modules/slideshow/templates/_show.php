<style type="text/css">
    .slideshow img{
        max-width: 650px;
        max-height: 500px;
    }
    #controls{
        text-align:center;
        width:160px;
    }
    #controls .ss-controls .play,#controls .ss-controls .pause,#controls .nav-controls .next,#controls .nav-controls .prev{
        background:url("/gallerynePlugin/images/controls/play.png") no-repeat scroll 0 0 transparent;
        display:block;
        height:50px;
        width:50px;
        margin:0px 100px;
        position:absolute;
    }
    #controls .ss-controls .pause{
        background:url("/gallerynePlugin/images/controls/pause.png") no-repeat scroll 0 0 transparent;
    }
    #controls .nav-controls .next{
        margin-left:160px;
        background:url("/gallerynePlugin/images/controls/next.png") no-repeat scroll 0 0 transparent;
    }
    #controls .nav-controls .prev{
        margin-left:40px;
        background:url("/gallerynePlugin/images/controls/previous.png") no-repeat scroll 0 0 transparent;
    }
    #controls .ss-controls .play:hover{
        background:url("/gallerynePlugin/images/controls/play-hover.png") no-repeat scroll 0 0 transparent;
    }
    #controls .ss-controls .pause:hover{
        background:url("/gallerynePlugin/images/controls/pause-hover.png") no-repeat scroll 0 0 transparent;
    }
    #controls .nav-controls .next:hover{
        background:url("/gallerynePlugin/images/controls/next-hover.png") no-repeat scroll 0 0 transparent;
    }
    #controls .nav-controls .prev:hover{
        background:url("/gallerynePlugin/images/controls/previous-hover.png") no-repeat scroll 0 0 transparent;
    }
</style>

<div class="slideshow-container">
    <div id="loading" class="loader"></div>
    <div id="slideshow" class="slideshow"></div>
</div>
<div id="thumbs" class="navigation" style="padding: 52px 0">
    <ul class="thumbs noscript">

        <?php
            $correctPath = GalleryneUtils::gallery_path();
        ?>

        <?php foreach ($gallery->getPhotos() as $photo) {
 ?>
            <li>
                <a class="thumb" name="<?php echo $photo->getTitle() ?>" href="<?php echo $correctPath.$gallery->getId()."/300/".$photo->getPicPath() ?>" title="<?php echo $photo->getTitle() ?>">
                    <img src="<?php echo $correctPath.$gallery->getId()."/".sfConfig::get("app_gallerynePlugin_portfolio_thumbnails_size")."/".$photo->getPicPath() ?>" alt="<?php echo $photo->getTitle() ?>" />
                </a>
                <div class="caption">
                    <div class="download">
                        <a href="<?php echo $correctPath.$photo->getPicPath() ?>">Télécharger la photo</a>
                    </div>
                    <div class="image-desc"><?php echo $photo->getTitle() ?></div>
                </div>
            </li>
<?php } ?>
    </ul>
</div>
<div id="controls" class="controls"></div>
<div class="clear"></div>
<div id="caption" class="caption-container"></div>

