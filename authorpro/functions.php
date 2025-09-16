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
			'name'          => esc_html__( 'Footer Column 1', 'authorpro' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'authorpro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 2', 'authorpro' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'authorpro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 3', 'authorpro' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'authorpro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 4', 'authorpro' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here.', 'authorpro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Blog Sidebar', 'authorpro' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here for your blog.', 'authorpro' ),
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
    wp_enqueue_style( 'authorpro-fonts', 'https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@700&display=swap', array(), null );

    // Enqueue main stylesheet
	wp_enqueue_style( 'authorpro-style', get_stylesheet_uri(), array(), AUTHORPRO_VERSION );

    // Enqueue navigation script
    wp_enqueue_script( 'authorpro-navigation', get_template_directory_uri() . '/js/navigation.js', array(), AUTHORPRO_VERSION, true );

    // Enqueue scripts for masonry blog layout
    if ( is_home() || is_archive() ) {
        wp_enqueue_script( 'imagesloaded', 'https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'authorpro-load-more', get_template_directory_uri() . '/js/load-more.js', array('jquery', 'masonry'), AUTHORPRO_VERSION, true );

        // Pass data to the script
        global $wp_query;
        wp_localize_script( 'authorpro-load-more', 'authorpro_loadmore_params', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'posts' => json_encode( $wp_query->query_vars ),
            'current_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
            'max_page' => $wp_query->max_num_pages
        ) );
    }
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

/**
 * AJAX handler for loading more posts.
 */
function authorpro_loadmore_ajax_handler(){

	// prepare our arguments for the query
	$params = json_decode( stripslashes( $_POST['query'] ), true ); // query_vars from the original query
	$params['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$params['post_status'] = 'publish';

	// it is always better to use WP_Query but not get_posts.
	$query = new WP_Query( $params );

	if( $query->have_posts() ) :
		// run the loop
		while( $query->have_posts() ): $query->the_post();
			get_template_part( 'template-parts/content', 'archive' );
		endwhile;
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
add_action('wp_ajax_loadmore', 'authorpro_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmore', 'authorpro_loadmore_ajax_handler');
