<?php
/**
 * Template part for displaying the promotional section of the homepage.
 *
 * @package AuthorPro
 */
?>

<section id="promotional" class="homepage-section promotional-section">
    <div class="container container-narrow">
        <h2 class="section-headline"><?php echo esc_html( get_theme_mod( 'authorpro_promotional_headline', __( 'A Note from the Author', 'authorpro' ) ) ); ?></h2>
        <div class="promotional-content">
            <?php
            $content = get_theme_mod( 'authorpro_promotional_content' );
            if ( ! empty( $content ) ) {
                // The content is sanitized with wp_kses_post on save, so we can echo it directly.
                echo apply_filters( 'the_content', $content );
            }
            ?>
        </div>
    </div>
</section>
