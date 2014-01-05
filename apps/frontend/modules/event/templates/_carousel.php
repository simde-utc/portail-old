<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>
<?php use_helper('Events') ?>

<div id="calendrier" data-interval="false" class="slide">
    <div class="row-fluid">
        <div class="span12">
            <h1 class="partie">
                Prochains événements
                <ol class="carousel-indicators pull-right">
                    <li data-target="#calendrier" data-slide-to="0" class="active"></li>
                    <?php for($i=1;$i<=count($events)/3;$i++): ?>
                        <li data-target="#calendrier" data-slide-to="<?php echo $i ?>"></li>
                    <?php endfor ?>
                </ol>
            </h1>
        </div>
    </div>
    <div class="carousel-inner">
        <?php $count = 0 ?>
        <div class="active item">
            <div class="row-fluid">
                <?php foreach($events as $event): ?>
                    <?php if($count != 0 && $count % 3 == 0): ?>
                </div>
            </div>
            <div class="item">
                <div class="row-fluid">
            <?php endif ?>
                    <div class="event span4">
                        <div class="media">
                            <a class="pull-left" href="<?php echo url_for('event/show?id='.$event->getId()) ?>">
                                <?php echo showThumb($event->getAffiche(), 'events', array('width'=>112, 'height'=>112, 'class'=>'media-object'), 'center') ?>
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="<?php echo url_for('event/show?id='.$event->getId()) ?>"><?php echo $event->getName() ?></a></h4>
                                <p><?php echo $event->getSummary() ?></p>
                                <p>
                                
                                Par <?php echo linkTo($event->getAsso()) ;?><br />
                                <?php echo format_date($event->getStartDate(),"D",'fr') ?>, <?php echo format_date($event->getStartDate(),"t",'fr') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php $count++ ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <a href="#calendrier" data-slide="prev" class="left carousel-control">&lsaquo;</a>
    <a href="#calendrier" data-slide="next" class="right carousel-control">&rsaquo;</a>
</div>