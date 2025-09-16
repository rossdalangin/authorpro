<?php
/**
 * Template part for displaying the upcoming events section of the homepage.
 *
 * @package AuthorPro
 */
?>

<section id="upcoming-events" class="homepage-section upcoming-events-section">
    <div class="container">
        <h2 class="section-headline"><?php echo esc_html( get_theme_mod( 'authorpro_events_headline', __( 'Upcoming Events', 'authorpro' ) ) ); ?></h2>
        <?php
        $today = date( 'Y-m-d H:i:s' );
        $upcoming_events_query = new WP_Query( array(
            'post_type'      => 'event',
            'posts_per_page' => 3,
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
        if ( $upcoming_events_query->have_posts() ) :
            while ( $upcoming_events_query->have_posts() ) : $upcoming_events_query->the_post();
                $event_datetime = get_post_meta( get_the_ID(), '_event_datetime', true );
                ?>
                <div class="event-summary">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php if ( $event_datetime ) :
                        $date = new DateTime( $event_datetime );
                    ?>
                    <span class="event-date"><?php echo $date->format( 'F j, Y' ); ?></span>
                    <?php endif; ?>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>' . esc_html__( 'No upcoming events scheduled.', 'authorpro' ) . '</p>';
        endif;
        ?>
    </div>
</section>
