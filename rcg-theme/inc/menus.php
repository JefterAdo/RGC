<?php
/**
 * Configuration des menus de navigation
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Walker personnalise pour le menu principal (classes Tailwind)
 */
class RCG_Nav_Walker extends Walker_Nav_Menu {

    /**
     * Ouvre un element de menu <li>
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = array();

        // Menu principal (depth 0)
        if ( 0 === $depth ) {
            $link_classes = 'text-[11px] font-semibold uppercase tracking-widest text-background-dark hover:text-primary transition-colors';
        } else {
            $link_classes = 'text-xs text-gray-600 hover:text-primary transition-colors';
        }

        // Lien actif
        if ( in_array( 'current-menu-item', (array) $item->classes, true ) ) {
            $link_classes .= ' text-primary';
        }

        $atts = array(
            'href'  => ! empty( $item->url ) ? $item->url : '',
            'class' => $link_classes,
        );

        if ( ! empty( $item->target ) ) {
            $atts['target'] = $item->target;
        }

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $output .= '<a' . $attributes . '>';
        $output .= esc_html( $item->title );
        $output .= '</a>';
    }

    /**
     * Pas de <li> wrapper — liens directs dans la nav
     */
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        // Pas de fermeture </li> car on n'en ouvre pas
    }

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        // Pas de sous-menu wrapper
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        // Pas de sous-menu wrapper
    }
}

/**
 * Walker pour le menu footer (listes avec styles Tailwind)
 */
class RCG_Footer_Walker extends Walker_Nav_Menu {

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $output .= '<li>';

        $atts = array(
            'href'  => ! empty( $item->url ) ? $item->url : '',
            'class' => 'hover:text-primary transition-colors',
        );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $output .= '<a' . $attributes . '>';
        $output .= esc_html( $item->title );
        $output .= '</a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="space-y-3 text-sm text-white/60">';
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }
}

/**
 * Walker pour le menu legal (liens horizontaux)
 */
class RCG_Legal_Walker extends Walker_Nav_Menu {

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $atts = array(
            'href'  => ! empty( $item->url ) ? $item->url : '',
            'class' => 'hover:text-white transition-colors',
        );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $output .= '<a' . $attributes . '>';
        $output .= esc_html( $item->title );
        $output .= '</a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        // Pas de wrapper
    }
}

/**
 * Fallback si aucun menu n'est assigne — affiche les 5 liens par defaut
 */
function rcg_menu_fallback( $args ) {
    $menu_items = array(
        'a-propos'      => 'À Propos',
        'expertises'    => 'Expertises',
        'realisations'  => 'Réalisations',
        'insights'      => 'Insights',
        'equipe'        => 'Équipe',
    );

    $link_classes = 'text-[11px] font-semibold uppercase tracking-widest text-background-dark hover:text-primary transition-colors';

    foreach ( $menu_items as $slug => $label ) {
        $page = get_page_by_path( $slug );
        if ( $page ) {
            $url = get_permalink( $page );
        } else {
            $url = home_url( '/' . $slug . '/' );
        }

        $is_current = is_page( $slug );
        $current_class = $is_current ? ' text-primary' : '';

        echo '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $link_classes . $current_class ) . '">';
        echo esc_html( $label );
        echo '</a>';
    }
}

/**
 * Cree automatiquement le menu principal avec les 5 pages au switch du theme
 */
function rcg_create_default_menus() {
    $menu_name     = 'Menu Principal RCG';
    $menu_location = 'menu-principal';

    // Verifier si le menu existe deja
    $menu_exists = wp_get_nav_menu_object( $menu_name );
    if ( $menu_exists ) {
        // S'assurer qu'il est assigne a l'emplacement
        $locations = get_theme_mod( 'nav_menu_locations' );
        if ( empty( $locations[ $menu_location ] ) ) {
            $locations[ $menu_location ] = $menu_exists->term_id;
            set_theme_mod( 'nav_menu_locations', $locations );
        }
        return;
    }

    // Creer le menu
    $menu_id = wp_create_nav_menu( $menu_name );
    if ( is_wp_error( $menu_id ) ) {
        return;
    }

    // Elements du menu
    $menu_items = array(
        array( 'title' => 'À Propos',      'slug' => 'a-propos' ),
        array( 'title' => 'Expertises',     'slug' => 'expertises' ),
        array( 'title' => 'Réalisations',   'slug' => 'realisations' ),
        array( 'title' => 'Insights',       'slug' => 'insights' ),
        array( 'title' => 'Équipe',         'slug' => 'equipe' ),
    );

    $order = 1;
    foreach ( $menu_items as $item ) {
        $page = get_page_by_path( $item['slug'] );

        if ( $page ) {
            // Lien vers la page existante
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => $item['title'],
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $page->ID,
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
                'menu-item-position'  => $order,
            ) );
        } else {
            // Lien personnalise si la page n'existe pas encore
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'  => $item['title'],
                'menu-item-url'    => home_url( '/' . $item['slug'] . '/' ),
                'menu-item-type'   => 'custom',
                'menu-item-status' => 'publish',
                'menu-item-position' => $order,
            ) );
        }
        $order++;
    }

    // Assigner le menu a l'emplacement
    $locations = get_theme_mod( 'nav_menu_locations' );
    if ( ! is_array( $locations ) ) {
        $locations = array();
    }
    $locations[ $menu_location ] = $menu_id;
    set_theme_mod( 'nav_menu_locations', $locations );
}
add_action( 'after_switch_theme', 'rcg_create_default_menus' );

/**
 * Cree aussi le menu via admin_init au cas ou le theme est deja actif
 */
function rcg_ensure_default_menus() {
    $locations = get_theme_mod( 'nav_menu_locations' );
    if ( empty( $locations['menu-principal'] ) ) {
        rcg_create_default_menus();
    }
}
add_action( 'admin_init', 'rcg_ensure_default_menus' );
