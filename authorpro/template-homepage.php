<?php
/**
 * Template Name: Homepage
 *
 * The template for displaying the homepage.
 *
 * @package AuthorPro
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    // Define the homepage sections
    $sections = array(
        'hero',
        'featured_book',
        'events',
        'blog',
        'promotional',
        'newsletter',
    );

    $sorted_sections = array();

    // Populate the array with data from the Customizer
    foreach ( $sections as $section ) {
        $is_visible = get_theme_mod( 'authorpro_' . $section . '_show', true );

        if ( $is_visible ) {
            $sorted_sections[] = array(
                'slug'  => $section,
                'order' => get_theme_mod( 'authorpro_' . $section . '_order', 0 ),
            );
        }
    }

    // Sort the sections based on the 'order' key
    usort( $sorted_sections, function( $a, $b ) {
        return $a['order'] - $b['order'];
    } );

    // Loop through the sorted sections and display them
    if ( ! empty( $sorted_sections ) ) {
        foreach ( $sorted_sections as $section ) {
            // The slug needs to map to the template part name
            $slug_map = array(
                'featured_book' => 'featured-book',
            );
            $template_slug = isset( $slug_map[ $section['slug'] ] ) ? $slug_map[ $section['slug'] ] : $section['slug'];

            get_template_part( 'template-parts/homepage/section', $template_slug );
        }
    }
    ?>

</main><!-- #main -->

<?php
get_footer();
