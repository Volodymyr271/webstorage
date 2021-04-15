$(function(){
    $('#menu a, #authWindow a').click(function() {
	$("#primaryContent").load($(this).attr('href'));
	return false;
    });

    $('#authorization').click(function() {
	$("#msgbox1").removeClass().addClass('messagebox').text('Checking...').fadeIn("slow");
	$.post(
            "PostOperations.php",
            {
                operation: 'authorization',
                login: $('#login').val(),
                password: $('#password').val()
            },
            function (response) {
                if (response) {
                    window.location = "stil.php";
                }
                else {
                    $("#msgbox1").fadeTo(200, 0.1, function() {
			$(this).html('Неверный логин или пароль').addClass('messageboxerror').fadeTo(900,1);
                    });
		}
            }
        );
    });

    $('body').on('click', '#registration', function() {
	$.post(
            "PostOperations.php",
            {
                operation: 'outsideReg',
                login: $('#regLogin').val(),
                password: $('#regPassword').val(),
                passwordRepeat: $('#regPasswordRepeat').val(),
                usersCode: $('#captcha').val()
            },
            function(response){
		$("#msgbox").fadeTo(200, 0.1, function() {
		$(this).html(response).addClass('messageboxerror').fadeTo(900,1 );
		});
            }
	);
    });
    $('body').on('click', '#restorePassword', function() {
        $.post(
            "PostOperations.php",
            {
                operation: 'newPassword',
                login: $('#restoreLogin').val()
            },
            function (response) {
                $("#msgbox2").fadeTo(200, 0.1, function() {
                $(this).html(response).addClass('messageboxerror').fadeTo(900,1 );
                });
            }
        );
    });
    $('#primaryContent').load('pages/home.html');
});
/*$(document).ready(function(){
	// Enable or leave the keys
	$('.slider').each(function(){
                var sliderDivWidth = $('div',this).width(),
                    lastTabWidth = $('li:last',this).width(),
                    lastTabOffset = $('li:last',this).offset().left,
                    firstTabOffset = $('li:first',this).offset().left;
		if (lastTabWidth + lastTabOffset - firstTabOffset > sliderDivWidth) {
			// enable the buttons
			$('button',this).css('display','inline');
			$('button.prev',this).css('visibility','hidden');
		}
	});


	$(".slider .next").click(function() {
		//Remove the exist selector
		//Set the width to the widest of either
		var sliderDiv = $('div',this.parentNode),
                    sliderDivWidth = sliderDiv.width(),
                    lastTabWidth = $('li:last', sliderDiv).width(),
                    lastTabOffset = $('li:last',sliderDiv).offset().left,
                    firstTabOffset = $('li:first',sliderDiv).offset().left,
                    maxoffset = lastTabWidth + lastTabOffset - firstTabOffset - sliderDivWidth,
                    offset = Math.abs(parseInt( $('ul',sliderDiv).css('marginLeft') ));
		if( offset >= maxoffset )
			return;
		else if ( offset + sliderDivWidth >= maxoffset ){
			sliderDivWidth = maxoffset - offset + 20;
			// Hide this
			$(this).css('visibility','hidden');
		}
		// enable the other
		$('.prev', this.parentNode).css('visibility','visible');

		$("ul", $(this).parent() ).animate({
			marginLeft: "-=" + sliderDivWidth
		},400, 'swing');
	});

	$(".slider .prev").click(function(){

		var offset = Math.abs(parseInt( $('ul',this.parentNode).css('marginLeft') ));
		var sliderDivWidth = $('div',this.parentNode).width();
		if( offset <= 0 )
			return;
		else if ( offset - sliderDivWidth <= 0 ){
			$(this).css('visibility','hidden');
			sliderDivWidth = offset;
		}
		$('.next', this.parentNode).css('visibility','visible');

		$("ul",$(this).parent()).animate({
			marginLeft: '+='+sliderDivWidth
		},400, 'swing');
	});
});*/
