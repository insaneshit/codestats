$(document).ready(function() {
	$('.btn-track').click(function() {
		window.location.href = '/'+$('.track').val();
	});
});