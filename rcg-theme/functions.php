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
 * SEO : Meta description et Open Graph tags
 */
function rcg_seo_meta_tags() {
	// Ne pas injecter si un plugin SEO est actif
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) ) {
		return;
	}

	$site_name   = get_bloginfo( 'name' );
	$default_desc = 'RCG West Africa — Premiere agence africaine de communication institutionnelle, politique et sociale. Conseil strategique, relations publiques et branding en Afrique de l\'Ouest.';

	if ( is_front_page() ) {
		$title = $site_name . ' — Communication Institutionnelle & Strategique en Afrique de l\'Ouest';
		$desc  = $default_desc;
	} elseif ( is_singular() ) {
		$title = get_the_title() . ' — ' . $site_name;
		$desc  = has_excerpt() ? wp_strip_all_tags( get_the_excerpt() ) : $default_desc;
	} elseif ( is_post_type_archive( 'realisation' ) || is_page( 'realisations' ) ) {
		$title = 'Realisations & Etudes de Cas — ' . $site_name;
		$desc  = 'Missions strategiques de RCG West Africa : conseil institutionnel, communication de crise, relations publiques, evenementiel. 100+ missions pour gouvernements, CEDEAO, BAD et entreprises en Afrique de l\'Ouest.';
	} elseif ( is_page( 'equipe' ) ) {
		$title = 'Notre Equipe — ' . $site_name;
		$desc  = 'L\'equipe RCG West Africa : Ibrahim KOUROUMA, Fondateur & Directeur General, et 20+ experts en communication institutionnelle, relations publiques, conseil strategique et branding en Afrique de l\'Ouest.';
	} elseif ( is_page( 'a-propos' ) ) {
		$title = 'A Propos de RCG West Africa — ' . $site_name;
		$desc  = 'Fondee par Ibrahim KOUROUMA a Abidjan, RCG West Africa est la premiere agence africaine de communication institutionnelle. 15+ ans d\'expertise, 50+ clients, 10+ pays en Afrique de l\'Ouest.';
	} elseif ( is_page( 'expertises' ) ) {
		$title = 'Expertises en Communication Institutionnelle — ' . $site_name;
		$desc  = 'Conseil strategique, relations publiques, communication de crise, relations presse, creation de contenus, branding et evenementiel. Les 10 expertises de RCG West Africa en Afrique de l\'Ouest.';
	} elseif ( is_page( 'contact' ) ) {
		$title = 'Contactez RCG West Africa — ' . $site_name;
		$desc  = 'Contactez RCG West Africa a Abidjan, Cocody 8e Tranche. Tel : +225 25 22 00 46 71. Email : info@rcgwestafrica.com.';
	} elseif ( is_page( 'insights' ) ) {
		$title = 'Insights — Analyses & Decryptages Communication Institutionnelle | ' . $site_name;
		$desc  = 'RCG Insights : analyses, decryptages et opinions d\'experts sur la communication institutionnelle en Afrique de l\'Ouest. Strategie, relations presse, gestion de crise, personal branding — par RCG West Africa, Abidjan.';
	} else {
		$title = wp_get_document_title();
		$desc  = $default_desc;
	}

	$desc = rcg_truncate( $desc, 160 );
	$url  = is_singular() ? get_permalink() : home_url( esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ?? '/' ) ) );
	$img  = has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'hero-large' ) : '';

	echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
	echo '<meta property="og:type" content="' . ( is_singular() ? 'article' : 'website' ) . '">' . "\n";
	echo '<meta property="og:locale" content="fr_FR">' . "\n";
	if ( $img ) {
		echo '<meta property="og:image" content="' . esc_url( $img ) . '">' . "\n";
	}
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
	if ( $img ) {
		echo '<meta name="twitter:image" content="' . esc_url( $img ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'rcg_seo_meta_tags', 1 );

/**
 * SEO : Schema.org JSON-LD pour l'organisation
 */
function rcg_schema_organization() {
	if ( ! is_front_page() ) {
		return;
	}
	$schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Organization',
		'name'        => 'RCG West Africa',
		'description' => 'Premiere agence africaine de communication institutionnelle, politique et sociale.',
		'url'         => home_url( '/' ),
		'telephone'   => '+22525220046 71',
		'email'       => 'info@rcgwestafrica.com',
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Cocody 8e Tranche',
			'addressLocality' => 'Abidjan',
			'addressCountry'  => 'CI',
		),
		'founder'     => array(
			'@type'    => 'Person',
			'name'     => 'Ibrahim KOUROUMA',
			'jobTitle' => 'Fondateur & Directeur General',
		),
		'sameAs'      => array(
			'https://www.linkedin.com/company/rcgwestafrica',
			'https://www.facebook.com/RCGWestAfricaa',
			'https://www.instagram.com/rcgwestafrica_/',
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'rcg_schema_organization', 2 );

/**
 * Security Headers
 */
function rcg_security_headers() {
    if ( ! is_admin() ) {
        header( 'X-Content-Type-Options: nosniff' );
        header( 'X-Frame-Options: SAMEORIGIN' );
        header( 'Referrer-Policy: strict-origin-when-cross-origin' );
        header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );
    }
}
add_action( 'send_headers', 'rcg_security_headers' );

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
require_once RCG_DIR . '/inc/demo-data.php';

/**
 * ACF : Page d'options + champs (si ACF Pro installe)
 */
if ( function_exists( 'acf_add_options_page' ) ) {
    require_once RCG_DIR . '/inc/acf-fields.php';

    acf_add_options_page( array(
        'page_title' => __( 'Options RCG', 'rcg' ),
        'menu_title' => __( 'Options RCG', 'rcg' ),
        'menu_slug'  => 'rcg-options',
        'capability' => 'manage_options',
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

    $name    = isset( $_POST['rcg_name'] ) ? str_replace( array( "\r", "\n" ), '', sanitize_text_field( wp_unslash( $_POST['rcg_name'] ) ) ) : '';
    $email   = isset( $_POST['rcg_email'] ) ? sanitize_email( wp_unslash( $_POST['rcg_email'] ) ) : '';

    // Valider le format email
    if ( ! is_email( $email ) ) {
        wp_safe_redirect( add_query_arg( 'contact', 'error', wp_get_referer() ) );
        exit;
    }
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
    $headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . sanitize_email( $email ) );

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

/**
 * Admin : notice informative sur les pages a template personnalise
 */
function rcg_admin_template_notice() {
    $screen = get_current_screen();
    if ( ! $screen || 'page' !== $screen->post_type || 'post' !== $screen->base ) {
        return;
    }

    global $post;
    if ( ! $post ) {
        return;
    }

    $template = get_post_meta( $post->ID, '_wp_page_template', true );
    $is_front = ( (int) get_option( 'page_on_front' ) === $post->ID );

    if ( $is_front || ( $template && 'default' !== $template ) ) {
        $template_name = $is_front ? 'Page d\'accueil (front-page.php)' : basename( $template );
        $has_acf = function_exists( 'acf_add_options_page' );
        ?>
        <div class="notice notice-info is-dismissible" style="margin-top:15px">
            <p>
                <strong>Template actif :</strong> <code><?php echo esc_html( $template_name ); ?></code><br>
                <?php if ( $has_acf ) : ?>
                    Le contenu de cette page est gere par les <strong>champs ACF</strong> ci-dessous. L'editeur de blocs ci-dessus n'est pas utilise.
                <?php else : ?>
                    Le contenu de cette page est genere automatiquement par le template du theme. Installez <strong>ACF Pro</strong> pour personnaliser chaque section depuis l'admin.
                <?php endif; ?>
            </p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'rcg_admin_template_notice' );

/**
 * Admin : desactiver l'editeur Gutenberg sur les pages a template personnalise
 */
function rcg_disable_gutenberg_for_templates( $use_block_editor, $post ) {
    if ( 'page' !== $post->post_type ) {
        return $use_block_editor;
    }

    $template  = get_post_meta( $post->ID, '_wp_page_template', true );
    $is_front  = ( (int) get_option( 'page_on_front' ) === $post->ID );

    if ( $is_front || ( $template && 'default' !== $template ) ) {
        return false;
    }

    return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'rcg_disable_gutenberg_for_templates', 10, 2 );
