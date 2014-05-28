<?php use_stylesheet('fullcalendar.css') ?>

<?php use_stylesheet('reservation.css') ?>

<?php use_javascript('fullcalendar.min.js') ?>

<?php use_javascript('reservation.js') ?>

<h1 class="partie">Calendrier des reservations de salles <i id="loading" class="fa fa-refresh fa-spin fa-lg pull-right"></i></h1>

<?php if ($userIdentified): ?> 
    <?php include_component('reservation','listeSalles', array('idSalle' => $idSalle)) ?>

    <!-- Est-ce qu'on garde ça ? Quel serait l'ID de la salle ? PB pour page avec id = "toutes les salles"...-->
    <?php if (!$ok): ?> 
	<?php if (isset($form) && $idSalle != -1): ?>
	    <div id="FormShape">
	    <form action="<?php echo url_for('reservation_process_form'/*reservation_salle',array('id' => $idSalle)*/) ?>" method="post" >
	    <div id=formResa1>

	    <legend> Réservation: </legend>
	    <table class=formTab>
		<tr>
		  <td class="CaseLabel">Date:</td> <td><?php echo $form['id_salle']->render(); echo $form['date']->render(); ?></td>
		</tr>
		<tr>
		  <td class="CaseLabel">De</td><td> <?php echo $form['heuredebut']->render() ?> à <?php echo $form['heurefin']->render() ?></td>
		</tr>
		<!-- Faire test si salle pôle ou salle BDE pour voir si besoin de demander l'asso-->		
		<tr>
		  <td class="CaseLabel"> Association:</td><td> <?php echo $form['id_asso']->render()?></td>
		</tr>
		<tr>
		  <td class="CaseLabel">Activite :</td><td> <?php echo $form['activite']->render()?></td>
		</tr>
	    </table>
	    </div>

	    <div id="sep"></div>

	    <div id=formResa2>
		<p> Nombre Personnes : </p><?php echo $form['nbPers']->render() ?>

		<?php echo $form['message']->renderRow() ?>
	      
		<p>
	    <input type="submit" name="submit" value="Envoyer" />
	    <input type="button" value="Annuler" onclick="$('#FormShape').fadeOut();" />
	    </p>
	    </div>

	    </form>
	    </div>

	<?php endif ?>

	<div id="calendar"></div>

	<script>
	$(document).ready(function() {
	  $("#calendar").fullCalendar({
	    
		dayClick: function(e)
		{
		
			if ($('#FormShape').length == 0) // Si le tableau == 0
			{
				alert ("Vous devez sélectionner une salle pour pouvoir effectuer une réservation.");
			}
			else
			{

				$('#resa-form_date_day').val(parseInt($.fullCalendar.formatDate( e, "dd")));
				$('#resa-form_date_month').val(parseInt($.fullCalendar.formatDate( e, "MM")));
				$('#resa-form_date_year').val(parseInt($.fullCalendar.formatDate( e, "yyyy")));
				$('#resa-form_heuredebut_hour').val(parseInt(e.getHours()));
				$('#resa-form_heuredebut_minute').val(parseInt(e.getMinutes())==30?"30":"00");
				
				
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

	<?php echo "<p>Réservation réalisée avec succès !</p>" ?>
	

    <?php endif; ?>
<?php else: ?>

  <center> Vous devez être connecté pour pouvoir accéder au planning des réservations. <a href="<?php echo url_for('cas')?>"> Connexion CAS. </a></center>

<?php endif; ?>
