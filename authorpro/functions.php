<?php
/**
 * AuthorPro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AuthorPro
 */

if ( ! defined( 'AUTHORPRO_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'AUTHORPRO_VERSION', '1.0.0' );
}

if ( ! function_exists( 'authorpro_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function authorpro_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'authorpro', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'authorpro' ),
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'authorpro_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function authorpro_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'authorpro' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'authorpro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'authorpro_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function authorpro_scripts() {
	// Enqueue Google Fonts
    wp_enqueue_style( 'authorpro-fonts', 'https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400&family=Playfair+Display:wght@700&display=swap', array(), null );

    // Enqueue main stylesheet
	wp_enqueue_style( 'authorpro-style', get_stylesheet_uri(), array(), AUTHORPRO_VERSION );

    // Enqueue navigation script
    wp_enqueue_script( 'authorpro-navigation', get_template_directory_uri() . '/js/navigation.js', array(), AUTHORPRO_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'authorpro_scripts' );

/**
 * Include additional theme files.
 */
$authorpro_inc_dir = get_template_directory() . '/inc';

// Custom Post Types
require_once $authorpro_inc_dir . '/post-types.php';

// Custom Fields (Meta Boxes)
require_once $authorpro_inc_dir . '/custom-fields.php';

// Customizer additions
require_once $authorpro_inc_dir . '/customizer.php';

/**
 * Change comment labels to "Reviews" for the 'book' post type.
 */
function authorpro_change_comment_labels( $defaults ) {
    if ( get_post_type() === 'book' ) {
        $defaults['title_reply'] = __( 'Leave a Review', 'authorpro' );
        $defaults['label_submit'] = __( 'Submit Review', 'authorpro' );
        $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Review', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>';
    }
    return $defaults;
}
add_filter( 'comment_form_defaults', 'authorpro_change_comment_labels' );

function authorpro_change_comments_title( $title ) {
    if ( get_post_type() === 'book' ) {
        $title = str_replace( 'Comments', 'Reviews', $title );
        $title = str_replace( 'Comment', 'Review', $title );
    }
    return $title;
}
add_filter( 'get_comments_number_text', 'authorpro_change_comments_title' );
add_filter( 'comments_number', 'authorpro_change_comments_title' );

/**
 * Enqueue scripts for the admin area.
 */
function authorpro_admin_enqueue_scripts( $hook ) {
    global $post;
    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( isset($post->post_type) && 'book' === $post->post_type ) {
            wp_enqueue_editor();
        }
    }
}
add_action( 'admin_enqueue_scripts', 'authorpro_admin_enqueue_scripts' );
