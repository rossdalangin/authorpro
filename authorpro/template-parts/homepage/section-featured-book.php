<?php
/**
 * Template part for displaying the featured book section of the homepage.
 *
 * @package AuthorPro
 */
?>

<section id="featured-book" class="homepage-section featured-book-section">
    <div class="container">
        <h2 class="section-headline"><?php echo esc_html( get_theme_mod( 'authorpro_featured_book_headline', __( 'My Latest Novel', 'authorpro' ) ) ); ?></h2>
        <?php
        $featured_book_id = get_theme_mod( 'authorpro_featured_book_id' );
        if ( $featured_book_id ) {
            $args = array( 'p' => $featured_book_id, 'post_type' => 'book' );
            $featured_book_query = new WP_Query( $args );
            if ( $featured_book_query->have_posts() ) {
                while ( $featured_book_query->have_posts() ) {
                    $featured_book_query->the_post();
                    get_template_part( 'template-parts/content', 'book-featured' );
                }
                wp_reset_postdata();
            }
        }
        ?>
    </div>
</section>
