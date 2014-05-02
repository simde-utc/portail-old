<?php use_stylesheet('fullcalendar.css') ?>

<?php use_javascript('fullcalendar.min.js') ?>

<?php use_javascript('reservation.js') ?>

<h1 class="partie">Calendrier des reservations de salles <i id="loading" class="fa fa-refresh fa-spin fa-lg pull-right"></i></h1>

<div id="exemple_fadein" style="display:none; z-index:10001; position: relative; height: 600px; width: 300px; background-color:LightYellow; ">
<form action="toto.php" method="post" >

<fieldset>
 <legend> Réservation: </legend>
    <p><b>Salle FE302 Jeudi 18 Mai de 8h à 10h </b></p>
    <p>Type de salle {Réunion | Musique | Salle des pôles}<br/><br/></p>
    <label for="email">Login :</label>
    <input type="email" name="email" size="20" maxlength="40" value="Automatique" id="email" />
      <label for="utilise">Nom de l'asso: </label>
   <select name="utilise" id="utilise">
    <option value="toujours"> Chargement</option>
    <option value="parfois"> Automatique</option>
    <option value="jamais"> Des associations de la personne</option>
   </select>
     <br/> 
     <p> Pôle concerné : XXX </p>
    
    <label for="email">Nombre de personnes:</label>
    <input type="email" name="email" size="20" maxlength="40" value="Automatique" id="email" />
    
    <label for="utilise">Activité: </label>
   <select name="utilise" id="utilise">
    <option value="toujours"> Liste</option>
    <option value="parfois"> à déterminer</option>
    <option value="jamais"> par BDE</option>
   </select>

  <label for="comments">Vos commentaires :</label>
   <textarea name="comments" id="comments" cols="20" rows="4">
   </textarea>
</fieldset>

 <p>
 <input type="submit" value="Envoyer" />
 <input type="button" value="Annuler" onclick="$('#exemple_fadein').fadeOut();" />
 </p>

</form>
</div>



<?php include_component('reservation','listeSalles', array('idSalle' => $idSalle)) ?>

<div id="calendar"></div>
<script>
$(document).ready(function() {
  $("#calendar").fullCalendar({
    
  	 dayClick: function(e)
  	 {
  	 	//alert("A day has been clicked" + e);
  	 	$('#exemple_fadein').fadeIn();
  	 },
  	 
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'agendaDay,agendaWeek'
    },
    editable: false,
    allDayDefault: false,
    events: "<?php echo url_for('reservations_json',array('sf_format'=>'json')) ?>",
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
    weekends: false,
    minTime: 8,
  });
});
</script>
