$(document).ready(function() {

	

	

	$('#view-register').on('click', function(){

		$('#login-view').hide();
		$('#register-view').show();

	});

	$('#view-login').on('click', function(){

		$('#login-view').show();
		$('#register-view').hide();

	});

	$('#login-form').on('submit', function(e){

		e.preventDefault();

		var data = $("#login-form").serialize();

		$.ajax({

			type: "POST",
			dataType: "JSON",
			url: base_url + 'auth/login',
			data: data,

			success: function(data){

				
				if (data['code']==1){
					window.location.href ='home';
				}else{
					$('#error_msg').html(data['msg']);
				}
			}


		});

	});


	$('#register-form').on('submit', function(e){

		e.preventDefault();
		var data = $('#register-form').serialize();

		$.ajax({

			type: "POST",
			dataType: "JSON",
			url: base_url + 'auth/register',
			data: data,

			success: function(data){

				
				if (data['code']==2){
					$('#error_msgx').css('color','#55efc4');
					$('#error_msgx').html(data['msg']);
					$('#register-form')[0].reset();
				}else{
					
					$('#error_msgx').html(data['msg']);
				}
			}
		});


	});

})