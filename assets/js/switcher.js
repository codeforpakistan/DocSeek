/* color-palette */
(function ($) {
	$(document).ready(function($) {
		$('#palette').animate({
			left: '-185px'
		});
			$('.color-click').click(function(e){
			e.preventDefault();
				var div = $('#palette');
				console.log(div.css('left'));
				if (div.css('left') === '-185px') {
				$('#palette').animate({
					left: '0px'
				});
			}else {
				$('#palette').animate({
					left: '-185px'
				});
			}
		})
			if($.cookie("css")) {
			$("link#main-style").attr("href",$.cookie("css"));
		}

		if ($.cookie('bgpattern')) {
			$('body').addClass($.cookie('bgpattern'));
		}

		$("#bgsolid li a").click(function(e) {
			e.preventDefault();
			$(this).parent().parent().find('a').removeClass('active');
			$(this).addClass('active');
			$("link#main-style").attr("href",
			$(this).attr('href'));
			$.cookie("css",
			$(this).attr('href'));
			return false;
		});

			$("#bg li a").click(function(e) {
			e.preventDefault();
				 if (!$('body').hasClass($(this).attr('class'))) {
				$('body').removeClass($.cookie('bgpattern'));
                    $('body').addClass($(this).attr('class'));
                    $.cookie('bgpattern',
				$(this).attr('class'));
			}
		});

			$("#palette .reset").click(function() {
			$('body').removeClass($.cookie('bgpattern'));
            	 $('#main-style').attr('href',null);
            	 $.removeCookie('css');
                 $.removeCookie('bgpattern');
		});
	});
})(jQuery);