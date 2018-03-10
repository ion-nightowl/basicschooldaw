$(document).ready(function(){


	socket.on('set online', function(data){
		
		if(data != userid){

			$(`#status${data}`).css('color','#32ff7e');

			if (gon == data){
				$('#chat-box-stat').css('color','#32ff7e');
			}	
		}

	});
	
	socket.on('set offline', function(data){
		
		if(data != userid){

			$(`#status${data}`).css('color','#b2bec3');

			if (gon == data){
				$('#chat-box-stat').css('color','#b2bec3');
			}
		}

	});

});

