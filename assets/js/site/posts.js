var gon = '';
var activeedit = '';
$(document).ready(function(){

	timeago().render($('.date-post'));
	$('#newpost').on('submit',function(e){

		e.preventDefault();

		var postbody = $.trim($('#postbody').val());

		var data = {'postbody': escapeHtml(postbody)};

		if ($('#postbody').val() != ''){

			
			$.ajax({

				type: 'POST',
				url: base_url + 'posts/newpost',
				dataType: 'JSON',
				data: data,

				success: function(data){
					$('#postbody').val('');
					prependPost(data);
					realtimepost(data);
				}

			});
		}

	});

	

	$(document).on('click', '.deletepost', function(){

		var postid = $(this).attr('id').substr(6);

		swal({
		  title: 'Burahin ang post?',
		  text: "Hindi mo na maaring ibalik pa!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Burahin',
		  cancelButtonText: 'Kanselahin'
		}).then((result) => {
		  if (result.value) {

		  	var data 		= {postid: postid};
		  	var controller	= "posts/deletepost";
		  	var success = function(){
		  		var data = {'postid': postid, 'userid': userid}
		  		realtimedeletePost(data);
				$('#post-'+postid).remove();
					swal(
				      'Deleted!',
				      'Post Deleted',
				      'success'
				    )

			}

		  	ajaxCall(controller, data, success);
		    
		  }
		})

		

	});

	$(document).on('click', '.editpost', function(){

		$('this').prop('disabled', true);
		var id = $(this).attr('id').substr(4);

		var innerdata = $('#editpost-'+id).html();
		activeedit = id;

		$('#editpost-'+id).hide();

		$('#editholder-'+id).html(

			"<textarea id=\"editpostarea"+id+"\" class=\"form-control editpostarea\" rows=\"7\" style=\"overflow-y: hidden;resize: none;\" >" +
				innerdata +
			"</textarea>");
			var editbody = document.getElementById('editpostarea'+activeedit);

			var len = $("#editpostarea"+id).val().length;

			//$("#editpostarea"+id).focus();
			//$("#editpostarea"+id).setSelectionRange(len, len);

			$("#editpostarea"+id).on("focus", function() { // could be on any event
			    $("#editpostarea"+id).putCursorAtEnd()
			  });

			editbody.onkeydown = function (event) {

			var postid		= id;
			var postbody	= $("#editpostarea"+id).val();

		    if (event.defaultPrevented) {
		       return;
		    }
		    var handled = false;
		    if (event.key !== undefined) {
		       if (event.key === 'Enter' && event.altKey) {
		          //$('#newpost').submit(); 
		          editPost(postid,postbody);
		       }
		    } else if (event.keyIdentifier !== undefined) {
		       if (event.keyIdentifier === "Enter" && event.altKey) {
		         // $('#newpost').submit(); 
		         editPost(postid,postbody);
		       }

		    } else if (event.keyCode !== undefined) {
		       if (event.keyCode === 13 && event.altKey) {
		         // $('#newpost').submit(); 
		         editPost(postid,postbody);
		       }
		    }
		    if (handled) {
		       event.preventDefault();
		    };
		};

	})

	$(document).mouseup(function(e) 
	{
	    var container = $(".editpostarea");

	    // if the target of the click isn't the container nor a descendant of the container
	    if (!container.is(e.target) && container.has(e.target).length === 0) 
	    {
	    	$('#editpost-'+activeedit).show();
	       container.hide();
	    }
	});

	
	

	

	var postbody = document.getElementById('postbody');
	postbody.onkeydown = function (event) {
	    if (event.defaultPrevented) {
	       return;
	    }
	    var handled = false;
	    if (event.key !== undefined) {
	       if (event.key === 'Enter' && event.altKey) {
	          $('#newpost').submit();
	       }
	    } else if (event.keyIdentifier !== undefined) {
	       if (event.keyIdentifier === "Enter" && event.altKey) {
	          $('#newpost').submit();
	       }

	    } else if (event.keyCode !== undefined) {
	       if (event.keyCode === 13 && event.altKey) {
	          $('#newpost').submit();
	       }
	    }
	    if (handled) {
	       event.preventDefault();
	    };
	};




	$(document).on('click','.chip', function(){
	
		var conid = $(this).attr('id');
		$('.fchat-box').css('height','380px');
		gon = conid;
		getNotif();
		getmessages(conid);
		messageRead(gon);

		$('#chat-box-stat').css('color',$(`#${conid} i`).css('color'));
		
		var chatname = $('#'+conid+' span').html();

		$('#fchat-name').html(chatname);
		$('.fchat-box').show();

	})

	$('#fchat').on('submit', function(e){

		e.preventDefault();

		var body = $('#messagehere').val();

		var data = {receiver: gon, message: escapeHtml(body)};

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

	});


	socket.on('snew_msg', function(data){

	//	alert(data['message'].receiver +' | '+userid);

		if(data['message'].receiver == userid){
			
			if (data['message'].sender == gon){

				prependMsg(data);
				sendSound('stairs');
				messageRead(gon);
				getNotif();
			}else{

		//		alert('dito ako');
				getNotif();
				sendSound('stairs');
			}

			

		}

		if (data['message'].sender != gon){
			
			getNotif();
			
			$('#usernofi'+data['message'].sender).html('<span class="badge">1</span>');
			//playSound('stairs');
		}

	});


	$('#viewcontacts').on('click', function(){

		if ($('.online-div').css('display') == 'none'){
			
			$('.online-div').show();
			
		}else{
			$('.online-div').hide();
		}

		
	});

}); // END


