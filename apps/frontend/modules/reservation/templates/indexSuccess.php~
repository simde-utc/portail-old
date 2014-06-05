<?php use_stylesheet('fullcalendar.css') ?>

<?php use_stylesheet('reservation.css') ?>

<?php use_javascript('fullcalendar.min.js') ?>

<?php use_javascript('reservation.js') ?>

<h1 class="partie">Calendrier des reservations de salles <i id="loading" class="fa fa-refresh fa-spin fa-lg pull-right"></i></h1>

<?php if ($userIdentified): ?> 
    <?php include_component('reservation','listeSalles', array('idSalle' => $idSalle)) ?>
    
    <?php if ($afficherErreur): ?> 
	
	  <?php include_partial('formNew', array('idSalle' => $idSalle, 'form' => $form)) ?> 
	
    <?php endif; ?>

    <?php if ($ok): ?> 

	<?php echo "<p>Réservation réalisée avec succès !</p>" ?>
	
    <?php endif; ?>

    <div id="calendar"></div>

    <script>
    $(document).ready(function() {
    
    var afficherErreur=parseInt(<?php echo $afficherErreur; ?>) ;
    if(afficherErreur){
	$('#FormShape').fadeIn();
    }  
    
    $("#calendar").fullCalendar({


	 
	dayClick: function(e)
	{
	  
	  if (idSalle < 0) 
	  {
		  alert ("Vous devez sélectionner une salle pour pouvoir effectuer une réservation.");
		  return;
	  }
	  

	  var idSalle=parseInt(<?php echo $idSalle; ?>) ;
	  var UserID=parseInt(<?php echo $UserID; ?>) ;
	  
	  // SI formulaire exist déjà
	  if ($('#FormShape').length > 0)
	  {
	  
	      $('#reservation_date_day').val(parseInt($.fullCalendar.formatDate( e, "dd")));
	      $('#reservation_date_month').val(parseInt($.fullCalendar.formatDate( e, "MM")));
	      $('#reservation_date_year').val(parseInt($.fullCalendar.formatDate( e, "yyyy")));
	      $('#reservation_heuredebut_hour').val(parseInt(e.getHours()));
	      $('#reservation_heuredebut_minute').val(parseInt(e.getMinutes())==30?"30":"00");
	      
	      $('#FormShape').fadeIn();
	  
	  }
	  else
	  {
	    $.ajax({
	      url: "<?php echo url_for('reservation_form_new') ?>",
	      data: { idSalle : idSalle, UserID : UserID},
	      success : function (data)
	      {
		$("#calendar").before(data);
		
	      $('#reservation_date_day').val(parseInt($.fullCalendar.formatDate( e, "dd")));
	      $('#reservation_date_month').val(parseInt($.fullCalendar.formatDate( e, "MM")));
	      $('#reservation_date_year').val(parseInt($.fullCalendar.formatDate( e, "yyyy")));
	      $('#reservation_heuredebut_hour').val(parseInt(e.getHours()));
	      $('#reservation_heuredebut_minute').val(parseInt(e.getMinutes())==30?"30":"00");
	      
		$('#FormShape').fadeIn();
	      }
	    });
	    

	    
	   }
	    
	    
	    
	},
		
	eventClick: function(event) {
		
		console.log(event);
		if (!event.url) {

		}
		else
		{
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
	events: "<?php if ($idSalle == -1) echo url_for ('reservations_json',array('sf_format'=>'json')); else echo url_for('reservation_json',array('sf_format'=>'json','id'=>$idSalle)) ?>",
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
<?php else: ?>

  <center> Vous devez être connecté pour pouvoir accéder au planning des réservations. <a href="<?php echo url_for('cas')?>"> Connexion CAS. </a></center>

<?php endif; ?>