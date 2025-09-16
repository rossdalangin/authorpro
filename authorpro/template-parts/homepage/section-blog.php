<?php
/**
 * Template part for displaying the blog section of the homepage.
 *
 * @package AuthorPro
 */
?>

<section id="from-the-blog" class="homepage-section from-the-blog-section">
    <div class="container">
        <h2 class="section-headline"><?php echo esc_html( get_theme_mod( 'authorpro_blog_headline', __( 'From The Blog', 'authorpro' ) ) ); ?></h2>
        <?php
        $recent_posts_query = new WP_Query( array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'ignore_sticky_posts' => 1,
        ) );
        if ( $recent_posts_query->have_posts() ) :
            while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post();
                 ?>
                <div class="post-summary">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="entry-meta"><?php the_date(); ?></div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</section>
