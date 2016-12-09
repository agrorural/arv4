(function($) {
	var dirSearch = $('#directorio-search');
	var formSearch = dirSearch.find('form');

	formSearch.submit(function(e){
		e.preventDefault();

		data = {
			action: "directory_map",
			grupos: dirSearch.find("#optSede").val()
		};

		$.ajax({
			type: 'GET',
			url: ajax_url,
			data: data,
			dataType: 'json',
			success: function(response){
				dirSearch.find('#directoryContent').empty();

				for (var i = 0; i < response.length; i++) {
					var html = '<article>' + 
									'<h3>' + response[i].title + '</h3>' +
									'<h6>' + response[i].dir_cargo + '</h6>' +
									'<h4>' + response[i].dir_responsable + '</h4>' +
									'<small>' + response[i].dir_direccion + '</small><br />' +
									'<small>' + response[i].dir_telefono + '</small><br />' +
									'<small><a href="mailto:' + response[i].dir_correo + '">'+ response[i].dir_correo + '</a></small>' +
								'</article>';

					dirSearch.find('#directoryContent').append(html);
					//console.log(response[i].dir_correo); 
				}

					//console.log(response[i].title);		
			}
		});	 
	});
})(jQuery); // Fully reference jQuery after this point.