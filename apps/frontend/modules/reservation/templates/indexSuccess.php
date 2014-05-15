<?php use_stylesheet('fullcalendar.css') ?>

<?php use_stylesheet('reservation.css') ?>

<?php use_javascript('fullcalendar.min.js') ?>

<?php use_javascript('reservation.js') ?>

<h1 class="partie">Calendrier des reservations de salles <i id="loading" class="fa fa-refresh fa-spin fa-lg pull-right"></i></h1>

<?php include_component('reservation','listeSalles', array('idSalle' => $idSalle)) ?>

<?php if (isset($form)): ?>
<?php include_partial('TestForm', array('form' => $form)) ?>
<?php endif ?>

<div id="calendar"></div>
<script>
$(document).ready(function() {
  $("#calendar").fullCalendar({
    
  	 dayClick: function(e)
  	 {
  	 
		if ($('#FormShape').length == 0) // Si le tableau == 0
		{
			alert ("Vous devez etre authentifié au cas");
		}
		else
		{

	  	 	$('#test-form_date_day').val(parseInt($.fullCalendar.formatDate( e, "dd")));
	  	 	$('#test-form_date_month').val(parseInt($.fullCalendar.formatDate( e, "MM")));
	  	 	$('#test-form_date_year').val(parseInt($.fullCalendar.formatDate( e, "yyyy")));
	  	 	$('#test-form_heuredebut_hour').val(parseInt(e.getHours()));
	  	 	$('#test-form_heuredebut_minute').val(parseInt(e.getMinutes()));
	  	 	
	  	 	$('#FormShape').fadeIn();
  	 	}
  	 },
  	 
	eventClick: function(event) {
        if (event.url) {
            window.open(event.url);
            return false;
        }
    },

    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'agendaDay,agendaWeek'
    },
    editable: false,
    allDayDefault: false,
    events: "<?php if ($idSalle == -1) echo url_for('reservations_json',array('sf_format'=>'json')); else echo url_for("reservation_json",array('sf_format'=>'json', 'id'=>$idSalle)); ?>", //"<?php echo url_for("reservation_json",array('sf_format'=>'json', 'id'=>$idSalle)) ?>",
    loading: function(bool) {
      if (bool) $('#loading').show();
      else $('#loading').hide();
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
