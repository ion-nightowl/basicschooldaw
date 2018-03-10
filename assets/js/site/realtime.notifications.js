


$(document).ready(function(){

	socket.on('snew_msg', function(data){
		timeago().render($('.date-post'));
		if(data['message'].receiver == userid){
			sendSound();
			getNotif();
		}
	});

});
