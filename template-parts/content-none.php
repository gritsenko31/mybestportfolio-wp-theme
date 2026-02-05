<?php
/**
 * Template part for displaying a message when no posts are found
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="no-posts not-found">
    <header>
        <h1 class="page-title">
            <?php esc_html_e( 'Nothing here', 'minimalist-blog' ); ?>
        </h1>
    </header>

    <div class="page-content">
        <?php
        if ( is_search() ) {
            printf(
                '<p>' . esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'minimalist-blog' ) . '</p>'
            );
            get_search_form();
        } else {
            printf(
                '<p>' . esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'minimalist-blog' ) . '</p>'
            );
            get_search_form();
        }
        ?>
    </div>
</section>