<?php
/**
 * Template Name: Books Page
 *
 * The template for displaying all books.
 *
 * @package AuthorPro
 */

get_header();
?>

<main id="primary" class="site-main">

    <header class="page-header">
        <h1 class="page-title"><?php the_title(); ?></h1>
    </header>

    <div class="books-grid">
        <?php
        $books_query = new WP_Query( array(
            'post_type'      => 'book',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ) );

        if ( $books_query->have_posts() ) :
            while ( $books_query->have_posts() ) :
                $books_query->the_post();
                ?>
                <div class="book-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="book-cover">
                                <?php the_post_thumbnail( 'large' ); ?>
                            </div>
                        <?php else : ?>
                            <div class="book-cover-placeholder">
                                <span><?php the_title(); ?></span>
                            </div>
                        <?php endif; ?>
                        <h2 class="book-title"><?php the_title(); ?></h2>
                    </a>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <p><?php esc_html_e( 'No books found.', 'authorpro' ); ?></p>
            <?php
        endif;
        ?>
    </div><!-- .books-grid -->

</main><!-- #main -->

<?php
get_footer();
