<?php
/**
 * Template part for displaying posts in a masonry grid.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AuthorPro
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'masonry-item card' ); ?>>
    <?php if( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" class="card-image-link">
            <?php the_post_thumbnail('large'); ?>
        </a>
    <?php endif; ?>

	<div class="card-content">
        <header class="entry-header">
            <?php
            the_title( '<h2 class="entry-title card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            ?>
            <div class="entry-meta">
                <span><?php the_date(); ?></span>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->

        <div class="entry-summary card-excerpt">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
    </div><!-- .card-content -->
</article><!-- #post-<?php the_ID(); ?> -->
