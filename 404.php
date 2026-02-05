<?php
/**
 * The template for displaying 404 pages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div class="content-container">
    <div class="main-content">
        <div class="error-404 not-found">
            <h1><?php esc_html_e( '404 - Page Not Found', 'minimalist-blog' ); ?></h1>
            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'minimalist-blog' ); ?></p>
            <?php get_search_form(); ?>
        </div>
    </div>

    <!-- Sidebar -->
    <?php
    if ( get_theme_mod( 'minimalist_display_sidebar', true ) ) {
        get_sidebar();
    }
    ?>
</div>

<?php
get_footer();