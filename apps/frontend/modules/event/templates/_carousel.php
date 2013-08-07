<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>

<div class="row">
    <div class="span12">
        <h1 class="partie">Prochains événements</h1>
    </div>
</div>
<div id="calendrier" class="row">
    <?php foreach($events as $event) : ?>
        <div class="event span4">
            <div class="media">
                <a class="pull-left" href="<?php echo url_for('event/show?id='.$event->getId()) ?>">
                    <?php echo showThumb($event->getAffiche(), 'events', array('width'=>112, 'height'=>112, 'class'=>'media-object'), 'center') ?>
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="<?php echo url_for('event/show?id='.$event->getId()) ?>"><?php echo $event->getName() ?></a></h4>
                    <p><?php echo $event->getSummary() ?></p>
                    <p>
                        Par <a href="<?php echo url_for('asso/show?login='.$event->getAsso()->getLogin()) ?>" title="<?php echo $event->getAsso()->getName() ?>"><?php echo $event->getAsso()->getName() ?></a><br />
                        <?php echo format_date($event->getStartDate(),"D",'fr') ?>, <?php echo format_date($event->getStartDate(),"t",'fr') ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>