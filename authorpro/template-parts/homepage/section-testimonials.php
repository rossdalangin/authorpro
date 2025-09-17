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
        <div class="swiper testimonial-slider">
            <div class="swiper-wrapper">
                <?php while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); ?>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="testimonial-content">
                                <?php the_content(); ?>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-image">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                                    <?php else : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="60px" height="60px"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    <?php endif; ?>
                                </div>
                                <div class="author-details">
                                    <cite class="author-name"><?php the_title(); ?></cite>
                                    <?php
                                    $designation = get_post_meta( get_the_ID(), '_designation', true );
                                    if ( ! empty( $designation ) ) : ?>
                                        <span class="author-designation"><?php echo esc_html( $designation ); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
