<fieldset><legend>Custom Calendar</legend>
	<form id="listSalle">
		<?php if (count($salles) > 0): ?>
			<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
				<? $lastIdPole = -1 ?>
				<?php foreach ($salles as $salle): ?>
				
					<?php if ($lastIdPole != $salle->getPole()->getId()): ?>
					
						<option value="">-----<?php echo $salle->getPole() ?>-----</option>
					
					<?php endif ?>
					
					<?php if ($salle->getID() == $idSalle) : ?>
						<option selected="true" value="<?php echo url_for('/reservation/'.$salle->getID()) ?>"><?php echo $salle->getName() ?></option>
					<?php else : ?>
						<option value="<?php echo url_for('/reservation/'.$salle->getID()) ?>"><?php echo $salle->getName() ?></option>
					<?php endif ?>
				
					<?php $lastIdPole = $salle->getPole()->getId() ?>
				
				<?php endforeach ?>
			</select>
		<?php endif ?>
	</form>
</fieldset>
