<?php use_stylesheet('fullcalendar.css') ?>

<?php use_javascript('fullcalendar.min.js') ?>
<?php use_javascript('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js') ?>

<?php include_partial("insideMenu",array("param" => $param)) ?>

<h3>Gestion des reservations</h3>

<div id="calendar" style="background:#FFF"></div>
<script>
$(document).ready(function() {
	
	function askForValidateChanges(nameEvent)
	{
		var txt = "L'evenement "+nameEvent+" a été modifié.\n Afin de valider cette modification, entrer un commentaire si dessous afin de prévenir le titulaire par mail de la modification de sa réservation.";
		
		var txtField = "Votre commentaire ici";
		
		var ret = window.prompt(txt,txtField);
		
		if (ret == txtField)
			return null;
			
		return ret;
	}
	
  $("#calendar").fullCalendar({
 	 
 	 eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
	
		//console.log("RESIZE");
		//console.log(event);
		//a = event;
		
		if (var comment = askForValidateChanges(event.title) != null)
		{
			$.ajax({
				url: "<?php echo url_for('reservation_gestion_edit') ?>",
				data: {id:event.id, 
						date:event.start.toJSON().split("T")[0], 
						start:event.start.toTimeString().split(" ")[0],
						end:event.end.toTimeString().split(" ")[0],
						comment : comment
						}		
			});
		}
		
    },
    
    eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {

		//console.log("DROP");
		//console.log(event);
		
		if (askForValidateChanges(event.title) != null)
		{
		
			$.ajax({
				url: "<?php echo url_for('reservation_gestion_edit') ?>",
				data: {id:event.id, 
						date:event.start.toJSON().split("T")[0], 
						start:event.start.toTimeString().split(" ")[0],
						end:event.end.toTimeString().split(" ")[0]
						}		
			});
		
		}

			/*
        if (allDay) {
            alert("Event is now all-day");
        }else{
            alert("Event has a time-of-day");
        }
        */

    },   
    /*
    
    AJAX POUR SUPPRIMER UNE RESERVATION
    
    eventClick: function(event, jsEvent, view) {

     //alert('Event: ' + event.id);

		var conf = window.confirm("Suppression de l'évenement: "+event.title);
		
		if (conf)
		{
			$.ajax({
				url: "<?php echo url_for('reservation_gestion_delete') ?>",
				data: {id:event.id}		
			});
			
			$('#calendar').fullCalendar('removeEvents', event.id);
		}

    },
 	 */
 	 
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'agendaDay,agendaWeek'
    },
    editable: true,
    allDayDefault: false,
    events: "<?php echo url_for ('reservations_json',array('sf_format'=>'json')) ?>",
    loading: function(bool) {
      if (!bool) showPopUp();
    },
    buttonText: {
        today: 'aujourd&rsquo;hui',
        month: 'mois',
        week:  'semaine',
        day:   'jour'
      },
    monthNames: ['janvier', 'février', 'mars', 'avril', 'mai',
      'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
    monthNamesShort: ['jan.', 'fév.', 'mar.', 'avr.', 'mai', 'juin',
       'juil.', 'aoû.', 'sep.', 'oct.', 'nov.', 'déc.'],
    dayNames: ['dimanche', 'lundi', 'mardi', 'mercredi',
       'jeudi', 'vendredi', 'samedi'],
    dayNamesShort: ['dim.', 'lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.'],
    firstDay: 1,
    titleFormat: {
      month: 'MMMM yyyy',
      week: "d[ MMMM][ yyyy]{ - d MMMM yyyy}",
      day: 'dddd d MMMM yyyy',
    },
    columnFormat: {
      month: 'dddd',
      week: 'ddd d',
      day: '',
    },
    axisFormat: 'H:mm',
    timeFormat: {
      '': 'H:mm',
      agenda: 'H:mm{ - H:mm}',
    },
    allDayText: 'Jour entier',
    defaultView: 'agendaWeek',
    height: 1000,
    weekends: true,
    minTime: 8,
  });
  
});
</script>
