<?php use_helper('Date'); ?>
<table border="0" cellspacing="0" cellpadding="0" width="640">
<tbody>
<tr>
  <td style="padding-left: 30px; height: 30px; color: #FFF; background: url('http://wwwassos.utc.fr/bde/weekmail/top_weekmail.jpg') no-repeat"
    colspan="2" >
    Weekmail <?php echo $date; ?>
  </td>
</tr>
<tr height="150">
  <td colspan="2" bgcolor="#000">
    <?php /* <img src="" alt="" width="640" height="150" style="border: none;" /> */ ?>
  </td>
</tr>
<tr>
  <td rowspan="<?php echo $rows ?>" width="120" valign="top" bgcolor="#000" style="text-align: center;">
      <?php /*<img src="" alt="" style="border: none;"/> */ ?>
    </p>
  </td>
  <td style="padding-left: 30px;" bgcolor="grey">
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
  <td style="padding-left: 30px;" bgcolor="black">
    <strong>
      <span style="color: #ffffff; font-size: large;">EDITO</span>
    </strong>
  </td>
</tr>
<tr>
  <td style="text-align: justify; padding: 10px 30px;">
    <?php echo nl2br($weekmail->getEdito()) ?>
  </td>
</tr>
<tr height="40">
   <td style="text-align: left; padding-left: 30px;" bgcolor="black" id="sommaire">
    <strong>
      <span style="color: #ffffff; font-size: large;">SOMMAIRE</span>
    </strong>
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
  <td style="test-align: left; padding-left: 30px;" bgcolor="black" id="evenements">
    <strong>
      <span style="color: #ffffff; font-size: large;">EVENEMENTS</span>
    </strong>
  </td>
</tr>
<?php foreach(WeekmailArticleTable::getInstance()->getEventsForWeekmail($weekmail->getId())->execute() as $article) : ?>
  <tr>
    <td bgcolor="<?php echo $article->getAsso()->getCouleur() ?>">
      <a name="evenement<?php echo $article->getId() ?>"></a>
      &nbsp;<?php echo $article->getName() ?>
    </td>
  </tr>
  <tr>
    <td style="text-align: justify; padding: 10px 30px;">
      <p>
        Du <?php echo format_date($article->getEvent()->getStartDate(), 'f', 'fr') ?> au
        <?php echo format_date($article->getEvent()->getEndDate(), 'f', 'fr') ?><br />
        Lieu: <?php echo $article->getEvent()->getPlace() ?><br />
      </p>
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
  <td style="test-align: left; padding-left: 30px;" bgcolor="black" id="articles">
    <strong>
      <span style="color: #ffffff; font-size: large;">ARTICLES</span>
    </strong>
  </td>
</tr>
<?php foreach(WeekmailArticleTable::getInstance()->getArticlesForWeekmail($weekmail->getId())->execute() as $article) : ?>
  <tr>
    <td bgcolor="<?php echo $article->getAsso()->getCouleur() ?>">
      <a name="evenement<?php echo $article->getId() ?>"></a>
      &nbsp;<?php echo $article->getName() ?>
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
  <td style="padding-left: 30px;" bgcolor="black">
    <strong>
      <span style="color: #ffffff; font-size: large;">EDITAR</span>
    </strong>
  </td>
</tr>
<tr>
  <td style="text-align: justify; padding: 10px 30px;">
    <?php echo nl2br($weekmail->getEditar()) ?>
  </td>
</tr>
<tr height="30">
  <td colspan="2">
    <img src="http://wwwassos.utc.fr/bde/weekmail/down_weekmail.jpg" alt="" width="640" />
  </td>
</tr>
</tbody>
</table>
