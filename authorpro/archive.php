<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AuthorPro
 */

get_header();
?>

	<main id="primary" class="site-main container">
        <div class="content-sidebar-wrap">
            <div class="content-area">
                <header class="page-header">
                    <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
                    ?>
                </header><!-- .page-header -->

                <?php if ( have_posts() ) : ?>
                    <div class="post-grid">
                        <?php
                        /* Start the Loop */
                        while ( have_posts() ) :
                            the_post();

                            /*
                            * Include the Post-Type-specific template for the content.
                            */
                            get_template_part( 'template-parts/content', 'archive' );

                        endwhile;
                        ?>
                    </div><!-- .masonry-grid -->

                    <?php
                    global $wp_query;
                    if (  $wp_query->max_num_pages > 1 ) : ?>
                        <div class="load-more-container">
                            <button class="load-more-button button"><?php esc_html_e( 'Load More', 'authorpro' ); ?></button>
                        </div>
                    <?php endif; ?>

                <?php else :

                    get_template_part( 'template-parts/content', 'none' );

                endif;
                ?>
            </div><!-- .content-area -->

            <?php get_sidebar(); ?>

        </div><!-- .content-sidebar-wrap -->
	</main><!-- #main -->

<?php
get_footer();
