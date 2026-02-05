<?php
/**
 * Template part for displaying posts
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<article <?php post_class( 'post' ); ?>>
    <header class="post-header">
        <h2 class="post-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
        <div class="post-meta">
            <span class="post-date">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <path d="M16 2v4M8 2v4M3 10h18"/>
                </svg>
                <?php minimalist_posted_on(); ?>
            </span>
            <span class="post-author">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                <?php minimalist_posted_by(); ?>
            </span>
        </div>
    </header>

    <?php
    if ( has_post_thumbnail() && get_theme_mod( 'minimalist_display_featured_images', true ) ) {
        echo '<div class="post-thumbnail">';
        the_post_thumbnail( 'medium_large' );
        echo '</div>';
    }
    ?>

    <div class="post-excerpt">
        <?php
        if ( is_singular() ) {
            the_content();
        } else {
            the_excerpt();
        }
        ?>
    </div>

    <footer class="post-footer">
        <?php
        if ( ! is_singular() ) {
            echo '<a href="' . esc_url( get_permalink() ) . '" class="read-more">';
            esc_html_e( 'Read More', 'minimalist-blog' );
            echo '</a>';
        }
        minimalist_entry_footer();
        ?>
    </footer>
</article>