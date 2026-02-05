<?php
/**
 * The template for displaying pages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div class="content-container">
    <div class="main-content">
        <?php
        while ( have_posts() ) {
            the_post();
            get_template_part( 'template-parts/content', 'page' );

            // Comments
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
        }
        ?>
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