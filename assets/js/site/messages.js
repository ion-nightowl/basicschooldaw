var activeid =	$('#contact-list a.active').attr('id').substr(5);

$(document).ready(function(){



	

	$('#contact-list').on('click', 'a', function() {
	    $('#contact-list a.active').removeClass('active');
	    $(this).addClass('active');
	    getmessages($(this).attr('id').substr(5));
	    activeid = $(this).attr('id').substr(5);
	    var id = $(this).attr('id');
	    $('#'+id+' span').html('');

	    messageRead(activeid);
	    getNotif();


	});


	getmessages(activeid);



	$('#chatform').on('submit', function(e){

		e.preventDefault();

		var body = $('#messagehere').val();

		var data = {receiver: activeid, message: escapeHtml(body)};

		if ($("#messagehere").val() != ''){

			$.ajax({

				type: "POST",
				url: base_url + "messages/newmessage",
				dataType: "JSON",
				data: data,

				success: function(data){
				
					$("#chatview").append(
														'<div class="chat-wrap" align="right">'+
															'<div class="chat-self">'+
																data['message'].body+
															'</div>'+
														'</div>'
													);

					realtimeNewmsg(data);

					$('#chatview').scrollTop($('#chatview')[0].scrollHeight);
					$('#messagehere').val('');

				}

			})

		}

	})
	

	

})


	