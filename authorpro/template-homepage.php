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
        'testimonials',
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
            $section_slug = $section['slug'];
            $background_type = get_theme_mod( "authorpro_{$section_slug}_background_type", 'none' );
            $style = '';

            if ( 'color' === $background_type ) {
                $color = get_theme_mod( "authorpro_{$section_slug}_background_color", '#ffffff' );
                $style = "background-color: {$color};";
            } elseif ( 'image' === $background_type ) {
                $image = get_theme_mod( "authorpro_{$section_slug}_background_image" );
                if ( $image ) {
                    $style = "background-image: url('{$image}'); background-size: cover; background-position: center;";
                }
            } elseif ( 'gradient' === $background_type ) {
                $color1 = get_theme_mod( "authorpro_{$section_slug}_background_gradient_color_1", '#ffffff' );
                $color2 = get_theme_mod( "authorpro_{$section_slug}_background_gradient_color_2", '#000000' );
                $direction = get_theme_mod( "authorpro_{$section_slug}_background_gradient_direction", 'to right' );
                $style = "background: linear-gradient({$direction}, {$color1}, {$color2});";
            }

            // The slug needs to map to the template part name
            $slug_map = array(
                'featured_book' => 'featured-book',
            );
            $template_slug = isset( $slug_map[ $section_slug ] ) ? $slug_map[ $section_slug ] : $section_slug;

            echo '<div class="section-wrapper" style="' . esc_attr( $style ) . '">';
            get_template_part( 'template-parts/homepage/section', $template_slug );
            echo '</div>';
        }
    }
    ?>

</main><!-- #main -->

<?php
get_footer();
