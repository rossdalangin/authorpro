<?php
/**
 * Template part for displaying the newsletter section of the homepage.
 *
 * @package AuthorPro
 */
?>

<section id="newsletter-cta" class="homepage-section newsletter-cta-section">
    <div class="container">
        <h2 class="section-headline"><?php echo esc_html( get_theme_mod( 'authorpro_newsletter_headline', __( 'Join My Reader\'s Circle', 'authorpro' ) ) ); ?></h2>
        <div class="newsletter-text"><?php echo wp_kses_post( get_theme_mod( 'authorpro_newsletter_text', 'Be the first to hear about new releases, events, and exclusive content.' ) ); ?></div>
        <div class="newsletter-form">
            <?php
            $newsletter_embed = get_theme_mod( 'authorpro_newsletter_embed' );
            if ( $newsletter_embed ) {
                echo $newsletter_embed;
            }
            ?>
        </div>
    </div>
</section>
