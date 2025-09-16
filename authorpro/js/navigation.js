/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens.
 */
( function() {
	const siteNavigation = document.getElementById( 'site-navigation' );
	if ( ! siteNavigation ) {
		return;
	}

	const button = siteNavigation.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	button.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'toggled' );

        if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			button.setAttribute( 'aria-expanded', 'true' );
		}
	} );
}() );
