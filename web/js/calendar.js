	$(document).ready(function() {
	
		$('#calendar').fullCalendar({
		
			editable: true,
			
			events: "/event/index.json",
			
			eventDrop: function(event, delta) {
				alert(event.title + ' was moved ' + delta + ' days\n' +
					'(should probably update your database)');
			},
			
			loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			}
			
		});
		
	});
