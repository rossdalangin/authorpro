<?php
/**
 * Template part for displaying posts in a grid, similar to books.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AuthorPro
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-item' ); ?>>
    <a href="<?php the_permalink(); ?>" class="grid-item-link">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="grid-item-image">
                <?php the_post_thumbnail( 'large' ); ?>
            </div>
        <?php else : ?>
            <div class="grid-item-image-placeholder">
                <span><?php the_title(); ?></span>
            </div>
        <?php endif; ?>
        <h2 class="grid-item-title"><?php the_title(); ?></h2>
    </a>
</article><!-- #post-<?php the_ID(); ?> -->
