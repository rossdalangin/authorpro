<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AuthorPro
 */

?>

	<footer id="colophon" class="site-footer">
        <div class="footer-widgets container">
            <div class="footer-widget-area">
                <?php if ( is_active_sidebar( 'footer-1' ) ) { dynamic_sidebar( 'footer-1' ); } ?>
            </div>
            <div class="footer-widget-area">
                <?php if ( is_active_sidebar( 'footer-2' ) ) { dynamic_sidebar( 'footer-2' ); } ?>
            </div>
            <div class="footer-widget-area">
                <?php if ( is_active_sidebar( 'footer-3' ) ) { dynamic_sidebar( 'footer-3' ); } ?>
            </div>
            <div class="footer-widget-area">
                <?php if ( is_active_sidebar( 'footer-4' ) ) { dynamic_sidebar( 'footer-4' ); } ?>
            </div>
        </div>

		<div class="site-info-wrapper">
            <div class="site-info container">
                <div class="copyright">
                    <?php echo esc_html( get_theme_mod( 'authorpro_copyright_text', 'Copyright ' . date('Y') . ' - All Rights Reserved.' ) ); ?>
                </div>
                <div class="footer-meta">
                    <div class="footer-social-links">
                        <?php
                        $social_networks = array( 'twitter', 'facebook', 'instagram', 'linkedin', 'youtube' );
                        foreach ( $social_networks as $network ) {
                            $url = get_theme_mod( "authorpro_social_{$network}_url" );
                            if ( ! empty( $url ) ) {
                                printf( '<a href="%s" target="_blank" rel="noopener noreferrer"><span class="screen-reader-text">%s</span>%s</a>',
                                    esc_url( $url ),
                                    esc_html( ucwords( $network ) ),
                                    esc_html( ucwords( $network ) ) // Placeholder, to be replaced with an icon
                                );
                            }
                        }
                        ?>
                    </div>
                     <div class="footer-press-kit">
                        <?php
                        $press_kit_url = get_theme_mod( 'authorpro_press_kit_pdf' );
                        if ( $press_kit_url ) :
                            ?>
                            <a href="<?php echo esc_url( $press_kit_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Press Kit', 'authorpro' ); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div><!-- .site-info -->
        </div><!-- .site-info-wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
