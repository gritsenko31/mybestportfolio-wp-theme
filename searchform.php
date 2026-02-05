<?php
/**
 * The template for displaying search forms
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" 
           class="search-field" 
           placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'minimalist-blog' ); ?>" 
           value="<?php echo get_search_query(); ?>" 
           name="s" 
           title="<?php echo esc_attr_x( 'Search for:', 'label', 'minimalist-blog' ); ?>">
    <button type="submit" class="search-submit">
        <?php echo esc_html_x( 'Search', 'submit button', 'minimalist-blog' ); ?>
    </button>
</form>