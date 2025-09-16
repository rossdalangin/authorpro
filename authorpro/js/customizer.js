/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Homepage: Hero Section Headline
	wp.customize( 'authorpro_hero_headline', function( value ) {
		value.bind( function( to ) {
			$( '.hero-section .hero-headline' ).text( to );
		} );
	} );

	// Homepage: Hero Section Tagline
	wp.customize( 'authorpro_hero_tagline', function( value ) {
		value.bind( function( to ) {
			$( '.hero-section .hero-tagline' ).html( to );
		} );
	} );

	// Homepage: Featured Book Headline
	wp.customize( 'authorpro_featured_book_headline', function( value ) {
		value.bind( function( to ) {
			$( '.featured-book-section .section-headline' ).text( to );
		} );
	} );

	// Homepage: Upcoming Events Headline
	wp.customize( 'authorpro_events_headline', function( value ) {
		value.bind( function( to ) {
			$( '.upcoming-events-section .section-headline' ).text( to );
		} );
	} );

	// Homepage: From the Blog Headline
	wp.customize( 'authorpro_blog_headline', function( value ) {
		value.bind( function( to ) {
			$( '.from-the-blog-section .section-headline' ).text( to );
		} );
	} );

	// Homepage: Newsletter CTA Headline
	wp.customize( 'authorpro_newsletter_headline', function( value ) {
		value.bind( function( to ) {
			$( '.newsletter-cta-section .section-headline' ).text( to );
		} );
	} );

    // Homepage: Newsletter CTA Text
	wp.customize( 'authorpro_newsletter_text', function( value ) {
		value.bind( function( to ) {
			$( '.newsletter-cta-section .newsletter-text' ).html( to );
		} );
	} );

} )( jQuery );
