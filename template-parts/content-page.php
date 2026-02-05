<?php
/**
 * Template part for displaying pages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<article <?php post_class( 'post page' ); ?>>
    <header class="post-header">
        <h1 class="post-title"><?php the_title(); ?></h1>
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
</article>