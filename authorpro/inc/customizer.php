<?php
/**
 * AuthorPro Theme Customizer
 *
 * @package AuthorPro
 */

/**
 * Helper function to get a list of books for the Customizer control.
 * @return array
 */
function authorpro_get_books_list() {
    $books = get_posts( array( 'post_type' => 'book', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC' ) );
    $options = array( '' => __( '-- Select a Book --', 'authorpro' ) );
    if ( $books ) {
        foreach ( $books as $book ) {
            $options[ $book->ID ] = esc_html( $book->post_title );
        }
    }
    return $options;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function authorpro_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

    // --- Homepage Sections Panel ---
    $wp_customize->add_panel( 'authorpro_homepage_panel', array( 'title' => __( 'Homepage Sections', 'authorpro' ), 'priority' => 10 ) );

    // --- Helper function for section controls ---
    $add_section_controls = function( $section_id, $default_order ) use ( $wp_customize ) {
        $wp_customize->add_setting( "authorpro_{$section_id}_show", array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
        $wp_customize->add_control( "authorpro_{$section_id}_show", array( 'label' => __( 'Show this section', 'authorpro' ), 'section' => "authorpro_{$section_id}_section", 'type' => 'checkbox' ) );
        $wp_customize->add_setting( "authorpro_{$section_id}_order", array( 'default' => $default_order, 'sanitize_callback' => 'absint' ) );
        $wp_customize->add_control( "authorpro_{$section_id}_order", array( 'label' => __( 'Display Order', 'authorpro' ), 'section' => "authorpro_{$section_id}_section", 'type' => 'number' ) );
    };

    // --- Hero Section ---
    $wp_customize->add_section( 'authorpro_hero_section', array( 'title' => __( 'Hero Section', 'authorpro' ), 'panel' => 'authorpro_homepage_panel' ) );
    $add_section_controls( 'hero', 10 );
    $wp_customize->add_setting( 'authorpro_hero_headline', array( 'default' => get_bloginfo( 'name' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'authorpro_hero_headline', array( 'label' => __( 'Headline', 'authorpro' ), 'section' => 'authorpro_hero_section' ) );
    $wp_customize->add_setting( 'authorpro_hero_tagline', array( 'default' => 'Stories that stay with you long after the last page.', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'authorpro_hero_tagline', array( 'label' => __( 'Tagline / Bio', 'authorpro' ), 'section' => 'authorpro_hero_section', 'type' => 'textarea' ) );
    $wp_customize->add_setting( 'authorpro_hero_image', array( 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'authorpro_hero_image', array( 'label' => __( 'Author Photo', 'authorpro' ), 'section' => 'authorpro_hero_section' ) ) );

    // --- Featured Book Section ---
    $wp_customize->add_section( 'authorpro_featured_book_section', array( 'title' => __( 'Featured Book', 'authorpro' ), 'panel' => 'authorpro_homepage_panel' ) );
    $add_section_controls( 'featured_book', 20 );
    $wp_customize->add_setting( 'authorpro_featured_book_headline', array( 'default' => __( 'My Latest Novel', 'authorpro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'authorpro_featured_book_headline', array( 'label' => __( 'Section Headline', 'authorpro' ), 'section' => 'authorpro_featured_book_section' ) );
    $wp_customize->add_setting( 'authorpro_featured_book_id', array( 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'authorpro_featured_book_id', array( 'label' => __( 'Select Book to Feature', 'authorpro' ), 'section' => 'authorpro_featured_book_section', 'type' => 'select', 'choices' => authorpro_get_books_list() ) );

    // --- Upcoming Events Section ---
    $wp_customize->add_section( 'authorpro_events_section', array( 'title' => __( 'Upcoming Events', 'authorpro' ), 'panel' => 'authorpro_homepage_panel' ) );
    $add_section_controls( 'events', 30 );
    $wp_customize->add_setting( 'authorpro_events_headline', array( 'default' => __( 'Upcoming Events', 'authorpro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'authorpro_events_headline', array( 'label' => __( 'Section Headline', 'authorpro' ), 'section' => 'authorpro_events_section' ) );

    // --- From The Blog Section ---
    $wp_customize->add_section( 'authorpro_blog_section', array( 'title' => __( 'From The Blog', 'authorpro' ), 'panel' => 'authorpro_homepage_panel' ) );
    $add_section_controls( 'blog', 40 );
    $wp_customize->add_setting( 'authorpro_blog_headline', array( 'default' => __( 'From The Blog', 'authorpro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'authorpro_blog_headline', array( 'label' => __( 'Section Headline', 'authorpro' ), 'section' => 'authorpro_blog_section' ) );

    // --- Newsletter CTA Section ---
    $wp_customize->add_section( 'authorpro_newsletter_section', array( 'title' => __( 'Newsletter CTA', 'authorpro' ), 'panel' => 'authorpro_homepage_panel' ) );
    $add_section_controls( 'newsletter', 50 );
    $wp_customize->add_setting( 'authorpro_newsletter_headline', array( 'default' => __( 'Join My Reader\'s Circle', 'authorpro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'authorpro_newsletter_headline', array( 'label' => __( 'CTA Headline', 'authorpro' ), 'section' => 'authorpro_newsletter_section' ) );
    $wp_customize->add_setting( 'authorpro_newsletter_text', array( 'default' => 'Be the first to hear about new releases, events, and exclusive content.', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'authorpro_newsletter_text', array( 'label' => __( 'CTA Text', 'authorpro' ), 'section' => 'authorpro_newsletter_section', 'type' => 'textarea' ) );
    $wp_customize->add_setting( 'authorpro_newsletter_embed', array( 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'authorpro_newsletter_embed', array( 'label' => __( 'Newsletter Form Embed Code', 'authorpro' ), 'section' => 'authorpro_newsletter_section', 'type' => 'textarea', 'description' => __( 'Paste your HTML embed code from your newsletter service (e.g., Mailchimp, ConvertKit). Some script tags may be filtered for security.', 'authorpro' ) ) );

    // --- Promotional Section ---
    $wp_customize->add_section( 'authorpro_promotional_section', array( 'title' => __( 'Promotional Section', 'authorpro' ), 'panel' => 'authorpro_homepage_panel' ) );
    $add_section_controls( 'promotional', 60 );
    $wp_customize->add_setting( 'authorpro_promotional_headline', array( 'default' => __( 'A Note from the Author', 'authorpro' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'authorpro_promotional_headline', array( 'label' => __( 'Headline', 'authorpro' ), 'section' => 'authorpro_promotional_section' ) );
    $wp_customize->add_setting( 'authorpro_promotional_content', array( 'default' => '', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'authorpro_promotional_content', array(
        'label'   => __( 'Promotional Content', 'authorpro' ),
        'section' => 'authorpro_promotional_section',
        'type'    => 'textarea',
        'description' => __( 'You can use HTML in this field for formatting.', 'authorpro' ),
    ) );

    // --- Theme Options Panel ---
    $wp_customize->add_panel( 'authorpro_theme_options_panel', array( 'title' => __( 'Theme Options', 'authorpro' ), 'priority' => 11 ) );

    // --- Header Settings Section ---
    $wp_customize->add_section( 'authorpro_header_section', array(
        'title'    => __( 'Header Settings', 'authorpro' ),
        'panel'    => 'authorpro_theme_options_panel',
    ) );
    $wp_customize->add_setting( 'authorpro_mobile_cta_text', array( 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'authorpro_mobile_cta_text', array(
        'label'   => __( 'Mobile CTA Button Text', 'authorpro' ),
        'section' => 'authorpro_header_section',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'authorpro_mobile_cta_url', array( 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'authorpro_mobile_cta_url', array(
        'label'   => __( 'Mobile CTA Button URL', 'authorpro' ),
        'section' => 'authorpro_header_section',
        'type'    => 'url',
    ) );

    // --- Colors Section ---
    $wp_customize->add_section( 'authorpro_colors_section', array( 'title' => __( 'Colors', 'authorpro' ), 'panel' => 'authorpro_theme_options_panel' ) );
    $wp_customize->add_setting( 'authorpro_accent_color', array( 'default' => '#7f8c8d', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'authorpro_accent_color', array( 'label' => __( 'Accent Color', 'authorpro' ), 'section' => 'authorpro_colors_section' ) ) );

    // --- Footer Section ---
    $wp_customize->add_section( 'authorpro_footer_section', array( 'title' => __( 'Footer', 'authorpro' ), 'panel' => 'authorpro_theme_options_panel' ) );
    $wp_customize->add_setting( 'authorpro_copyright_text', array( 'default' => 'Copyright ' . date('Y') . ' - All Rights Reserved.', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'authorpro_copyright_text', array( 'label' => __( 'Copyright Text', 'authorpro' ), 'section' => 'authorpro_footer_section', 'type' => 'text' ) );

    // --- Press Kit Section ---
    $wp_customize->add_section( 'authorpro_press_kit_section', array( 'title' => __( 'Press Kit', 'authorpro' ), 'panel' => 'authorpro_theme_options_panel' ) );
    $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'authorpro_press_kit_pdf', array( 'label' => __( 'Press Kit PDF', 'authorpro' ), 'section' => 'authorpro_press_kit_section', 'settings' => 'authorpro_press_kit_pdf' ) ) );

    // --- Social Links Section ---
    $wp_customize->add_section( 'authorpro_social_links_section', array( 'title' => __( 'Social Media Links', 'authorpro' ), 'panel' => 'authorpro_theme_options_panel' ) );
    $social_networks = array( 'twitter', 'facebook', 'instagram', 'linkedin', 'youtube' );
    foreach( $social_networks as $network ) {
        $wp_customize->add_setting( "authorpro_social_{$network}_url", array( 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( "authorpro_social_{$network}_url", array( 'label' => sprintf( __( '%s URL', 'authorpro' ), ucwords( $network ) ), 'section' => 'authorpro_social_links_section', 'type' => 'url' ) );
    }
}
add_action( 'customize_register', 'authorpro_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function authorpro_customize_preview_js() {
	wp_enqueue_script( 'authorpro-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), AUTHORPRO_VERSION, true );
}
add_action( 'customize_preview_init', 'authorpro_customize_preview_js' );

/**
 * Adds the custom accent color to the theme.
 */
function authorpro_custom_colors_css() {
    $accent_color = get_theme_mod( 'authorpro_accent_color', '#7f8c8d' );
    $custom_css = "
        a,
        .site-title a:hover,
        .entry-title a:hover {
            color: {$accent_color};
        }

        .button,
        button,
        input[type=\"button\"],
        input[type=\"reset\"],
        input[type=\"submit\"],
        .main-navigation a:hover {
            background-color: {$accent_color};
            border-color: {$accent_color};
            color: #fff;
        }
    ";
    wp_add_inline_style( 'authorpro-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'authorpro_custom_colors_css' );
