<?php
/**
 * Customizer WordPress - Options du theme RCG
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enregistrement des options du Customizer
 */
function rcg_customize_register( $wp_customize ) {

    // === Section : Couleurs RCG ===
    $wp_customize->add_section( 'rcg_colors', array(
        'title'    => __( 'Couleurs RCG', 'rcg' ),
        'priority' => 30,
    ) );

    // Couleur primaire
    $wp_customize->add_setting( 'rcg_color_primary', array(
        'default'           => '#CC151B',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rcg_color_primary', array(
        'label'   => __( 'Couleur primaire (Rouge RCG)', 'rcg' ),
        'section' => 'rcg_colors',
    ) ) );

    // Couleur fond sombre
    $wp_customize->add_setting( 'rcg_color_dark', array(
        'default'           => '#0A0A0A',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rcg_color_dark', array(
        'label'   => __( 'Fond sombre (Background Dark)', 'rcg' ),
        'section' => 'rcg_colors',
    ) ) );

    // Couleur surface sombre
    $wp_customize->add_setting( 'rcg_color_surface', array(
        'default'           => '#1C1C1C',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rcg_color_surface', array(
        'label'   => __( 'Surface sombre (Cards)', 'rcg' ),
        'section' => 'rcg_colors',
    ) ) );

    // === Section : Textes Footer ===
    $wp_customize->add_section( 'rcg_footer', array(
        'title'    => __( 'Footer RCG', 'rcg' ),
        'priority' => 120,
    ) );

    // Description footer
    $wp_customize->add_setting( 'rcg_footer_description', array(
        'default'           => 'Premiere agence africaine de communication institutionnelle, politique et sociale. Conseil strategique, relations publiques et branding au service des decideurs en Afrique de l\'Ouest.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'rcg_footer_description', array(
        'label'   => __( 'Description footer', 'rcg' ),
        'section' => 'rcg_footer',
        'type'    => 'textarea',
    ) );

    // Copyright
    $wp_customize->add_setting( 'rcg_footer_copyright', array(
        'default'           => '&copy; ' . wp_date( 'Y' ) . ' RCG West Africa. Tous droits reserves.',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'rcg_footer_copyright', array(
        'label'   => __( 'Texte copyright', 'rcg' ),
        'section' => 'rcg_footer',
        'type'    => 'text',
    ) );

    // Texte newsletter
    $wp_customize->add_setting( 'rcg_newsletter_text', array(
        'default'           => 'Recevez nos analyses et insights sur la communication institutionnelle en Afrique.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'rcg_newsletter_text', array(
        'label'   => __( 'Texte newsletter', 'rcg' ),
        'section' => 'rcg_footer',
        'type'    => 'text',
    ) );

    // === Section : CTA Global ===
    $wp_customize->add_section( 'rcg_cta', array(
        'title'    => __( 'Bandeau CTA', 'rcg' ),
        'priority' => 110,
    ) );

    $wp_customize->add_setting( 'rcg_cta_text', array(
        'default'           => 'Travaillons ensemble sur vos enjeux.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'rcg_cta_text', array(
        'label'   => __( 'Texte du bandeau CTA', 'rcg' ),
        'section' => 'rcg_cta',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'rcg_cta_button_text', array(
        'default'           => 'Demarrer un projet',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'rcg_cta_button_text', array(
        'label'   => __( 'Texte du bouton CTA', 'rcg' ),
        'section' => 'rcg_cta',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'rcg_cta_button_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'rcg_cta_button_url', array(
        'label'   => __( 'URL du bouton CTA', 'rcg' ),
        'section' => 'rcg_cta',
        'type'    => 'url',
    ) );
}
add_action( 'customize_register', 'rcg_customize_register' );

/**
 * Injecter les couleurs personnalisees en CSS inline
 */
function rcg_customizer_css() {
    $primary = get_theme_mod( 'rcg_color_primary', '#CC151B' );
    $dark    = get_theme_mod( 'rcg_color_dark', '#0A0A0A' );
    $surface = get_theme_mod( 'rcg_color_surface', '#1C1C1C' );

    // Ne rien injecter si les valeurs sont par defaut
    if ( '#CC151B' === $primary && '#0A0A0A' === $dark && '#1C1C1C' === $surface ) {
        return;
    }

    $css = ':root {';
    if ( '#CC151B' !== $primary ) {
        $css .= '--rcg-primary: ' . esc_attr( $primary ) . ';';
    }
    if ( '#0A0A0A' !== $dark ) {
        $css .= '--rcg-dark: ' . esc_attr( $dark ) . ';';
    }
    if ( '#1C1C1C' !== $surface ) {
        $css .= '--rcg-surface: ' . esc_attr( $surface ) . ';';
    }
    $css .= '}';

    wp_add_inline_style( 'rcg-tailwind', $css );
}
add_action( 'wp_enqueue_scripts', 'rcg_customizer_css', 20 );
