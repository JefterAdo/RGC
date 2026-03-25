<?php
/**
 * Header du theme RCG
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-background-light text-slate-900 selection:bg-primary selection:text-white' ); ?>>
<?php wp_body_open(); ?>

<!-- Navigation sticky -->
<nav class="sticky top-0 z-50 min-h-[72px] bg-white border-b border-gray-100 flex items-center px-6 lg:px-12 justify-between" role="navigation" aria-label="<?php esc_attr_e( 'Menu principal', 'rcg' ); ?>">

    <!-- Logo -->
    <div class="flex items-center gap-3">
        <?php rcg_logo( 'dark' ); ?>
    </div>

    <!-- Menu desktop -->
    <div class="hidden lg:flex items-center gap-5 xl:gap-8">
        <?php
        if ( has_nav_menu( 'menu-principal' ) ) {
            wp_nav_menu( array(
                'theme_location' => 'menu-principal',
                'container'      => false,
                'items_wrap'     => '%3$s',
                'walker'         => new RCG_Nav_Walker(),
                'fallback_cb'    => 'rcg_menu_fallback',
            ) );
        } else {
            rcg_menu_fallback( array() );
        }
        ?>
    </div>

    <!-- Bouton CTA Header -->
    <?php
    $contact_page = get_page_by_path( 'contact' );
    $contact_url  = $contact_page ? get_permalink( $contact_page ) : '#';
    ?>
    <a href="<?php echo esc_url( $contact_url ); ?>" class="hidden lg:inline-block bg-primary text-white text-[11px] font-bold uppercase tracking-widest px-6 py-3 rounded-btn hover:bg-red-700 transition-all">
        <?php esc_html_e( 'Nous contacter', 'rcg' ); ?>
    </a>

    <!-- Bouton menu mobile -->
    <button id="rcg-mobile-toggle" class="lg:hidden flex flex-col gap-1.5 p-2" aria-label="<?php esc_attr_e( 'Ouvrir le menu', 'rcg' ); ?>" aria-expanded="false">
        <span class="block w-6 h-0.5 bg-background-dark transition-all"></span>
        <span class="block w-6 h-0.5 bg-background-dark transition-all"></span>
        <span class="block w-4 h-0.5 bg-background-dark transition-all"></span>
    </button>
</nav>

<!-- Menu mobile (cache par defaut) -->
<div id="rcg-mobile-menu" class="hidden fixed inset-0 top-[72px] z-40 bg-white px-6 py-8 flex flex-col gap-6 lg:hidden overflow-y-auto">
    <div class="flex flex-col gap-6">
    <?php
    if ( has_nav_menu( 'menu-principal' ) ) {
        wp_nav_menu( array(
            'theme_location' => 'menu-principal',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'walker'         => new RCG_Nav_Walker(),
            'fallback_cb'    => 'rcg_menu_fallback',
        ) );
    } else {
        rcg_menu_fallback( array() );
    }
    ?>
    </div>
    <a href="<?php echo esc_url( $contact_url ); ?>" class="bg-primary text-white text-xs font-bold uppercase tracking-widest px-6 py-4 rounded-btn text-center hover:bg-red-700 transition-all">
        <?php esc_html_e( 'Nous contacter', 'rcg' ); ?>
    </a>
</div>
