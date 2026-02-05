<?php
/**
 * The template for displaying single posts
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
            get_template_part( 'template-parts/content', 'single' );

            // Post navigation
            the_post_navigation( array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Post:', 'minimalist-blog' ) . '</span><span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Post:', 'minimalist-blog' ) . '</span><span class="nav-title">%title</span>',
            ) );

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