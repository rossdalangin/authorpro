<?php
/**
 * Template Name: Events Page
 *
 * The template for displaying all events.
 *
 * @package AuthorPro
 */

get_header();
?>

<main id="primary" class="site-main">

    <header class="page-header">
        <h1 class="page-title"><?php the_title(); ?></h1>
    </header>

    <div class="events-list">
        <?php
        $today = date( 'Y-m-d H:i:s' );
        $events_query = new WP_Query( array(
            'post_type'      => 'event',
            'posts_per_page' => -1,
            'meta_key'       => '_event_datetime',
            'orderby'        => 'meta_value',
            'order'          => 'ASC',
            'meta_query'     => array(
                array(
                    'key'     => '_event_datetime',
                    'value'   => $today,
                    'compare' => '>=',
                    'type'    => 'DATETIME',
                ),
            ),
        ) );

        if ( $events_query->have_posts() ) :
            while ( $events_query->have_posts() ) :
                $events_query->the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'event-item' ); ?>>
                    <header class="entry-header">
                        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                    </header>
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <p><?php esc_html_e( 'No upcoming events found.', 'authorpro' ); ?></p>
            <?php
        endif;
        ?>
    </div><!-- .events-list -->

</main><!-- #main -->

<?php
get_footer();
