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
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        /*
                        * Include the Post-Type-specific template for the content.
                        */
                        get_template_part( 'template-parts/content', get_post_format() );

                    endwhile;

                    the_posts_navigation();

                else :

                    get_template_part( 'template-parts/content', 'none' );

                endif;
                ?>
            </div><!-- .content-area -->

            <?php get_sidebar(); ?>

        </div><!-- .content-sidebar-wrap -->
	</main><!-- #main -->

<?php
get_footer();
