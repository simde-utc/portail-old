<?php include_partial('gallery/assets') ?>
<?php include_partial('gallery/list_actions', array('helper' => $helper)) ?>
<hr/>

<?php if($pager->count()){ ?>

<div>
    <div>
        <h2><?php echo __("backend.gallery.index.title",array(),"galleryne"); ?></h2>
        <div>
            <div>
                <ul class="thumbnails">
                    <?php foreach ($pager->getResults() as $nb=>$g) { ?>
                    <li class="thumbnail">
                        <a href="<?php echo url_for("gallery/edit?id=".$g->getId()) ?>" title="<?php echo __("backend.gallery.index.edit",array(),"galleryne"); ?>">
                            <img src="<?php echo $g->getPhotoDefault() ?>" height="150" >
                          <!-- this way we remember where the user is (gallery and page -->
                        </a>
                          <div class="caption">
                            <h5><?php echo $g->getTitle(ESC_RAW) ?></h5>
                            <p><?php echo $g->getDescription(ESC_RAW) ?></p></a></p>
                          </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <div style="float: right">
        <?php if ($pager->haveToPaginate()){ ?>
            <ul class="pagination">
                <?php foreach ($pager->getLinks() as $page){ ?>
                  <li <?php echo $page == $pager->getPage() ? "class='current'": ""; ?>>
                      <!-- this way we remember where the user is (gallery and page -->
                      <a href="<?php echo preg_replace("/\?[a-z\-&=0-9]+/","",$_SERVER["REQUEST_URI"]) ?><?php echo isset($_GET["gallery"])? "?gallery=".$_GET["gallery"]."&":"?"; ?>page=<?php echo $page ?>">
                          <span><?php echo $page ?></span>
                      </a>
                  </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</div>
<?php }else{ ?>
<?php echo __("backend.gallery.index.empty",array(),"galleryne"); ?>
<?php } ?>
