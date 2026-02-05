<?php
/**
 * The template for displaying archive pages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div class="content-container">
    <div class="main-content">
        <?php
        if ( have_posts() ) {
            echo '<div class="posts-container">';

            while ( have_posts() ) {
                the_post();
                get_template_part( 'template-parts/content', get_post_type() );
            }

            echo '</div>';

            // Pagination
            echo '<div class="pagination">';
            echo paginate_links( array(
                'prev_text' => esc_html__( '&laquo; Previous', 'minimalist-blog' ),
                'next_text' => esc_html__( 'Next &raquo;', 'minimalist-blog' ),
            ) );
            echo '</div>';
        } else {
            get_template_part( 'template-parts/content', 'none' );
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