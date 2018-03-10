var socket = io.connect('http://localhost:8080',{query: 'userid='+userid});	


function getmessages(activeid){

		$.ajax({

			type: 'POST',
			url: base_url + 'messages/getmessage/'+activeid,
			dataType: 'JSON',

			success: function(data){
				
				if (data == 0){
					$('#chatview').html('<div style="text-align: center">'+
						'<i class="fab fa-earlybirds" style="font-size: 300px;"></i>'+
						'<br>'+
						'<h2 style="font-family: Font Awesome\ 5 Brands;">Ooooops. no messages yet</h2>'+
					'</div>');
				}else{

					$('#chatview').html('');
					data['messages'].forEach(function(msg){

						if (msg.sender == userid){

							$("#chatview").append(
													'<div class="chat-wrap" align="right">'+
														'<div class="chat-self">'+
															msg.message_body+
														'</div>'+
													'</div>'
												);

						}else{

							$("#chatview").append(
													'<div class="chat-wrap">'+
														' <img src="'+base_url+'assets/images/user.jpg" class="chat-avatar" height="30px" width="30px" data-toggle="tooltip" title="' +
														data['userinfo']['fname']+' '+data['userinfo']['mname']+' '+data['userinfo']['lname']+'">'+
														'<span class="chat-name">'+
															data['userinfo']['fname']+' '+data['userinfo']['mname']+' '+data['userinfo']['lname']+
														'</span><br>'+
														'<div class="chat-bubble">'+
															'<div class="chat-text">'+
																'<p>'+ msg.message_body + '</p>' +
															'</div>'+
														'</div>'+
													'</div>'
												);


						}

					});

					$('#chatview').scrollTop($('#chatview')[0].scrollHeight);
				}

			}

		});

	}





function escapeHtml(text) {
		  return text
		      .replace(/&/g, "&amp;")
		      .replace(/</g, "&lt;")
		      .replace(/>/g, "&gt;")
		      .replace(/"/g, "&quot;")
		      .replace(/'/g, "&#039;");
}


function messageRead(id){

	$.ajax({

		type: "POST",
		url: base_url + "messages/messageRead/"+id,
		dataType: "JSON",

		success: function(){
			
		}


	});

}

function realtimeNewmsg(data){

		socket.emit('cnew_msg', data);

}

function playSound(filename){   
    document.getElementById("sound").innerHTML='<audio autoplay="autoplay"><source src="'+ base_url+ 'assets/' + filename + '.mp3" type="audio/mpeg" /><source src="' + filename + '.ogg" type="audio/ogg" /><embed hidden="true" autostart="true" loop="false" src="' + filename +'.mp3" /></audio>';
}


//MSG


	
function realtimepost(data){

		socket.emit('cnew_post', data);

}

//POST


function sendSound(){
	playSound('stairs');
}


function getNotif(){



	$.ajax({

		type: "POST",
		url: base_url + "notifications/getNotif",
		dataType: "JSON",

		success: function(data){
			console.log(data);

			if (data!=0){
				$('#msgnotifbody').html('');

				$('#msgnotif').html(data.notifcount);
				var x = 0;

				data['messages'].forEach(function(msg){
					$('#msgnotifbody').append(
						
						"<li><a href=\"#\">"+
						"<label>"+ data['senderinfo'][x]['fname'] + "</label><br>"+
						msg.message_body+
						"</a></li>");

					x = x+1;
				});

				$('#msgnotifbody').append(
								"<li class=\"divider\"></li>"+
								"<li><a href=\""+base_url+"messages\">See all messages</a></li>");



			}else{
				$('#msgnotifbody').html('');
				$('#msgnotif').html('');
				$('#msgnotifbody').append(
								"<li><a href=\"messages\">No new messages</a></li>"+
								"<li class=\"divider\"></li>"+
								"<li><a href=\""+base_url+"messages\">See all messages</a></li>");

			}
		}

	});
}



function playSound(filename){   
    document.getElementById("sound").innerHTML='<audio autoplay="autoplay"><source src="'+ base_url+ 'assets/' + filename + '.mp3" type="audio/mpeg" /><source src="' + filename + '.ogg" type="audio/ogg" /><embed hidden="true" autostart="true" loop="false" src="' + filename +'.mp3" /></audio>';
}



function editPost(postid, postbody){

	var data 		= {"postid" : postid, "postbody" : postbody};
	var controller	= 'posts/editpost';

	var onsuccess	= function(){

		var data 		= {"postid" : postid, "postbody" : postbody, "userid" : userid};
		editPostUpdate(data);
		realtimeeditPost(data)
	}

	ajaxCall(controller, data, onsuccess);

}



function ajaxCall(controller, data, onsuccess, onerror = '', onfailure = ''){

	$.ajax({

		type 	 : "POST",
		url 	 : base_url + controller,
		dataType : "JSON",
		data 	 : data,
		
		success	 : function(data){
			onsuccess(data);
		},
		error	 : function(data){
			onerror();
		},
		failure	 : function(data){
			onfailure();
		},

	});


}

function realtimeeditPost(data){

	socket.emit('cedit_post', data);
}

function realtimedeletePost(data){
	socket.emit('cdelete_post', data);
}

function deletePost(data){
	$('#post-'+data.postid).remove();
}

jQuery.fn.putCursorAtEnd = function() {

  return this.each(function() {
    
    // Cache references
    var $el = $(this),
        el = this;

    // Only focus if input isn't already
    if (!$el.is(":focus")) {
     $el.focus();
    }

    // If this function exists... (IE 9+)
    if (el.setSelectionRange) {

      // Double the length because Opera is inconsistent about whether a carriage return is one character or two.
      var len = $el.val().length * 2;
      
      // Timeout seems to be required for Blink
      setTimeout(function() {
        el.setSelectionRange(len, len);
      }, 1);
    
    } else {
      
      // As a fallback, replace the contents with itself
      // Doesn't work in Chrome, but Chrome supports setSelectionRange
      $el.val($el.val());
      
    }

    // Scroll to the bottom, in case we're in a tall textarea
    // (Necessary for Firefox and Chrome)
    this.scrollTop = 999999;

  });

};



// PREPENDS


function editPostUpdate(data){

	$(`#editpost-${data.postid}`).html(data.postbody);
	$(`#editpost-${data.postid}`).show();
	$(".editpostarea").hide();

}


function prependPost(data){

	$('#posts').prepend(
						`<div class="post-div" id="post-${data.postid}">`+
							'<div class="row">'+
								'<div class="dropdown delete-post">'+
									'<a class="dropdown-toggle" data-toggle="dropdown" href="#">'+
									'<b><i class="fas fa-caret-down fa-lg"></i></b>'+
									'<ul class="dropdown-menu dropdown-menu-right">'+
										`<li class="editpost" id="edit${data.postid}"><a>Edit</a></li>`+
										`<li class="deletepost" id="delete${data.postid}"><a href="#">Delete</a></li>`+
									'</ul>'+
								'</div>' +
								'<div class="col-md-2 col-xs-3 inline">'+
									'<a href="#">'+
										'<img src="'+base_url+'assets/images/user.jpg" class="post-img">'+
									'</a>'+
								'</div>' +
								'<div class="col-md-9 col-xs-6 inline">'+
									'<div class="post-name">'+
										data.name +
									'</div>' +
									'<div class="post-date">'+
										"<span class=\"date-post\" datetime=\""+data.date+"\">"+data.date + "</span>"+
									'</div>' +
								'</div>' +
							'</div>' +
							'<div class="post-body">'+
								'<div class="editbody" id="editpost-'+data.postid+'">'+
									data.body +
								'</div>'+
								'<div id="editholder-'+data.postid+'">'+
								'</div>' +
							'</div>' +
							'<div class="post-btn">'+
								'<b><i class="far fa-heart fa-lg"></i> Like</b> &nbsp; &nbsp; <b><i class="far fa-comment fa-lg"></i> Comment</b>'+
							'</div>' +
							'<div class="post-comment">'+
								'<input type="text" name="" class="form-control" placeholder="Write your comment here">' +
							'</div>' +
						'</div>'
						);

}


function prependMsg(data){


	$("#chatview").append(
				'<div class="chat-wrap">'+
					' <img src="'+base_url+'assets/images/user.jpg" class="chat-avatar" height="30px" width="30px" data-toggle="tooltip" title="' +
					data['userinfo']['fname']+' '+data['userinfo']['mname']+' '+data['userinfo']['lname']+'">'+
					'<span class="chat-name">'+
						data['userinfo']['fname']+' '+data['userinfo']['mname']+' '+data['userinfo']['lname']+
					'</span><br>'+
					'<div class="chat-bubble">'+
						'<div class="chat-text">'+
							'<p>'+data['message'].body + '</p>' +
						'</div>'+
					'</div>'+
				'</div>'
			);
	$('#chatview').scrollTop($('#chatview')[0].scrollHeight);
}