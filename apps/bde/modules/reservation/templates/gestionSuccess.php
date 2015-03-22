<?php use_stylesheet('fullcalendar.css') ?>

<?php use_javascript('fullcalendar.min.js') ?>
<?php use_javascript('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js') ?>

<?php include_partial("insideMenu",array("param" => $param)) ?>

<h3>Gestion des reservations</h3>

<form method="post" action="">
  
  <label>Selection du pole :</label>
  <select name="pole">
    <option value="-1">All</option>
    <?php foreach($poles as $p): ?>
    <option value="<?php echo $p->getId() ?>" <?php if ($p->getId() == $pole) echo "selected" ?>><?php echo $p ?></option>
    <?php endforeach ?>
  </select>
  
  <label>Selection de la salle :</label>
  <select name="salle">
  </select>

<br />
<input type="submit" name="submit" value="Valider" />

</form>


<div id="calendar" style="background:#FFF"></div>
<script>
$(document).ready(function() {
  
  function loadSalle()
  {
    $.ajax({
        url: "<?php echo url_for('reservation_gestion_salle_list') ?>",
        data : {pole : $('form select[name=pole]').val(),
              salle : <?php echo $salle ?> },
        success : function(data)
        {
          //console.log(data);
          $('form select[name=salle]').empty();
          $('form select[name=salle]').append(data);
        }
      });
  }
  
  loadSalle();
  
  $('form select[name=pole]').change(function()
  {
    loadSalle();  
  });
  
  
  
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
    
    var comment = askForValidateChanges(event.title);
    
    if (comment != null)
    {
      $.ajax({
        url: "<?php echo url_for('reservation_gestion_edit') ?>",
        data: {id:event.id, 
            date:event.start.toJSON().split("T")[0], 
            start:event.start.toTimeString().split(" ")[0],
            end:event.end.toTimeString().split(" ")[0],
            comment : comment,
            allday : false
            }    
      });
    }
    
    },
    
    eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {

    var comment = askForValidateChanges(event.title);
    
    if (comment != null)
    {
    
      $.ajax({
        url: "<?php echo url_for('reservation_gestion_edit') ?>",
        data: {id:event.id, 
            date:event.start.toJSON().split("T")[0], 
            start:event.start.toTimeString().split(" ")[0],
            end:event.end.toTimeString().split(" ")[0],
            comment : comment,
            allday : allDay
            }

      });
    
    }

    },   
    /*
    
    AJAX POUR SUPPRIMER UNE RESERVATION LORS D'UN CLIC SUR LA RESERVATION
    
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
    events: "<?php echo url_for ('reservations_json',array('sf_format'=>'json', 'pole'=>$pole, 'salle'=>$salle)) ?>",
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
