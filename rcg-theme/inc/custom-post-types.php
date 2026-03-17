<?php
/**
 * Custom Post Types et Taxonomies
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enregistrement des CPT et taxonomies
 */
function rcg_register_post_types() {

    // === CPT : Realisations ===
    // has_archive desactive : on utilise la page "Realisations" avec template personnalise
    register_post_type( 'realisation', array(
        'labels' => array(
            'name'               => __( 'Realisations', 'rcg' ),
            'singular_name'      => __( 'Realisation', 'rcg' ),
            'add_new'            => __( 'Ajouter', 'rcg' ),
            'add_new_item'       => __( 'Ajouter une realisation', 'rcg' ),
            'edit_item'          => __( 'Modifier la realisation', 'rcg' ),
            'new_item'           => __( 'Nouvelle realisation', 'rcg' ),
            'view_item'          => __( 'Voir la realisation', 'rcg' ),
            'search_items'       => __( 'Rechercher une realisation', 'rcg' ),
            'not_found'          => __( 'Aucune realisation trouvee', 'rcg' ),
            'not_found_in_trash' => __( 'Aucune realisation dans la corbeille', 'rcg' ),
            'all_items'          => __( 'Toutes les realisations', 'rcg' ),
            'menu_name'          => __( 'Realisations', 'rcg' ),
        ),
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'realisation' ),
        'menu_icon'          => 'dashicons-portfolio',
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
        'show_in_rest'       => true,
    ) );

    // === CPT : Expertises ===
    // has_archive desactive : on utilise la page "Expertises" avec template personnalise
    register_post_type( 'expertise', array(
        'labels' => array(
            'name'               => __( 'Expertises', 'rcg' ),
            'singular_name'      => __( 'Expertise', 'rcg' ),
            'add_new'            => __( 'Ajouter', 'rcg' ),
            'add_new_item'       => __( 'Ajouter une expertise', 'rcg' ),
            'edit_item'          => __( 'Modifier l\'expertise', 'rcg' ),
            'new_item'           => __( 'Nouvelle expertise', 'rcg' ),
            'view_item'          => __( 'Voir l\'expertise', 'rcg' ),
            'search_items'       => __( 'Rechercher une expertise', 'rcg' ),
            'not_found'          => __( 'Aucune expertise trouvee', 'rcg' ),
            'not_found_in_trash' => __( 'Aucune expertise dans la corbeille', 'rcg' ),
            'all_items'          => __( 'Toutes les expertises', 'rcg' ),
            'menu_name'          => __( 'Expertises', 'rcg' ),
        ),
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'expertise' ),
        'menu_icon'          => 'dashicons-lightbulb',
        'menu_position'      => 6,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'revisions' ),
        'show_in_rest'       => true,
    ) );

    // === CPT : Membres de l'equipe ===
    register_post_type( 'membre', array(
        'labels' => array(
            'name'               => __( 'Equipe', 'rcg' ),
            'singular_name'      => __( 'Membre', 'rcg' ),
            'add_new'            => __( 'Ajouter', 'rcg' ),
            'add_new_item'       => __( 'Ajouter un membre', 'rcg' ),
            'edit_item'          => __( 'Modifier le membre', 'rcg' ),
            'new_item'           => __( 'Nouveau membre', 'rcg' ),
            'view_item'          => __( 'Voir le membre', 'rcg' ),
            'search_items'       => __( 'Rechercher un membre', 'rcg' ),
            'not_found'          => __( 'Aucun membre trouve', 'rcg' ),
            'not_found_in_trash' => __( 'Aucun membre dans la corbeille', 'rcg' ),
            'all_items'          => __( 'Tous les membres', 'rcg' ),
            'menu_name'          => __( 'Equipe', 'rcg' ),
        ),
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'equipe' ),
        'menu_icon'          => 'dashicons-groups',
        'menu_position'      => 7,
        'supports'           => array( 'title', 'thumbnail', 'excerpt', 'page-attributes', 'revisions' ),
        'show_in_rest'       => true,
    ) );

    // === Taxonomie : Thematique Insights (pour les posts natifs) ===
    register_taxonomy( 'thematique_insight', array( 'post' ), array(
        'labels' => array(
            'name'              => __( 'Thématiques Insights', 'rcg' ),
            'singular_name'     => __( 'Thématique', 'rcg' ),
            'search_items'      => __( 'Rechercher', 'rcg' ),
            'all_items'         => __( 'Toutes les thématiques', 'rcg' ),
            'edit_item'         => __( 'Modifier la thématique', 'rcg' ),
            'update_item'       => __( 'Mettre à jour', 'rcg' ),
            'add_new_item'      => __( 'Ajouter une thématique', 'rcg' ),
            'new_item_name'     => __( 'Nouvelle thématique', 'rcg' ),
            'menu_name'         => __( 'Thématiques', 'rcg' ),
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'thematique' ),
        'show_in_rest'      => true,
    ) );

    // === Taxonomie : Categorie d'expertise (pour les realisations) ===
    register_taxonomy( 'categorie_expertise', array( 'realisation' ), array(
        'labels' => array(
            'name'              => __( 'Categories d\'expertise', 'rcg' ),
            'singular_name'     => __( 'Categorie d\'expertise', 'rcg' ),
            'search_items'      => __( 'Rechercher', 'rcg' ),
            'all_items'         => __( 'Toutes les categories', 'rcg' ),
            'edit_item'         => __( 'Modifier la categorie', 'rcg' ),
            'update_item'       => __( 'Mettre a jour', 'rcg' ),
            'add_new_item'      => __( 'Ajouter une categorie', 'rcg' ),
            'new_item_name'     => __( 'Nouvelle categorie', 'rcg' ),
            'menu_name'         => __( 'Categories', 'rcg' ),
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categorie-expertise' ),
        'show_in_rest'      => true,
    ) );
}
add_action( 'init', 'rcg_register_post_types' );

/**
 * Flush rewrite rules a l'activation du theme
 */
function rcg_rewrite_flush() {
    rcg_register_post_types();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'rcg_rewrite_flush' );
