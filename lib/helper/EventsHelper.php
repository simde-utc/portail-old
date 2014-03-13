<?php
function linkTo($asso){
	return ('<a href="' . url_for('assos_show',$asso) .
	'" title="Voir la page de ' . $asso->getName() .'">'
    	.$asso->getName() . '</a>');
}

function getAssoNameForEvent($event){
	$event_host= 'Créé par ' . linkTo($event->getAsso());
	
    $guest_assos=$event->getGuestAsso();
	$partners = array(); 
	foreach ($guest_assos as $guest_asso)
		array_push($partners,linkTo($guest_asso)); 
    if($partners)
	    $event_host .= ' avec ' .implode(', ', $partners);
    return($event_host);
}
