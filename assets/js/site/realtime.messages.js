

$(document).ready(function(){


	socket.on('snew_msg', function(data){

	//	alert(data['message'].receiver +' | '+userid);

		if(data['message'].receiver == userid){
			
			if (data['message'].sender == activeid){

				prependMsg(data);
				sendSound('stairs');
				messageRead(activeid);
			}else{

		//		alert('dito ako');
				getNotif();
				$('#usernotif'+data['message'].sender).html('<span class="badge">1</span>');
				sendSound('stairs');
			}

			

		}

		if (data['message'].sender != activeid){
			$('#usernofi'+data['message'].sender).html('<span class="badge">1</span>');
			//playSound('stairs');
		}

	});

	

});

