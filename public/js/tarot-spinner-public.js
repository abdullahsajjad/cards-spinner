(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(document).ready( function() {

		do_rotate();

		$('.item').css( 'animation', 'none' );
		$( '#tarot-container ' ).css( 'animation', 'none' );

		$( '.start-button' ).on( 'click', function(e){
			//e.preventDefault();
			if( $(this).hasClass( 'redirect' ) ) {
				window.location.href($( '.start-button' ).attr('href'));
			}


			$(this).addClass('redirect');
			e.preventDefault();
			if( $(this).html()  === 'Stop' ) {
				$(this).html('Start');
				$('.item').css( 'animation', 'none' );
				$( '#tarot-container ' ).css( 'animation', 'none' );
			} else {
				$(this).html('Stop');
				$('.tarot-spinner .item').css('animation', 'spin 5s linear infinite reverse');
				$('.tarot-spinner #tarot-container ').css('animation', 'spin 5s linear infinite');
				do_rotate();
			}

		} );


	} );

	function do_rotate() {
		var radius = 200; // adjust to move out items in and out
		var fields = $('.item'),
			container = $('#tarot-container'),
			width = container.width(),
			height = container.height();
		var angle = 0,
			step = (2 * Math.PI) / fields.length;
		fields.each(function() {
			var x = Math.round(width / 2 + radius * Math.cos(angle) - $(this).width() / 2);
			var y = Math.round(height / 2 + radius * Math.sin(angle) - $(this).height() / 2);
			if (window.console) {
				console.log($(this).text(), x, y);
			}
			$(this).css({
				left: x + 'px',
				top: y + 'px'
			});
			angle += step;
		});

	}
	function do_redirect(){
		window.location.replace(tarot_public.redirect_url);
	}

})( jQuery );
