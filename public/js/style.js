$(document).ready(function() {
	$('#logout-submit').on('click', function(event) {
		event.preventDefault();
		$("#form-logout").submit();
	});
});
