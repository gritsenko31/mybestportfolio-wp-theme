<?php
/**
 * The template for displaying the footer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
        </div><!-- .site-container -->
    </main><!-- #main -->

    <footer class="site-footer">
        <div class="site-container">
            <!-- Footer Widgets -->
            <?php
            $footer_widgets = array( 'footer-widget-1', 'footer-widget-2', 'footer-widget-3' );
            $has_footer_widgets = false;

            foreach ( $footer_widgets as $widget_area ) {
                if ( is_active_sidebar( $widget_area ) ) {
                    $has_footer_widgets = true;
                    break;
                }
            }

            if ( $has_footer_widgets ) {
                echo '<div class="footer-widgets">';
                foreach ( $footer_widgets as $widget_area ) {
                    if ( is_active_sidebar( $widget_area ) ) {
                        dynamic_sidebar( $widget_area );
                    }
                }
                echo '</div>';
            }
            ?>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <?php
                $footer_text = get_theme_mod( 'minimalist_footer_text', sprintf( esc_html__( '&copy; %s. All rights reserved.', 'minimalist-blog' ), current_time( 'Y' ) ) );
                if ( $footer_text ) {
                    echo wp_kses_post( $footer_text );
                } else {
                    printf(
                        esc_html__( '&copy; %s %s. All rights reserved. | %s', 'minimalist-blog' ),
                        current_time( 'Y' ),
                        esc_html( get_bloginfo( 'name' ) ),
                        '<a href="#">' . esc_html__( 'Privacy Policy', 'minimalist-blog' ) . '</a>'
                    );
                }
                ?>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>