<?php
/**
 * The template for displaying the Testimonials section on the homepage.
 *
 * @package AuthorPro
 */

$headline = get_theme_mod( 'authorpro_testimonials_headline', __( 'What Readers Are Saying', 'authorpro' ) );
$testimonials_query = new WP_Query( array(
    'post_type'      => 'testimonial',
    'posts_per_page' => 3,
    'orderby'        => 'rand',
) );

if ( $testimonials_query->have_posts() ) : ?>
    <section id="testimonials" class="homepage-section testimonials-section">
        <div class="container">
            <h2 class="section-headline"><?php echo esc_html( $headline ); ?></h2>
            <div class="testimonial-grid">
                <?php while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); ?>
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <?php the_content(); ?>
                        </div>
                        <div class="testimonial-author">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="author-image">
                                    <?php the_post_thumbnail( 'thumbnail' ); ?>
                                </div>
                            <?php endif; ?>
                            <cite class="author-name"><?php the_title(); ?></cite>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
