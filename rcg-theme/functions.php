<?php
/**
 * RCG Theme - functions.php
 *
 * Configuration centrale du theme WordPress RCG.
 *
 * @package RCG
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'RCG_VERSION', '1.0.0' );
define( 'RCG_DIR', get_template_directory() );
define( 'RCG_URI', get_template_directory_uri() );

/**
 * Polyfill ACF — evite les erreurs fatales si ACF Pro n'est pas installe.
 * Les fonctions retournent null/false, les templates utilisent les fallbacks statiques.
 */
if ( ! function_exists( 'get_field' ) ) {
    function get_field( $selector = '', $post_id = false, $format_value = true ) {
        return null;
    }
}
if ( ! function_exists( 'get_sub_field' ) ) {
    function get_sub_field( $selector = '', $format_value = true ) {
        return null;
    }
}
if ( ! function_exists( 'have_rows' ) ) {
    function have_rows( $selector = '', $post_id = false ) {
        return false;
    }
}
if ( ! function_exists( 'the_row' ) ) {
    function the_row( $format_value = true ) {
        return false;
    }
}
if ( ! function_exists( 'the_sub_field' ) ) {
    function the_sub_field( $selector = '', $format_value = true ) {
        return;
    }
}

/**
 * Theme Setup
 */
function rcg_theme_setup() {
    // Traductions
    load_theme_textdomain( 'rcg', RCG_DIR . '/languages' );

    // Support du titre dynamique
    add_theme_support( 'title-tag' );

    // Images a la une
    add_theme_support( 'post-thumbnails' );

    // Logo personnalise
    add_theme_support( 'custom-logo', array(
        'height'      => 72,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Styles editeur
    add_theme_support( 'editor-styles' );

    // Alignement large/pleine largeur dans Gutenberg
    add_theme_support( 'align-wide' );

    // Tailles d'images personnalisees
    add_image_size( 'hero-large', 1920, 1080, true );
    add_image_size( 'card-medium', 800, 600, true );
    add_image_size( 'card-small', 400, 300, true );
    add_image_size( 'team-portrait', 400, 500, true );

    // Menus de navigation
    register_nav_menus( array(
        'menu-principal' => __( 'Menu Principal', 'rcg' ),
        'menu-footer'    => __( 'Menu Footer', 'rcg' ),
        'menu-legal'     => __( 'Menu Legal', 'rcg' ),
    ) );
}
add_action( 'after_setup_theme', 'rcg_theme_setup' );

/**
 * Includes
 */
require_once RCG_DIR . '/inc/enqueue.php';
require_once RCG_DIR . '/inc/menus.php';
require_once RCG_DIR . '/inc/custom-post-types.php';
require_once RCG_DIR . '/inc/customizer.php';
require_once RCG_DIR . '/inc/helpers.php';

/**
 * ACF : Page d'options + champs (si ACF Pro installe)
 */
if ( function_exists( 'acf_add_options_page' ) ) {
    require_once RCG_DIR . '/inc/acf-fields.php';

    acf_add_options_page( array(
        'page_title' => __( 'Options RCG', 'rcg' ),
        'menu_title' => __( 'Options RCG', 'rcg' ),
        'menu_slug'  => 'rcg-options',
        'capability' => 'edit_posts',
        'redirect'   => false,
        'icon_url'   => 'dashicons-admin-site-alt3',
        'position'   => 2,
    ) );

    acf_add_options_sub_page( array(
        'page_title'  => __( 'Reseaux Sociaux', 'rcg' ),
        'menu_title'  => __( 'Reseaux Sociaux', 'rcg' ),
        'parent_slug' => 'rcg-options',
    ) );

    acf_add_options_sub_page( array(
        'page_title'  => __( 'Adresses & Contact', 'rcg' ),
        'menu_title'  => __( 'Adresses', 'rcg' ),
        'parent_slug' => 'rcg-options',
    ) );
}

/**
 * Zones de widgets
 */
function rcg_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Newsletter', 'rcg' ),
        'id'            => 'footer-newsletter',
        'description'   => __( 'Zone widget pour le formulaire newsletter du footer.', 'rcg' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="text-sm font-bold uppercase tracking-widest mb-6 border-b border-white/10 pb-2">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'rcg_widgets_init' );

/**
 * Handler du formulaire de contact (fallback sans CF7)
 */
function rcg_handle_contact_form() {
    if ( ! isset( $_POST['rcg_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['rcg_contact_nonce'] ) ), 'rcg_contact_form' ) ) {
        wp_die( esc_html__( 'Verification de securite echouee.', 'rcg' ), '', array( 'back_link' => true ) );
    }

    $name    = isset( $_POST['rcg_name'] ) ? sanitize_text_field( wp_unslash( $_POST['rcg_name'] ) ) : '';
    $email   = isset( $_POST['rcg_email'] ) ? sanitize_email( wp_unslash( $_POST['rcg_email'] ) ) : '';
    $phone   = isset( $_POST['rcg_tel'] ) ? sanitize_text_field( wp_unslash( $_POST['rcg_tel'] ) ) : '';
    $org     = isset( $_POST['rcg_org'] ) ? sanitize_text_field( wp_unslash( $_POST['rcg_org'] ) ) : '';
    $service = isset( $_POST['rcg_besoin'] ) ? sanitize_text_field( wp_unslash( $_POST['rcg_besoin'] ) ) : '';
    $message = isset( $_POST['rcg_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['rcg_message'] ) ) : '';

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_safe_redirect( add_query_arg( 'contact', 'error', wp_get_referer() ) );
        exit;
    }

    $to      = get_option( 'admin_email' );
    $subject = sprintf( '[RCG Contact] Message de %s', $name );
    $body    = sprintf(
        "Nom : %s\nEmail : %s\nTelephone : %s\nOrganisation : %s\nService : %s\n\nMessage :\n%s",
        $name, $email, $phone, $org, $service, $message
    );
    $headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email );

    wp_mail( $to, $subject, $body, $headers );

    wp_safe_redirect( add_query_arg( 'contact', 'success', wp_get_referer() ) );
    exit;
}
add_action( 'admin_post_nopriv_rcg_contact_submit', 'rcg_handle_contact_form' );
add_action( 'admin_post_rcg_contact_submit', 'rcg_handle_contact_form' );

/**
 * Handler newsletter (placeholder)
 */
function rcg_handle_newsletter() {
    if ( ! isset( $_POST['rcg_newsletter_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['rcg_newsletter_nonce'] ) ), 'rcg_newsletter' ) ) {
        wp_die( esc_html__( 'Verification de securite echouee.', 'rcg' ), '', array( 'back_link' => true ) );
    }

    $email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    if ( empty( $email ) ) {
        wp_safe_redirect( add_query_arg( 'newsletter', 'error', wp_get_referer() ) );
        exit;
    }

    // TODO: Integrer avec Mailchimp, Brevo, ou stocker en base
    wp_safe_redirect( add_query_arg( 'newsletter', 'success', wp_get_referer() ) );
    exit;
}
add_action( 'admin_post_nopriv_rcg_newsletter_subscribe', 'rcg_handle_newsletter' );
add_action( 'admin_post_rcg_newsletter_subscribe', 'rcg_handle_newsletter' );
