(function( $ ) {

	$(document).ready( function() {
		const tag_area 		= $( '.ff_tags_area' );
		const tarot_button 	= $( '#ff-button' );
		const tags			= '.tag span';
		var   tags_arr		= [];
		const result_div	= $('.tagsinput');
		const loader	  	= '<img src="'+ tarot_ajax.loadingimage +'" alt="loader" class="ff-loader">';

		/**
		 * Tags input for form
		 * */
		tag_area.tagsInput({
			'height':'200px',
			'width':'500px',
			'interactive':true,
			'defaultText':'Add New URL',
			'delimiter': [','],   // Or a string with a single delimiter. Ex: ';'
			'removeWithBackspace' : false,
			'minChars' : 0,
			'maxChars' : 0, // if not provided there is no limit
		});

		/**
		 * Event listener on button
		 * */
		tarot_button.on( 'click' ,function ( event ){
			save_tags_as_options( event );
		} );


		/**
		 * getting options from tarot_ajax object
		 * */

		$(window).on('load',function() {
			tag_area.importTags(tarot_ajax.tags);
		});

		/**
		 * get tags from DOM and stors them in an array( tags_arr )
		 * */
		function get_tags() {
			$( tags ).each(function(index ,item){
				tags_arr[index] = $(item).text().trim();
			}  )
		}

		/**
		* Sends Ajax requests to save tabs in options table
		* */
		function save_tags_as_options( event ) {
			event.preventDefault();
			get_tags();		// stores tags in tag_arr
			$.ajax({
				url: tarot_ajax.ajaxurl,
				type: 'post',
				data: {
					// a function defined in class-tarot-spinner-admin.php hooked to this action (with `wp_ajax_nopriv_` and/or `wp_ajax_` prefixed) will run.
					action: 'tarot_from_callback',
					tags: tags_arr,
					nonce: tarot_ajax.ajax_nonce
				},
				beforeSend: function () {
					tarot_button.attr('disabled',true);

				},
				success: function ( response ) {
					tarot_button.attr('disabled',false);
					if( response.code === 200 ) {
						$('.tarot-notice').css('display','block');
					} else {
						alert( 'Something Went Wrong' );
					}
				}
			})
		}

	} );

})( jQuery );
