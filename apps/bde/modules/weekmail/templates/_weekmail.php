<?php use_helper('Date'); ?>
<?php use_helper('CrossLink'); ?>
<table id="grandtableau" cellspacing="0" cellpadding="0" width="640" style="
		background-image:url(https://assos.utc.fr/bde/weekmail/v2/bordure.png);
		font-family: 'Lucida Sans Unicode';
		font-size: 13px;
		border-collapse: separate;
		border-spacing : 5px 0;
		border-width: 0px;">
<tbody>

<tr width="640px">
  <td style="border-style : none none solid none; border-color: #f0f0f0; padding-left: 30px; height: 40px; color: #fff; background: url('http://i174.photobucket.com/albums/w84/fddfd/front_l.png') no-repeat;
		border-width: 1px;
		border-collapse : collapse;">
    Weekmail <?php echo $date; ?>
  </td>
</tr>
<tr width="640px">
  <td bgcolor="#f3f3f3" style="
		border-collapse : collapse;
		background-color : #fff;">
	<img src="https://assos.utc.fr/bde/weekmail/v2/weekmail_l2_1.png" alt="" width="640" />
  </td>
</tr>

<tr width="640px">
	<td style="text-align : right;
		border-collapse : collapse;
		background-color : #fff;
		padding : 5px 0 0 0;">
		<img src="https://assos.utc.fr/bde/weekmail/v2/bannieremotbde2.png" width="640px"/>
	</td>
</tr>
<tr width="640px">
	<td style="text-align : justify; padding : 10px 20px 10px 20px; border-style: none;
		border-collapse : collapse;
		background-color : #fff;">
		<table style="border-collapse : separate">
			<td style="text-align :justify; padding : 5px 10px;
					text-indent : 25px;" width="400px"><?php echo nl2br($weekmail->getMotDuBde()) ?></td>
			<td width="200px"><table id="lesaviezvous" cellspacing="0" cellpadding="0" style="
			border-spacing : 5px 0;
			font-size : 13px;
			boder-collapse :collapse;">
				<tr><td style="
					border-style : solid;
					border-width : 1px;
					border-color : #333333;
					border-collapse :collapse;">
						<img src="https://assos.utc.fr/bde/weekmail/v2/lesaviezvousfinal.png" alt="" width="200px" />
				</td></tr>
				<tr><td style="
					border-style : solid;
					border-width : 1px;
					border-color : #333333;
					background-color : #333333;
					color : #efefef;
					border-style : none solid solid solid;
					text-align : center;
					padding : 2px 3px;">
						<?php echo nl2br($weekmail->getLeSaviezVous()) ?>
				</td></tr>
			</table></td>
		</table>
	</td>
</tr>

<tr width="640px">
	<td style="text-align : right;
		border-collapse : collapse;
		background-color : #fff;">
		<img src="https://assos.utc.fr/bde/weekmail/v2/banniereedito2.png" width="640px"/>
	</td>
</tr>
<tr width="640px">
  <td style="text-align : justify; padding : 10px 20px 10px 20px; border-style: none;
		border-collapse : collapse;
		background-color : #fff;">
    <p style="text-indent : 25px; padding : 10px 0px 0px 0px;"><?php echo nl2br($weekmail->getEdito()) ?></p>
  </td>
</tr>

<tr width="640px">
	<td style="text-align : right;
		border-collapse : collapse;
		background-color : #fff;">
		<img src="https://assos.utc.fr/bde/weekmail/v2/bannieresommaire2.png" width="640px"/>
	</td>
</tr>
<tr width="640px">
  <td style="text-align : justify; padding : 10px 20px 10px 100px; border-style: none;
		border-collapse : collapse;
		background-color : #fff;">
    <p><a style="text-decoration: none; color: #1bafed;" href="#evenements">&Eacute;V&Eacute;NEMENTS</a></p>
    <ul>
    <?php foreach(WeekmailArticleTable::getInstance()->getEventsForWeekmail($weekmail->getId())->execute() as $article) : ?>
      <li><a style="text-decoration: none; color: #1bafed;"  href="#evenement<?php echo $article->getId() ?>"><?php echo $article->getAsso()->getName() ?> : <?php echo $article->getName() ?></a></li>
    <?php endforeach ?>
    </ul>
    <p><a style="text-decoration: none; color: #1bafed;" href="#articles">ARTICLES</a></p>
    <ul>
    <?php foreach(WeekmailArticleTable::getInstance()->getArticlesForWeekmail($weekmail->getId())->execute() as $article) : ?>
      <li><a style="text-decoration: none; color: #1bafed;" href="#evenement<?php echo $article->getId() ?>"><?php echo $article->getAsso()->getName() ?> : <?php echo $article->getName() ?></a></li>
    <?php endforeach ?>
    </ul>
  </td>
</tr>

<tr width="640px">
	<td style="text-align : right;
		border-collapse : collapse;
		background-color : #fff;">
		<a style="text-decoration: none; color: #1bafed;" name="evenements"></a>
		<img src="https://assos.utc.fr/bde/weekmail/v2/banniereevenement2.png" width="640px"/>
	</td>
</tr>
<tr width="640px">
  <td valign="top"  style="
		border-style : none;
		border-collapse : collapse;
		background-color : #fff;
		padding : 20px 0;">
	<table id="petittableau" width="640" style="
		text-align: center;
		border-collapse: collapse;">
	<?php foreach(WeekmailArticleTable::getInstance()->getEventsForWeekmail($weekmail->getId())->execute() as $article) : ?>
	  <tr>
		<td colspan=2 style="background-color:<?php echo $article->getAsso()->getCouleur() ?>;" >
		  <a style="text-decoration: none; color: #1bafed;" name="evenement<?php echo $article->getId() ?>"></a>
		  &nbsp;<?php echo $article->getAsso()->getName() ?> : <?php echo $article->getName() ?>
		</td>
	  </tr>
	  <tr>
		<td style="text-align: justify; padding: 10px 15px; border-style : none; width : 100px; font-size : 13px;"><center>
			<?php if ($article->getAsso()->getLogo() != null) { ?>
				<img src="https://assos.utc.fr/uploads/assos/thumb/150x150_<?php echo $article->getAsso()->getLogo() ?>" alt="" width="100px" />
			<?php }
				//echo "<br/>".$article->getAsso()->getName();
			?>
		</center></td>
		<td style="text-align: justify; padding: 10px 30px; border-style : none; width : 540px;">
		  <p>
			<?php echo ucfirst(format_date($article->getEvent()->getStartDate(), 'EEEE d MMMM à H:mm', 'fr')) ?>
			(<?php echo $article->getEvent()->getPlace() ?>)<br />
		  </p>
		  <?php echo nl2br($article->getText()) ?>
		  <br />
		  <a style="text-decoration: none; color: #1bafed; font-size : 10px;" href="<?php echo cross_app_link_to('frontend', '@event_show', array('id' => $article->getEventId())) ?>" title="Lire <?php echo $article->getName() ?>">Voir les détails...</a>
		</td>
	  </tr>
	  <tr>
		<td colspan=2 style=" border-style : none;">
		  <a style="text-decoration: none; color: #1bafed; font-size : 11px;"  href="#sommaire" style="font-size: x-small;">
			Retourner au sommaire
		  </a>
		</td>
	  </tr>
	<?php endforeach ?>
  </table></td>
</tr>

<tr width="640px">
	<td style="text-align : right;
		border-collapse : collapse;
		background-color : #fff;">
		<a style="text-decoration: none; color: #1bafed;" name="articles"></a>
		<img src="https://assos.utc.fr/bde/weekmail/v2/bannierearticles2.png" width="640px"/>
	</td>
</tr>
<tr width="640px">
  <td valign="top"  style="
		border-style : none;
		border-collapse : collapse;
		background-color : #fff;
		padding : 20px 0;">
	<table id="petittableau" style="
		text-align: center;
		border-collapse: collapse;">
	<?php foreach(WeekmailArticleTable::getInstance()->getArticlesForWeekmail($weekmail->getId())->execute() as $article) : ?>
	  <tr>
		<td colspan=2 style="background-color:<?php echo $article->getAsso()->getCouleur() ?>;">
		  <a style="text-decoration: none; color: #1bafed;" name="evenement<?php echo $article->getId() ?>"></a>
		  &nbsp;<?php echo $article->getAsso()->getName() ?> : <?php echo $article->getName() ?>
		</td>
	  </tr>
	  <tr>
		<td style="text-align: justify; padding: 10px 15px; border-style : none; width : 100px; font-size : 13px;"><center>
			<?php if ($article->getAsso()->getLogo() != null) { ?>
				<img src="https://assos.utc.fr/uploads/assos/thumb/150x150_<?php echo $article->getAsso()->getLogo() ?>" alt="" width="100px" />
			<?php }
				//echo "<br/>".$article->getAsso()->getName();
			?>
		</center></td>
		<td style="text-align: justify; padding: 10px 15px; border-style : none; width : 540px;">
		  <?php echo nl2br($article->getText()) ?>
		  <br />
		  <a style="text-decoration: none; color: #1bafed; font-size : 10px;" href="<?php echo cross_app_link_to('frontend', '@article_show', array('id' => $article->getArticleId())) ?>" title="Lire <?php echo $article->getName() ?>">Voir sur le portail...</a>
		</td>
	  </tr>
	  <tr>
		<td colspan=2 style="border-style : none;">
		  <a style="text-decoration: none; color: #1bafed; font-size : 11px;" href="#sommaire" style="font-size: x-small;">
			Retourner au sommaire
		  </a>
		</td>
	  </tr>
	<?php endforeach ?>
  </table></td>
</tr>

<tr width="640px">
	<td style="text-align : right;
		border-collapse : collapse;
		background-color : #fff;">
		<img src="https://assos.utc.fr/bde/weekmail/v2/banniereeditar2.png" width="640px"/>
	</td>
</tr>
<tr width="640px">
  <td style="text-align : justify; padding : 10px 20px 10px 20px; border-style: none;
		border-collapse : collapse;
		background-color : #fff;">
    <p style="text-indent : 25px; padding : 10px 0px 0px 0px;"><?php echo nl2br($weekmail->getEditar()) ?></p>
  </td>
</tr>

<tr width="640px">
	<td style="text-align : right;
		border-collapse : collapse;
		background-color : #fff;">
		<img src="https://assos.utc.fr/bde/weekmail/v2/bannierejob2.png" width="640px"/>
	</td>
</tr>
<tr width="640px">
	<td  style="
		border-style : none;
		border-collapse : collapse;
		background-color : #fff;
		padding : 10px 20px;">
		<center>
		<?php
			foreach (InfoJobOffreTable::getInstance()->getLastOffreList()->execute() as $offre) :
		?>
			<table id="petittableau" style="text-align :justify; font-size : 13px; border-collapse : collapse; border : solid 1px #333333; padding : 5px 0;" width="600px">
				<tr><td style="text-align : center; background-color : #333333; color : #efefef;"><?php echo $offre->getTitre(); ?></td></tr>
				<tr><td style="background-color : #efefef; color : #333333;">Lieu : <?php echo $offre->getLieu(); ?><br/>
				Mail : <?php echo $offre->getEmail(); ?><br/>
				Téléphone : <?php echo $offre->getTelephone(); ?></td></tr>
			</table>
		<?php endforeach ?>
		<p>Rendez-vous sur le portail des assos, rubrique <a href="http://assos.utc.fr/infojob" style="text-decoration : none; color : #1bafed;">Infojob</a>, pour plus d'offres</p>
		</center>
	</td>
</tr>

<tr>
  <td  style="border-top : solid 1px #333333;
		border-bottom : solid 1px #333333;
		border-collapse : collapse;
		background-color : #efefef;">
    <img src="https://assos.utc.fr/bde/weekmail/v2/back_l.png" alt="" width="640" />
  </td>
</tr>

</tbody>
</table>