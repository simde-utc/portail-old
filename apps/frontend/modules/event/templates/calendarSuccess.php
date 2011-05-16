<?php use_stylesheet('fullcalendar.css') ?>
<?php use_stylesheet('calendar.css') ?>

<?php use_javascript('fullcalendar.min.js') ?>

<div id='loading' style='display:none'>loading...</div>
<div id='calendar'></div>
<script>
	$(document).ready(function() {
	
		$('#calendar').fullCalendar({
      header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
			editable: false,
      allDayDefault: false,
			
			events: "<?php echo url_for("/json/event/index") ?>",
			
			loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			}
			
		});
		
	});
</script>
