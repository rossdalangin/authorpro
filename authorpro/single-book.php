<?php
/**
 * The template for displaying all single Book posts
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

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'book-single' ); ?>>
            <div class="book-main-content container">
                <div class="book-cover-column">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="book-cover">
                            <?php the_post_thumbnail( 'large' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="book-details-column">
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </header>

                    <div class="book-meta">
                        <?php
                        $publication_date = get_post_meta( get_the_ID(), '_publication_date', true );
                        $publisher = get_post_meta( get_the_ID(), '_publisher', true );
                        if ( $publication_date ) : ?>
                            <span class="publication-date"><?php printf( esc_html__( 'Published on: %s', 'authorpro' ), esc_html( $publication_date ) ); ?></span>
                        <?php endif; ?>
                        <?php if ( $publisher ) : ?>
                            <span class="publisher"><?php printf( esc_html__( 'Publisher: %s', 'authorpro' ), esc_html( $publisher ) ); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="entry-content">
                        <h3><?php esc_html_e( 'Synopsis', 'authorpro' ); ?></h3>
                        <?php the_content(); ?>
                    </div>

                    <div class="purchase-links-wrapper">
                        <h3><?php esc_html_e( 'Buy Now', 'authorpro' ); ?></h3>
                        <div class="purchase-links">
                            <?php
                            for ( $i = 1; $i <= 3; $i++ ) {
                                $store_name = get_post_meta( get_the_ID(), '_purchase_store_' . $i, true );
                                $store_url  = get_post_meta( get_the_ID(), '_purchase_url_' . $i, true );
                                if ( ! empty( $store_name ) && ! empty( $store_url ) ) {
                                    printf( '<a href="%s" class="button purchase-button" target="_blank" rel="noopener noreferrer">%s</a>', esc_url( $store_url ), esc_html( $store_name ) );
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-additional-info container">
                <?php
                $readers_guide = get_post_meta( get_the_ID(), '_readers_guide', true );
                if ( $readers_guide ) :
                ?>
                <section id="book-readers-guide">
                    <h3><?php esc_html_e( 'Reader\'s Guide / Excerpt', 'authorpro' ); ?></h3>
                    <div class="readers-guide-content">
                        <?php echo wp_kses_post( $readers_guide ); ?>
                    </div>
                </section>
                <?php endif; ?>

                <section id="about-the-author">
                    <h3><?php printf( esc_html__( 'About %s', 'authorpro' ), get_the_author() ); ?></h3>
                    <div class="author-box">
                        <div class="author-avatar">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 96 ); ?>
                        </div>
                        <div class="author-description">
                            <?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?>
                        </div>
                    </div>
                </section>

                <section id="book-reviews">
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>
                </section>
            </div>

        </article><!-- #post-<?php the_ID(); ?> -->

    <?php endwhile; // End of the loop. ?>

</main><!-- #main -->

<?php
get_footer();
