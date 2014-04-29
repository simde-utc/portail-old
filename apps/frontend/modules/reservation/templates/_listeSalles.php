<!--<fieldset><legend>Custom Calendar</legend>
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
</fieldset>-->

<?php if (count($salles) > 0): ?>

<div id="dd" class="wrapper-dropdown-3" tabindex="1">
    <span id="dd-label">Salles</span>
	    <ul class="dropdown">
		
		<? $lastIdPole = -1 ?>
	
		<?php foreach ($salles as $salle): ?>

			<?php if ($lastIdPole != $salle->getPole()->getId()): ?>				
				<li class="pole"><?php echo $salle->getPole() ?></li>	
			<?php endif ?>

			<?php if ($salle->getID() == $idSalle) : ?>
				<li class="salleSelect"><a href="<?php echo url_for('@reservation_salle?id='.$salle->getID()) ?>"><?php echo $salle->getName() ?></a></li>
			<?php else : ?>
				<li class="salleSelect" ><a href="<?php echo url_for('@reservation_salle?id='.$salle->getID()) ?>"><?php echo $salle->getName() ?></a></li>	
			<?php endif ?>
				
			<?php $lastIdPole = $salle->getPole()->getId() ?>
				
		<?php endforeach ?>
		</ul>
	</div>

<?php endif ?>
