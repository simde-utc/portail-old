$(function() {
	var url = $("#search").parents('form').attr('action');

	$("#search").autocomplete({
		source: function( request, response ) {
			$.ajax({
				url: url,
				dataType: "json",
				data: {
					query: request.term + '*' 
				},
				success: function( data ) {
					console.log('ok');
					response( $.map( data, function( item ) {
						return {
							label: item.name,
							url: item.url
						}
					}));
				}
			});
		},
		minLength: 3,
		select: function( event, ui ) {
			if(ui.item) window.location = ui.item.url;
			else alert('no');
		},
		open: function() {
			$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		},
		close: function() {
			$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
		}
	});
});