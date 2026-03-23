<?php
/**
 * RCG Theme - Zones de widgets
 *
 * Enregistrement des sidebars et zones de widgets du theme.
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enregistre les zones de widgets du theme.
 */
function rcg_widgets_init() {

    // Footer : Newsletter
    register_sidebar( array(
        'name'          => __( 'Footer Newsletter', 'rcg' ),
        'id'            => 'footer-newsletter',
        'description'   => __( 'Zone widget pour le formulaire newsletter du footer.', 'rcg' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="text-sm font-bold uppercase tracking-widest mb-6 border-b border-white/10 pb-2">',
        'after_title'   => '</h4>',
    ) );

    // Sidebar : Articles / Insights
    register_sidebar( array(
        'name'          => __( 'Sidebar Blog', 'rcg' ),
        'id'            => 'sidebar-blog',
        'description'   => __( 'Sidebar affichee sur les articles et archives du blog (Insights).', 'rcg' ),
        'before_widget' => '<div id="%1$s" class="widget mb-10 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-bold text-xs uppercase tracking-widest text-background-dark mb-4 pb-2 border-b border-gray-100">',
        'after_title'   => '</h4>',
    ) );

    // Sidebar : Page Contact
    register_sidebar( array(
        'name'          => __( 'Sidebar Contact', 'rcg' ),
        'id'            => 'sidebar-contact',
        'description'   => __( 'Zone widget sous les infos de contact (horaires, reseaux sociaux, etc.).', 'rcg' ),
        'before_widget' => '<div id="%1$s" class="widget mt-8 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="text-[10px] font-semibold uppercase tracking-[2px] text-primary mb-3">',
        'after_title'   => '</h4>',
    ) );

    // Footer : Colonne supplementaire
    register_sidebar( array(
        'name'          => __( 'Footer Extra', 'rcg' ),
        'id'            => 'footer-extra',
        'description'   => __( 'Colonne supplementaire dans le footer (certifications, badges, partenaires).', 'rcg' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="text-sm font-bold uppercase tracking-widest text-white mb-4">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'rcg_widgets_init' );
