<?php
/**
 * Template part for displaying the hero section of the homepage.
 *
 * @package AuthorPro
 */

?>

<section id="hero" class="homepage-section hero-section">
    <div class="hero-overlay"></div>
    <div class="container">
        <?php $hero_image_url = get_theme_mod( 'authorpro_hero_image' ); ?>
        <?php if ( $hero_image_url ) : ?>
            <img src="<?php echo esc_url( $hero_image_url ); ?>" alt="<?php echo esc_attr( get_theme_mod( 'authorpro_hero_headline' ) ); ?>" class="hero-image">
        <?php endif; ?>
        <h2 class="hero-headline"><?php echo esc_html( get_theme_mod( 'authorpro_hero_headline', get_bloginfo( 'name' ) ) ); ?></h2>
        <div class="hero-tagline"><?php echo wp_kses_post( get_theme_mod( 'authorpro_hero_tagline', 'Stories that stay with you long after the last page.' ) ); ?></div>
    </div>
</section>
