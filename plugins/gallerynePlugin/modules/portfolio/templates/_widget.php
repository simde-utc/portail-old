<table>
<tbody>
    <tr>
        <td>
<?php 
$nb = 4;
$galleries = Gallery::getNbGalleries($nb);
if(count($galleries)>=1) { ?>
    <a href="<?php echo url_for("@listGalleries"); ?>"></a>
    <div class="clear"></div>
    <table>
        <?php foreach ($galleries as $i=>$gallery): ?>
        <tr>
            <td>
                <div>
                    <?php echo $gallery->getDateTimeObject('created_at')->format('d'); ?><br/>
                    <?php echo $gallery->getDateTimeObject('created_at')->format('M'); ?>
                    <?php $default = $gallery->getPhotoDefault()->getPicpath() ?>
                </div>
            </td>
            <td>
                <a href="<?php echo url_for(@showGallery, $gallery) ?>">
                    <img src="/uploads/thumbnail/50_<?php echo $default ?>"/>
                </a>
            </td>
            <td>
                <a href="<?php echo url_for(@showGallery, $gallery) ?>">
                    <?php echo $gallery->getTitle() ?>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
    <div class="clear"></div>
    <a style="float:right; " href="<?php echo url_for("@listGalleries"); ?>">+ les voir toutes !</a><div class="clear"></div>
    <?php } ?>
        </td>
    </tr>
</tbody>
</table>