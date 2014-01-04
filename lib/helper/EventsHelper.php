<?php
function linkTo($asso){
	return ('<a href="' . url_for('assos_show',$asso) .
	'" title="Voir la page de ' . $asso->getName() .'">'
    	.$asso->getName() . '</a>');
}

function event_from_asso_list($event){
	$event_host= 'Créé par ' . linkTo($event->getAsso());
    $guest_assos=$event->getGuestAsso();
    if ($guest_assos){
    	$event_host .= ' avec ';
    	$partners = array(); 
    	foreach ($guest_assos as $guest_asso)
    		array_push($partners,linkTo($guest_asso)); 
    	$event_host .= implode(', ', $partners);
    }
    return($event_host);
}