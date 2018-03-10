

$(document).ready(function(){


	$('.msg-toggle').on('click', function(){


	

	if ($('.fchat-box').css('height') == '380px'){
		$('.fchat-box').css('height','30px');
	}else{
		$('.fchat-box').css('height','380px');
	}

})

	$('.msg-close').on('click', function(){

		$('.fchat-box').css('display','none');

	})

});




function getNotif(){

	

	
}


