<?php
/**
 * Minimalist Blog Theme Functions
 * 
 * @package Minimalist_Blog
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Set up theme defaults
 */
function minimalist_setup() {
    // Make theme available for translation
    load_theme_textdomain( 'minimalist-blog', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links
    add_theme_support( 'automatic-feed-links' );

    // Add support for title tag
    add_theme_support( 'title-tag' );

    // Add support for post thumbnails
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 800, 600, true );

    // Add support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 50,
        'width'       => 50,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Add support for Gutenberg
    add_theme_support( 'editor-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'minimalist-blog' ),
        'footer'  => esc_html__( 'Footer Menu', 'minimalist-blog' ),
    ) );

    // HTML5 support
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'widgets',
    ) );

    // Add support for widgets
    add_theme_support( 'widgets' );
}
add_action( 'after_setup_theme', 'minimalist_setup' );

/**
 * Register widget areas
 */
function minimalist_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Primary Sidebar', 'minimalist-blog' ),
        'id'            => 'primary-sidebar',
        'description'   => esc_html__( 'Main sidebar', 'minimalist-blog' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // Footer widget areas
    for ( $i = 1; $i <= 3; $i++ ) {
        register_sidebar( array(
            'name'          => sprintf( esc_html__( 'Footer Widget Area %d', 'minimalist-blog' ), $i ),
            'id'            => 'footer-widget-' . $i,
            'description'   => sprintf( esc_html__( 'Footer widget area %d', 'minimalist-blog' ), $i ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }
}
add_action( 'widgets_init', 'minimalist_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function minimalist_enqueue_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style( 'minimalist-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Enqueue Google Fonts
    wp_enqueue_style( 'minimalist-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', array(), null );

    // Enqueue theme script
    wp_enqueue_script( 'minimalist-script', get_template_directory_uri() . '/js/theme.js', array(), '1.0.0', true );

    // Enqueue comment script if on single post with comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Pass PHP data to JavaScript
    wp_localize_script( 'minimalist-script', 'minimalist_data', array(
        'primary_color' => get_theme_mod( 'minimalist_primary_color', '#2c3e50' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'minimalist_enqueue_scripts' );

/**
 * Register custom post types
 */
function minimalist_register_post_types() {
    // Portfolio post type
    register_post_type( 'portfolio', array(
        'labels'      => array(
            'name'          => esc_html__( 'Portfolio', 'minimalist-blog' ),
            'singular_name' => esc_html__( 'Portfolio Item', 'minimalist-blog' ),
        ),
        'public'      => true,
        'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'has_archive' => true,
        'menu_icon'   => 'dashicons-format-gallery',
        'show_in_rest' => true,
    ) );

    // Testimonials post type
    register_post_type( 'testimonials', array(
        'labels'      => array(
            'name'          => esc_html__( 'Testimonials', 'minimalist-blog' ),
            'singular_name' => esc_html__( 'Testimonial', 'minimalist-blog' ),
        ),
        'public'      => true,
        'supports'    => array( 'title', 'editor', 'thumbnail' ),
        'has_archive' => true,
        'menu_icon'   => 'dashicons-testimonial',
        'show_in_rest' => true,
    ) );

    // Services post type
    register_post_type( 'services', array(
        'labels'      => array(
            'name'          => esc_html__( 'Services', 'minimalist-blog' ),
            'singular_name' => esc_html__( 'Service', 'minimalist-blog' ),
        ),
        'public'      => true,
        'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'has_archive' => true,
        'menu_icon'   => 'dashicons-list-view',
        'show_in_rest' => true,
    ) );
}
add_action( 'init', 'minimalist_register_post_types' );

/**
 * Theme Customizer settings
 */
function minimalist_customize_register( $wp_customize ) {
    // Primary Color
    $wp_customize->add_setting( 'minimalist_primary_color', array(
        'default'           => '#2c3e50',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'minimalist_primary_color', array(
        'label'   => esc_html__( 'Primary Color', 'minimalist-blog' ),
        'section' => 'colors',
    ) ) );

    // Accent Color
    $wp_customize->add_setting( 'minimalist_accent_color', array(
        'default'           => '#3498db',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'minimalist_accent_color', array(
        'label'   => esc_html__( 'Accent Color', 'minimalist-blog' ),
        'section' => 'colors',
    ) ) );

    // Content Width
    $wp_customize->add_section( 'minimalist_layout', array(
        'title'       => esc_html__( 'Layout Settings', 'minimalist-blog' ),
        'description' => esc_html__( 'Control the layout of your site', 'minimalist-blog' ),
    ) );

    $wp_customize->add_setting( 'minimalist_content_width', array(
        'default'           => '1200',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'minimalist_content_width', array(
        'label'       => esc_html__( 'Content Width (px)', 'minimalist-blog' ),
        'section'     => 'minimalist_layout',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 600,
            'max'  => 1600,
            'step' => 10,
        ),
    ) );

    // Display Sidebar
    $wp_customize->add_setting( 'minimalist_display_sidebar', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'minimalist_display_sidebar', array(
        'label'   => esc_html__( 'Display Sidebar', 'minimalist-blog' ),
        'section' => 'minimalist_layout',
        'type'    => 'checkbox',
    ) );

    // Posts per page
    $wp_customize->add_section( 'minimalist_blog', array(
        'title' => esc_html__( 'Blog Settings', 'minimalist-blog' ),
    ) );

    $wp_customize->add_setting( 'minimalist_posts_per_page', array(
        'default'           => '10',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'minimalist_posts_per_page', array(
        'label'       => esc_html__( 'Posts per Page', 'minimalist-blog' ),
        'section'     => 'minimalist_blog',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 50,
            'step' => 1,
        ),
    ) );

    // Display featured images
    $wp_customize->add_setting( 'minimalist_display_featured_images', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'minimalist_display_featured_images', array(
        'label'   => esc_html__( 'Display Featured Images', 'minimalist-blog' ),
        'section' => 'minimalist_blog',
        'type'    => 'checkbox',
    ) );

    // Footer settings
    $wp_customize->add_section( 'minimalist_footer', array(
        'title' => esc_html__( 'Footer Settings', 'minimalist-blog' ),
    ) );

    $wp_customize->add_setting( 'minimalist_footer_text', array(
        'default'           => sprintf( esc_html__( '&copy; %s. All rights reserved.', 'minimalist-blog' ), current_time( 'Y' ) ),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'minimalist_footer_text', array(
        'label'       => esc_html__( 'Footer Text', 'minimalist-blog' ),
        'section'     => 'minimalist_footer',
        'type'        => 'textarea',
        'description' => esc_html__( 'Leave empty to hide', 'minimalist-blog' ),
    ) );
}
add_action( 'customize_register', 'minimalist_customize_register' );

/**
 * Binds JS listeners to make Customizer preview reload components asynchronously
 */
function minimalist_customize_preview_js() {
    wp_enqueue_script( 'minimalist-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'minimalist_customize_preview_js' );

/**
 * Output custom CSS from customizer
 */
function minimalist_custom_css() {
    $primary_color = get_theme_mod( 'minimalist_primary_color', '#2c3e50' );
    $accent_color = get_theme_mod( 'minimalist_accent_color', '#3498db' );

    ?>
    <style>
        :root {
            --primary-color: <?php echo esc_attr( $primary_color ); ?>;
            --accent-color: <?php echo esc_attr( $accent_color ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'minimalist_custom_css' );

/**
 * Add custom classes to body tag
 */
function minimalist_body_classes( $classes ) {
    global $post;

    // Add class if sidebar is enabled
    if ( get_theme_mod( 'minimalist_display_sidebar', true ) && is_active_sidebar( 'primary-sidebar' ) ) {
        $classes[] = 'has-sidebar';
    }

    // Add class for post type
    if ( is_singular() ) {
        $classes[] = 'single-' . $post->post_type;
    }

    return $classes;
}
add_filter( 'body_class', 'minimalist_body_classes' );

/**
 * Customize the excerpt length
 */
function minimalist_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'minimalist_excerpt_length' );

/**
 * Customize the excerpt ending
 */
function minimalist_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'minimalist_excerpt_more' );

/**
 * Add support for Gutenberg editor styles
 */
function minimalist_block_editor_styles() {
    wp_enqueue_style( 'minimalist-editor-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'enqueue_block_editor_assets', 'minimalist_block_editor_styles' );

/**
 * Register Gutenberg color palette
 */
function minimalist_block_editor_settings() {
    $settings = array(
        'colors' => array(
            array(
                'name'  => esc_html__( 'Primary', 'minimalist-blog' ),
                'slug'  => 'primary',
                'color' => '#2c3e50',
            ),
            array(
                'name'  => esc_html__( 'Accent', 'minimalist-blog' ),
                'slug'  => 'accent',
                'color' => '#3498db',
            ),
            array(
                'name'  => esc_html__( 'Light Background', 'minimalist-blog' ),
                'slug'  => 'light-bg',
                'color' => '#ecf0f1',
            ),
        ),
        'fontSizes' => array(
            array(
                'name' => esc_html__( 'Small', 'minimalist-blog' ),
                'slug' => 'small',
                'size' => '0.85rem',
            ),
            array(
                'name' => esc_html__( 'Normal', 'minimalist-blog' ),
                'slug' => 'normal',
                'size' => '1rem',
            ),
            array(
                'name' => esc_html__( 'Large', 'minimalist-blog' ),
                'slug' => 'large',
                'size' => '1.25rem',
            ),
            array(
                'name' => esc_html__( 'Extra Large', 'minimalist-blog' ),
                'slug' => 'extra-large',
                'size' => '1.75rem',
            ),
        ),
    );

    return apply_filters( 'minimalist_block_editor_settings', $settings );
}

add_filter(
    'block_editor_settings_all',
    function( $settings ) {
        $custom_settings = minimalist_block_editor_settings();
        $settings['colors'] = $custom_settings['colors'];
        $settings['fontSizes'] = $custom_settings['fontSizes'];
        return $settings;
    }
);

/**
 * Customize WordPress login page
 */
function minimalist_login_logo() {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
    
    if ( $logo ) {
        echo '<style>';
        echo '.login h1 a { background-image: url(' . esc_url( $logo[0] ) . ') !important; background-size: contain; width: auto; }';
        echo '</style>';
    }
}
add_action( 'login_enqueue_scripts', 'minimalist_login_logo' );

/**
 * Add support for older WordPress versions
 */
if ( ! function_exists( 'wp_get_attachment_image_srcset' ) ) {
    function minimalist_get_image_src( $image ) {
        if ( is_array( $image ) ) {
            return $image[0];
        }
        return $image;
    }
}

/**
 * Custom template tags
 */
function minimalist_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    printf(
        wp_kses_post( $time_string ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );
}

function minimalist_posted_by() {
    printf(
        wp_kses_post( __( 'by <a href="%1$s">%2$s</a>', 'minimalist-blog' ) ),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_html( get_the_author() )
    );
}

function minimalist_entry_footer() {
    if ( 'post' === get_post_type() ) {
        the_tags( '<span class="post-tags">', ' ', '</span>' );
    }
}

// Apply customizer settings
function minimalist_apply_settings() {
    $posts_per_page = get_theme_mod( 'minimalist_posts_per_page', 10 );
    if ( $posts_per_page ) {
        add_filter( 'pre_option_posts_per_page', function() use ( $posts_per_page ) {
            return $posts_per_page;
        } );
    }
}
add_action( 'init', 'minimalist_apply_settings' );
?>