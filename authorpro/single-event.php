<?php
/**
 * The template for displaying all single Event posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package AuthorPro
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'event-single' ); ?>>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>

            <div class="event-details">
                <?php
                $event_datetime = get_post_meta( get_the_ID(), '_event_datetime', true );
                $event_location = get_post_meta( get_the_ID(), '_event_location', true );
                $event_url = get_post_meta( get_the_ID(), '_event_url', true );

                if ( $event_datetime ) :
                    // Note: This will require PHP 5.3+ to format correctly.
                    $date = new DateTime($event_datetime);
                ?>
                    <p class="event-time"><strong><?php esc_html_e( 'When:', 'authorpro' ); ?></strong> <?php echo $date->format( 'F j, Y \a\t g:i a' ); ?></p>
                <?php endif; ?>

                <?php if ( $event_location ) : ?>
                    <p class="event-location"><strong><?php esc_html_e( 'Where:', 'authorpro' ); ?></strong> <?php echo esc_html( $event_location ); ?></p>
                <?php endif; ?>
            </div>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <?php if ( $event_url ) : ?>
                <footer class="entry-footer">
                    <a href="<?php echo esc_url( $event_url ); ?>" class="button" target="_blank" rel="noopener noreferrer">
                        <?php esc_html_e( 'More Info / Get Tickets', 'authorpro' ); ?>
                    </a>
                </footer>
            <?php endif; ?>

        </article><!-- #post-<?php the_ID(); ?> -->

    <?php endwhile; // End of the loop. ?>

</main><!-- #main -->

<?php
get_footer();
