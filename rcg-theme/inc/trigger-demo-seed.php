<?php
/**
 * Trigger ponctuel : force le re-seed des articles et menus demo.
 * Ce fichier peut etre supprime apres execution.
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function rcg_trigger_demo_reseed() {
    // Supprimer les flags pour forcer le re-seed
    delete_option( 'rcg_demo_posts_created' );
    delete_option( 'rcg_demo_menus_created' );

    // Appeler les fonctions de seed
    if ( function_exists( 'rcg_create_demo_posts' ) ) {
        rcg_create_demo_posts();
    }
    if ( function_exists( 'rcg_create_demo_menus' ) ) {
        rcg_create_demo_menus();
    }

    // Se desactiver apres execution
    delete_option( 'rcg_trigger_reseed' );

    // Notifier l'admin
    add_action( 'admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible"><p><strong>RCG :</strong> Articles Insights et menus de demonstration crees avec succes.</p></div>';
    } );
}

// Executer une seule fois au prochain admin_init
if ( ! get_option( 'rcg_demo_posts_created' ) || ! get_option( 'rcg_demo_menus_created' ) ) {
    add_action( 'admin_init', 'rcg_trigger_demo_reseed', 5 );
}
