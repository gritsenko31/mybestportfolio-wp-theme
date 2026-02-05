<?php
/**
 * Template part for displaying single posts
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<article <?php post_class( 'post single' ); ?>>
    <header class="post-header">
        <h1 class="post-title"><?php the_title(); ?></h1>
        <div class="post-meta">
            <span><?php minimalist_posted_on(); ?></span>
            <span><?php minimalist_posted_by(); ?></span>
        </div>
    </header>

    <?php
    if ( has_post_thumbnail() && get_theme_mod( 'minimalist_display_featured_images', true ) ) {
        echo '<div class="post-thumbnail">';
        the_post_thumbnail( 'large' );
        echo '</div>';
    }
    ?>

    <div class="post-content">
        <?php the_content(); ?>
    </div>

    <footer class="post-footer">
        <?php minimalist_entry_footer(); ?>
    </footer>
</article>