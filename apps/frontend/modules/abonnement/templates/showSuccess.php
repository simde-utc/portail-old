<?php echo $text ?>
<br>

<br>
<?php foreach ($abonnements as $abonnement):?>
<div class="well">
  <?php echo $abonnement->getAsso()->getName()?>
  <?php foreach ($abonnement->getAsso()->getArticle() as $article):?>
    <div class="well">
    <?php echo $article->getName() ?>
    <br>
        <?php echo $article->getSummary() ?>
    </div>
  <?php endforeach ?>
</div>
<?php endforeach ?>
<br>


