<?php
/**
 * Chargement des assets CSS et JS
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue styles et scripts front-end
 */
function rcg_enqueue_assets() {
    // Google Fonts - Inter (400,600,700,900) + Lora (citations)
    wp_enqueue_style(
        'rcg-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&family=Lora:ital,wght@0,400;0,700;1,400&display=swap',
        array(),
        null
    );

    // Google Material Symbols
    wp_enqueue_style(
        'rcg-material-symbols',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0',
        array(),
        null
    );

    // Tailwind CSS (compiled local build)
    wp_enqueue_style(
        'rcg-tailwind',
        RCG_URI . '/assets/css/tailwind-output.css',
        array(),
        RCG_VERSION
    );

    // Custom component styles (non-utility)
    wp_enqueue_style(
        'rcg-colors',
        RCG_URI . '/assets/css/rcg-colors.css',
        array( 'rcg-tailwind' ),
        RCG_VERSION
    );

    // Theme style.css (metadonnees)
    wp_enqueue_style(
        'rcg-style',
        get_stylesheet_uri(),
        array( 'rcg-colors' ),
        RCG_VERSION
    );

    // Navigation JS (menu mobile)
    wp_enqueue_script(
        'rcg-navigation',
        RCG_URI . '/assets/js/navigation.js',
        array(),
        RCG_VERSION,
        array( 'in_footer' => true, 'strategy' => 'defer' )
    );

    // Main JS
    wp_enqueue_script(
        'rcg-main',
        RCG_URI . '/assets/js/main.js',
        array(),
        RCG_VERSION,
        array( 'in_footer' => true, 'strategy' => 'defer' )
    );

    // Passer des variables PHP au JS
    wp_localize_script( 'rcg-main', 'rcgData', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'rcg_nonce' ),
        'homeUrl' => home_url( '/' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'rcg_enqueue_assets' );

/**
 * Preconnect + preload pour les polices Google (performance)
 */
function rcg_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href'        => 'https://fonts.googleapis.com',
            'crossorigin' => '',
        );
        $urls[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'rcg_resource_hints', 10, 2 );

/**
 * Preload fonts CSS + non-critical CSS via media="print" trick
 */
function rcg_preload_fonts() {
    // Preload Google Fonts CSS
    echo '<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&family=Lora:ital,wght@0,400;0,700;1,400&display=swap">' . "\n";
    // Preload Material Symbols
    echo '<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">' . "\n";
}
add_action( 'wp_head', 'rcg_preload_fonts', 1 );

/**
 * Ajouter fetchpriority="high" aux images hero (LCP)
 */
function rcg_lcp_image_priority( $attr, $attachment, $size ) {
    if ( 'hero-large' === $size && is_front_page() ) {
        $attr['fetchpriority'] = 'high';
        $attr['decoding']      = 'async';
    }
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'rcg_lcp_image_priority', 10, 3 );
