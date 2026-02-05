<?php
/**
 * The sidebar containing the main widget area
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
    return;
}
?>

<aside class="sidebar">
    <?php
    dynamic_sidebar( 'primary-sidebar' );
    ?>
</aside>