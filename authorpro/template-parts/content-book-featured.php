<?php
/**
 * Template part for displaying a featured book on the homepage.
 *
 * @package AuthorPro
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'featured-book' ); ?>>
    <div class="featured-book-inner">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="featured-book-cover">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'large' ); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="featured-book-details">
            <h3 class="featured-book-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

            <div class="featured-book-excerpt">
                <?php the_excerpt(); ?>
            </div>

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
                 <a href="<?php the_permalink(); ?>" class="button button-secondary"><?php esc_html_e( 'Learn More', 'authorpro' ); ?></a>
            </div>
        </div>
    </div>
</article>
