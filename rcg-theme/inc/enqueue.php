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
    // Google Fonts - Inter + Lora (citations)
    wp_enqueue_style(
        'rcg-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&family=Lora:ital,wght@0,400;0,700;1,400;1,700&display=swap',
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

    // Tailwind CSS via CDN (avec config RCG)
    wp_enqueue_script(
        'rcg-tailwind-cdn',
        'https://cdn.tailwindcss.com',
        array(),
        null,
        false
    );

    // Configuration Tailwind inline (couleurs RCG)
    wp_add_inline_script( 'rcg-tailwind-cdn', "
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#CC151B',
                        'background-dark': '#0A0A0A',
                        'background-light': '#FFFFFF',
                        'surface-dark': '#1C1C1C',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    borderRadius: {
                        btn: '2px',
                    },
                },
            },
        }
    " );

    // Couleurs RCG + surcharges + styles prose
    wp_enqueue_style(
        'rcg-colors',
        RCG_URI . '/assets/css/rcg-colors.css',
        array(),
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
        true
    );

    // Main JS
    wp_enqueue_script(
        'rcg-main',
        RCG_URI . '/assets/js/main.js',
        array(),
        RCG_VERSION,
        true
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
 * Preconnect pour les polices Google (performance)
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
