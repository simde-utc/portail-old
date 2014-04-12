<fieldset><legend>Custom Calendar</legend>
	<div id="listSalle">
		<?php if ($salles): ?>
			<ul>
				<?php foreach ($salles as $salle): ?>
				
						<a href="<?php echo url_for('/reservation/' . $salle->getID()) ?>"><?php echo $salle->getName() ?></p>
				
				<?php endforeach ?>
			</ul>
		<?php endif ?>
	</div>
</fieldset>
