var app = {
	init: function() {
		$('#refresh-button').on('click', app.getFortuneMessage);
	},

	getFortuneMessage: function() {
		$.ajax({
			url: 'ajax/generate-message',
			success: function(message) {
				$('#fortune-message').text(message);
			}
		});
	}
};

$(app.init);