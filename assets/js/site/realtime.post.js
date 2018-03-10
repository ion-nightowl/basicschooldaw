$(document).ready(function(){


	socket.on('snew_post', function(data){
		timeago().render($('.date-post'));
		if(data.userid != userid){
			prependPost(data);
			
		}

	});

	socket.on('sedit_post', function(data){
		if(data.userid != userid){
			editPostUpdate(data);
			
		}

	});

	socket.on('sdelete_post', function(data){
		if(data.userid != userid){
			deletePost(data);
			
		}

	});

	

});

