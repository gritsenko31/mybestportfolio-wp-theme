<?php
/**
 * The header for our theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'minimalist-blog' ); ?></a>

<header class="site-header">
    <div class="site-container">
        <!-- Logo and Site Title -->
        <div class="header-content">
            <div class="site-branding">
                <?php
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                if ( $custom_logo_id ) {
                    echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link">';
                    echo wp_get_attachment_image( $custom_logo_id, 'full' );
                    echo '</a>';
                }
                ?>
                <div>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    </h1>
                    <p class="site-description">
                        <?php bloginfo( 'description' ); ?>
                    </p>
                </div>
            </div>

            <!-- Search Form -->
            <div class="header-search">
                <?php get_search_form(); ?>
            </div>
        </div>

        <!-- Primary Navigation -->
        <nav class="main-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_class'     => 'nav-menu',
                'fallback_cb'    => function() {
                    echo '<ul class="nav-menu"><li><a href="#">' . esc_html__( 'Home', 'minimalist-blog' ) . '</a></li></ul>';
                },
            ) );
            ?>
        </nav>
    </div>
</header>

<main id="main" class="site-main">
    <div class="site-container">
        <?php
        // Conditional content based on page type
        if ( is_home() || is_archive() || is_search() ) {
            echo '<h1 class="page-title">';
            if ( is_search() ) {
                printf( esc_html__( 'Search Results for: %s', 'minimalist-blog' ), '<span>' . get_search_query() . '</span>' );
            } elseif ( is_category() ) {
                single_cat_title();
            } elseif ( is_tag() ) {
                single_tag_title();
            } elseif ( is_author() ) {
                printf( esc_html__( 'Posts by %s', 'minimalist-blog' ), '<span>' . get_the_author() . '</span>' );
            } elseif ( is_year() ) {
                printf( esc_html__( 'Year: %s', 'minimalist-blog' ), get_the_date( 'Y' ) );
            } elseif ( is_month() ) {
                printf( esc_html__( 'Month: %s', 'minimalist-blog' ), get_the_date( 'F Y' ) );
            } elseif ( is_day() ) {
                printf( esc_html__( 'Day: %s', 'minimalist-blog' ), get_the_date() );
            } else {
                esc_html_e( 'Blog', 'minimalist-blog' );
            }
            echo '</h1>';
        }
        ?>