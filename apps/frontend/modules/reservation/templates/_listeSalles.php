<fieldset>
	<legend><?php if ($idSalle) echo "Salle" . $idSalle; else echo "Salles"; ?></legend>
		<?php if (count($salles) > 0): ?>
			<select id="selectSalle">
				<? $lastIdPole = -1 ?>
				<?php foreach ($salles as $salle): ?>

					<?php if($salle->getPole()->getId()==1 || in_array($salle->getPole()->getId(), $sf_data->getRaw(polesUser))): ?>
				
						<?php if ($lastIdPole != $salle->getPole()->getId()): ?>
					
							<option disabled>-----<?php echo $salle->getPole() ?>-----</option>
					
						<?php endif ?>
					
						<?php if ($salle->getID() == $idSalle) : ?>
							<option selected="true" value="<?php echo url_for('@reservation_salle?id='.$salle->getID()) ?>"><?php echo $salle->getName() ?></option>
						<?php else : ?>
							<option value="<?php echo url_for('@reservation_salle?id='.$salle->getID()) ?>"><?php echo $salle->getName() ?></option>
						<?php endif ?>

						<?php $lastIdPole = $salle->getPole()->getId() ?>

					<?php endif ?>
				
				<?php endforeach ?>
			</select>
		<?php endif ?>
</fieldset>
