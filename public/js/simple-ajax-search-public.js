(function( $ ) {
	'use strict';

	$( window ).load(
		function() {

			ajaxSearch();
			$( '#search' ).on( 'input', ajaxSearch );
			$( '.sas-custom-check' ).on( 'click', ajaxSearch );

			function ajaxSearch(){

				var input = $( '#search' ).val(),
				catIDs    = [],
				postData  = {
					action: 'simple_ajax_search',
					nonce: ajax_object_search.nonce,
					search: input,
					categories: [],
				}

				$( '.sas-custom-check' ).each(
					function() {
						if ( $( this ).prop( 'checked' ) ) {
							$( this ).next().css( 'background', ajax_object_search.color_2 );
							postData.categories.push( parseInt( $( this ).attr( 'id' ) ) );
						} else {
							$( this ).next().css( 'background', ajax_object_search.color_3 );
							$( '#cat_' + parseInt( $( this ).attr( 'id' ) ) ).remove();
						}
					}
				);

				jQuery.ajax(
					{
						url: ajax_object_search.ajax_url,
						type: 'POST',
						data: postData
					}
				).done(
					function( response ){

						if ( response ) {

								$( '#not_found' ).remove();

								$.each(
									response, function( index , object ) {

										catIDs.push( parseInt( index ) );

										if ( $( '#cat_' + index ).length > 0 ) {

											$( '#cat_' + index ).find( '.row' ).html( '' );

											var output = '';

											$.each(
												object, function( index , item ) {
													output += '<div class="row"><span class="dashicons ' + ajax_object_search.dashicons + '"></span>';
													output += '<a ' + ajax_object_search.target + ' href="' + item.link + '">';
													output += item.title;
													output += '</a></div>';
												}
											);

											$( '#cat_' + index ).append( output );

										} else {

											var output = '<div id="cat_' + index + '" class="cat_box">';
											output    += '<div class="cat_title" style="background:' + ajax_object_search.color_1 + ';">';
											output    += '<p>' + object[0].category + '</p>';
											output    += '</div>';

											$.each(
												object, function( index , item ) {

													output += '<div class="row"><span class="dashicons ' + ajax_object_search.dashicons + '"></span>';
													output += '<a ' + ajax_object_search.target + ' href="' + item.link + '">';
													output += item.title;
													output += '</a></div>';
												}
											);

											output += '</div>';
											$( '#sas-result' ).append( output );

										}

									}
								);

								$( '.sas-custom-check' ).each(
									function() {
										if ( $.inArray( parseInt( $( this ).attr( 'id' ) ), catIDs ) == -1 ) {
											$( '#cat_' + parseInt( $( this ).attr( 'id' ) ) ).remove();
										}
									}
								);

						} else {
							$( '#sas-result' ).html( '' );
							$( "#sas-result" ).append( ajax_object_search.cta );
						}

					}
				);

			}

		}
	);

})( jQuery );
