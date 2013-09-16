<style>
  <!--
table { border-collapse:collapse; border-spacing: 0px; border:none; width: 640px; }
table td { padding: 0px; }
  -->
</style>
<table>
<tbody>
<tr>
  <td style="padding-left: 30px; height: 30px; color: #FFF; background: url('http://wwwassos.utc.fr/bde/weekmail/top_weekmail.jpg') no-repeat"
    colspan="2" >
    Weekmail <?php echo $date; ?>
  </td>
</tr>
<tr height="150">
  <td colspan="2" style="background-color: #000;">
    <?php /* <img src="" alt="" width="640" height="150" style="border: none;" /> */ ?>
  </td>
</tr>
<tr>
  <td rowspan="<?php echo $rows ?>" width="120" style="vertical-align: top; background-color: #000; text-align: center;">
      <?php /*<img src="" alt="" style="border: none;"/> */ ?>
    </p>
  </td>
  <td style="padding-left: 30px; background-color: grey;">
    <span style="color: #ffffff;">
      <strong>Le mot du BDE</strong>
    </span>
  </td>
</tr>
<tr>
  <td style="text-align: justify; padding: 10px 30px;">
    <?php echo nl2br($weekmail->getMotDuBde()) ?>
  </td>
</tr>
<tr height="40">
  <td style="padding-left: 30px; background-color: #000; font-weight: bold; color: #ffffff; font-size: large;">
    EDITO
  </td>
</tr>
<tr>
  <td style="text-align: justify; padding: 10px 30px;">
    <?php echo nl2br($weekmail->getEdito()) ?>
  </td>
</tr>
<tr height="40">
  <td style="text-align: left; padding-left: 30px; background-color: #000; color: #FFF; font-size: large; font-weight: bold;" id="sommaire">
    SOMMAIRE
  </td>
</tr>
<tr>
  <td style="padding: 10px 30px;">
    <p><a href="#evenements">&Eacute;V&Eacute;NEMENTS</a></p>
    <ul>
    <?php foreach(WeekmailArticleTable::getInstance()->getEventsForWeekmail($weekmail->getId())->execute() as $article) : ?>
      <li><a href="#evenement<?php echo $article->getId() ?>"><?php echo $article->getName() ?></a></li>
    <?php endforeach ?>
    </ul>
    <p><a href="#articles">ARTICLES</a></p>
    <ul>
    <?php foreach(WeekmailArticleTable::getInstance()->getArticlesForWeekmail($weekmail->getId())->execute() as $article) : ?>
      <li><a href="#evenement<?php echo $article->getId() ?>"><?php echo $article->getName() ?></a></li>
    <?php endforeach ?>
    </ul>
  </td>
</tr>
<tr height="40">
  <td style="text-align: left; padding-left: 30px; background-color: #000; color: #FFF; font-size: large; font-weight: bold;" id="evenements">
    EVENEMENTS
  </td>
</tr>
<?php foreach(WeekmailArticleTable::getInstance()->getEventsForWeekmail($weekmail->getId())->execute() as $article) : ?>
  <tr>
    <td style="background-color: <?php echo $article->getAsso()->getCouleur() ?>">
      <a name="evenement<?php echo $article->getId() ?>">
        &nbsp;<?php echo $article->getName() ?>
      </a>
    </td>
  </tr>
  <tr>
    <td style="text-align: justify; padding: 10px 30px;">
      <?php echo nl2br($article->getText()) ?>
    </td>
  </tr>
  <tr>
    <td>
      <a href="#sommaire" style="font-size: x-small;">
        Retourner au sommaire
      </a>
    </td>
  </tr>
<?php endforeach ?>
<?php //include_partial('semaineDuPic') ?>
<tr height="40">
  <td style="text-align: left; padding-left: 30px; background-color: #000; color: #FFF; font-size: large; font-weight: bold;" id="articles">
      ARTICLES
  </td>
</tr>
<?php foreach(WeekmailArticleTable::getInstance()->getArticlesForWeekmail($weekmail->getId())->execute() as $article) : ?>
  <tr>
    <td style="background-color: <?php echo $article->getAsso()->getCouleur() ?>">
      <a name="evenement<?php echo $article->getId() ?>">
        &nbsp;<?php echo $article->getName() ?>
      </a>
    </td>
  </tr>
  <tr>
    <td style="text-align: justify; padding: 10px 30px;">
      <?php echo nl2br($article->getText()) ?>
    </td>
  </tr>
  <tr>
    <td>
      <a href="#sommaire" style="font-size: x-small;">
        Retourner au sommaire
      </a>
    </td>
  </tr>
<?php endforeach ?>
<tr height="40">
  <td style="padding-left: 30px; background-color: #000; font-weight: bold; color: #ffffff; font-size: large;">
    EDITAR
  </td>
</tr>
<tr>
  <td style="text-align: justify; padding: 10px 30px;">
    <?php echo nl2br($weekmail->getEditar()) ?>
  </td>
</tr>
<tr style="height: 30px;">
  <td colspan="2">
    <img src="http://wwwassos.utc.fr/bde/weekmail/down_weekmail.jpg" alt="" width="640" />
  </td>
</tr>
</tbody>
</table>