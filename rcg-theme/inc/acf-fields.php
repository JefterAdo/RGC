<?php
/**
 * Champs ACF Pro - Definition programmatique
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enregistrement des groupes de champs ACF
 */
function rcg_register_acf_fields() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // ========================================
    // GROUPE : Page d'accueil - Hero
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_hero',
        'title'    => 'Section Hero',
        'fields'   => array(
            array(
                'key'   => 'field_hero_label',
                'label' => 'Label',
                'name'  => 'hero_label',
                'type'  => 'text',
                'default_value' => 'Communication Strategique',
            ),
            array(
                'key'   => 'field_hero_title',
                'label' => 'Titre principal',
                'name'  => 'hero_title',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => "L'intelligence au service de votre communication",
            ),
            array(
                'key'   => 'field_hero_description',
                'label' => 'Description',
                'name'  => 'hero_description',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => "Accompagner les decideurs, les institutions et les organisations dans leurs enjeux de reputation, d'influence et de visibilite en Afrique de l'Ouest.",
            ),
            array(
                'key'   => 'field_hero_image',
                'label' => 'Image Hero',
                'name'  => 'hero_image',
                'type'  => 'image',
                'return_format' => 'array',
                'preview_size'  => 'card-medium',
            ),
            array(
                'key'   => 'field_hero_cta1_text',
                'label' => 'CTA 1 - Texte',
                'name'  => 'hero_cta1_text',
                'type'  => 'text',
                'default_value' => 'Decouvrir nos expertises',
            ),
            array(
                'key'   => 'field_hero_cta1_url',
                'label' => 'CTA 1 - URL',
                'name'  => 'hero_cta1_url',
                'type'  => 'url',
            ),
            array(
                'key'   => 'field_hero_cta2_text',
                'label' => 'CTA 2 - Texte',
                'name'  => 'hero_cta2_text',
                'type'  => 'text',
                'default_value' => 'Voir nos realisations',
            ),
            array(
                'key'   => 'field_hero_cta2_url',
                'label' => 'CTA 2 - URL',
                'name'  => 'hero_cta2_url',
                'type'  => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ),
            ),
        ),
        'menu_order' => 0,
    ) );

    // ========================================
    // GROUPE : Page d'accueil - Compteurs
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_counters',
        'title'    => 'Compteurs (Hero)',
        'fields'   => array(
            array(
                'key'        => 'field_counters',
                'label'      => 'Compteurs',
                'name'       => 'hero_counters',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 4,
                'layout'     => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_counter_value',
                        'label' => 'Valeur',
                        'name'  => 'value',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_counter_label',
                        'label' => 'Label',
                        'name'  => 'label',
                        'type'  => 'text',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ),
            ),
        ),
        'menu_order' => 1,
    ) );

    // ========================================
    // GROUPE : Page d'accueil - Positionnement
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_positioning',
        'title'    => 'Section Positionnement',
        'fields'   => array(
            array(
                'key'   => 'field_pos_label',
                'label' => 'Label section',
                'name'  => 'pos_label',
                'type'  => 'text',
                'default_value' => 'Notre Positionnement',
            ),
            array(
                'key'   => 'field_pos_title',
                'label' => 'Titre',
                'name'  => 'pos_title',
                'type'  => 'textarea',
                'rows'  => 2,
                'default_value' => "Acteur majeur de la communication institutionnelle",
            ),
            array(
                'key'        => 'field_pos_cards',
                'label'      => 'Cartes',
                'name'       => 'pos_cards',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 6,
                'layout'     => 'block',
                'sub_fields' => array(
                    array(
                        'key'          => 'field_pos_card_icon',
                        'label'        => 'Icone Material Symbol',
                        'name'         => 'icon',
                        'type'         => 'text',
                        'instructions' => 'Nom de l\'icone Material Symbols (ex: account_balance, public, corporate_fare, rocket_launch)',
                    ),
                    array(
                        'key'   => 'field_pos_card_title',
                        'label' => 'Titre',
                        'name'  => 'title',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_pos_card_desc',
                        'label' => 'Description',
                        'name'  => 'description',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ),
            ),
        ),
        'menu_order' => 2,
    ) );

    // ========================================
    // GROUPE : Page d'accueil - Pourquoi RCG
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_why_rcg',
        'title'    => 'Section Pourquoi RCG',
        'fields'   => array(
            array(
                'key'   => 'field_why_label',
                'label' => 'Label section',
                'name'  => 'why_label',
                'type'  => 'text',
                'default_value' => 'Pourquoi RCG ?',
            ),
            array(
                'key'   => 'field_why_title',
                'label' => 'Titre',
                'name'  => 'why_title',
                'type'  => 'textarea',
                'rows'  => 2,
                'default_value' => "L'excellence operationnelle au coeur de notre demarche",
            ),
            array(
                'key'        => 'field_why_values',
                'label'      => 'Valeurs / Points forts',
                'name'       => 'why_values',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 8,
                'layout'     => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_why_value_name',
                        'label' => 'Nom',
                        'name'  => 'name',
                        'type'  => 'text',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ),
            ),
        ),
        'menu_order' => 4,
    ) );

    // ========================================
    // GROUPE : Options - Reseaux Sociaux
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_social',
        'title'    => 'Reseaux Sociaux',
        'fields'   => array(
            array(
                'key'   => 'field_linkedin_url',
                'label' => 'LinkedIn URL',
                'name'  => 'rcg_linkedin_url',
                'type'  => 'url',
            ),
            array(
                'key'   => 'field_twitter_url',
                'label' => 'Twitter / X URL',
                'name'  => 'rcg_twitter_url',
                'type'  => 'url',
            ),
            array(
                'key'   => 'field_facebook_url',
                'label' => 'Facebook URL',
                'name'  => 'rcg_facebook_url',
                'type'  => 'url',
            ),
            array(
                'key'   => 'field_instagram_url',
                'label' => 'Instagram URL',
                'name'  => 'rcg_instagram_url',
                'type'  => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'acf-options-reseaux-sociaux',
                ),
            ),
        ),
    ) );

    // ========================================
    // GROUPE : Options - Adresses
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_addresses',
        'title'    => 'Adresses',
        'fields'   => array(
            array(
                'key'        => 'field_addresses',
                'label'      => 'Adresses',
                'name'       => 'rcg_addresses',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 5,
                'layout'     => 'block',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_address_city',
                        'label' => 'Ville / Pays',
                        'name'  => 'city',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_address_line1',
                        'label' => 'Adresse ligne 1',
                        'name'  => 'line1',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_address_line2',
                        'label' => 'Adresse ligne 2',
                        'name'  => 'line2',
                        'type'  => 'text',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'acf-options-adresses-contact',
                ),
            ),
        ),
    ) );

    // ========================================
    // GROUPE : CPT Expertise - Champs enrichis
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_expertise_fields',
        'title'    => 'Details Expertise',
        'fields'   => array(
            // --- Identite ---
            array(
                'key'          => 'field_expertise_number',
                'label'        => 'Numero',
                'name'         => 'expertise_number',
                'type'         => 'text',
                'instructions' => 'Ex: 01, 02, 03...',
            ),
            array(
                'key'          => 'field_expertise_icon',
                'label'        => 'Icone Material Symbol',
                'name'         => 'expertise_icon',
                'type'         => 'text',
                'instructions' => 'Nom de l\'icone (ex: strategy, image, newspaper)',
            ),
            array(
                'key'   => 'field_expertise_anchor',
                'label' => 'Ancre URL',
                'name'  => 'expertise_anchor',
                'type'  => 'text',
                'instructions' => 'Identifiant pour le lien (ex: strategie, image, medias)',
            ),
            array(
                'key'   => 'field_expertise_eyebrow',
                'label' => 'Sous-titre (eyebrow)',
                'name'  => 'expertise_eyebrow',
                'type'  => 'text',
                'instructions' => 'Ex: Expertise Strategique, Gestion d\'Image...',
            ),
            // --- Couleur de fond de section ---
            array(
                'key'           => 'field_expertise_bg',
                'label'         => 'Fond de section',
                'name'          => 'expertise_bg',
                'type'          => 'select',
                'choices'       => array(
                    'white'        => 'Blanc (bg-white)',
                    'gray'         => 'Gris clair (bg-[#f4f4f4])',
                    'surface-dark' => 'Sombre (bg-surface-dark)',
                    'dark'         => 'Tres sombre (bg-background-dark)',
                ),
                'default_value' => 'white',
            ),
            // --- Image de section ---
            array(
                'key'           => 'field_expertise_image',
                'label'         => 'Image de section',
                'name'          => 'expertise_image',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'card-medium',
                'instructions'  => 'Image affichee a cote du texte dans la page Expertises.',
            ),
            // --- Citation / quote ---
            array(
                'key'   => 'field_expertise_quote',
                'label' => 'Citation (optionnel)',
                'name'  => 'expertise_quote',
                'type'  => 'textarea',
                'rows'  => 2,
                'instructions' => 'Citation affichee sur l\'image.',
            ),
            // --- Layout (image a gauche ou droite) ---
            array(
                'key'           => 'field_expertise_layout',
                'label'         => 'Disposition',
                'name'          => 'expertise_layout',
                'type'          => 'select',
                'choices'       => array(
                    'text-left'  => 'Texte a gauche, Image a droite',
                    'text-right' => 'Texte a droite, Image a gauche',
                ),
                'default_value' => 'text-left',
            ),
            // --- Points cles / etapes ---
            array(
                'key'          => 'field_expertise_type_liste',
                'label'        => 'Type de liste',
                'name'         => 'expertise_list_type',
                'type'         => 'select',
                'choices'      => array(
                    'steps'     => 'Etapes (timeline 01, 02, 03)',
                    'arrows'    => 'Fleches (liste a puces)',
                    'hover'     => 'Liste hover (avec icone north_east)',
                    'cards'     => 'Grille de cartes (icones + titres)',
                    'timeline'  => 'Timeline crise (T+0, T+4h...)',
                ),
                'default_value' => 'arrows',
            ),
            array(
                'key'        => 'field_expertise_items',
                'label'      => 'Elements de liste',
                'name'       => 'expertise_items',
                'type'       => 'repeater',
                'min'        => 0,
                'max'        => 10,
                'layout'     => 'block',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_exp_item_icon',
                        'label' => 'Icone (optionnel)',
                        'name'  => 'icon',
                        'type'  => 'text',
                        'instructions' => 'Material Symbol ou label (ex: 01, T+0)',
                    ),
                    array(
                        'key'   => 'field_exp_item_title',
                        'label' => 'Titre',
                        'name'  => 'title',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_exp_item_desc',
                        'label' => 'Description',
                        'name'  => 'description',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ),
                ),
            ),
            // --- Statistiques / compteurs ---
            array(
                'key'        => 'field_expertise_stats',
                'label'      => 'Statistiques (optionnel)',
                'name'       => 'expertise_stats',
                'type'       => 'repeater',
                'min'        => 0,
                'max'        => 4,
                'layout'     => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_exp_stat_value',
                        'label' => 'Valeur',
                        'name'  => 'value',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_exp_stat_label',
                        'label' => 'Label',
                        'name'  => 'label',
                        'type'  => 'text',
                    ),
                ),
            ),
            // --- Tags (badges affiches sur l'image) ---
            array(
                'key'        => 'field_expertise_tags',
                'label'      => 'Tags image (optionnel)',
                'name'       => 'expertise_tags',
                'type'       => 'repeater',
                'min'        => 0,
                'max'        => 4,
                'layout'     => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_exp_tag_text',
                        'label' => 'Texte',
                        'name'  => 'text',
                        'type'  => 'text',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'expertise',
                ),
            ),
        ),
    ) );

    // ========================================
    // GROUPE : CPT Realisation - Champs enrichis
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_realisation_fields',
        'title'    => 'Details Realisation',
        'fields'   => array(
            array(
                'key'   => 'field_real_client',
                'label' => 'Client',
                'name'  => 'realisation_client',
                'type'  => 'text',
                'instructions' => 'Ex: Groupe Bancaire Leader - Abidjan',
            ),
            array(
                'key'   => 'field_real_year',
                'label' => 'Annee',
                'name'  => 'realisation_year',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_real_short_desc',
                'label' => 'Description courte',
                'name'  => 'realisation_short_desc',
                'type'  => 'textarea',
                'rows'  => 3,
            ),
            array(
                'key'           => 'field_real_badge_color',
                'label'         => 'Couleur du badge categorie',
                'name'          => 'realisation_badge_color',
                'type'          => 'select',
                'instructions'  => 'Couleur affichee sur la carte.',
                'choices'       => array(
                    'red'    => 'Rouge (Com. de Crise)',
                    'green'  => 'Vert (Entreprise)',
                    'blue'   => 'Bleu (Institution Publique)',
                    'amber'  => 'Ambre (Org. Internationale)',
                ),
                'default_value' => 'red',
            ),
            array(
                'key'           => 'field_real_is_crisis',
                'label'         => 'Mission de crise ?',
                'name'          => 'realisation_is_crisis',
                'type'          => 'true_false',
                'instructions'  => 'Affiche un point rouge pulsant sur le badge.',
                'default_value' => 0,
                'ui'            => 1,
            ),
            array(
                'key'           => 'field_real_is_featured',
                'label'         => 'Mission Signature ?',
                'name'          => 'realisation_is_featured',
                'type'          => 'true_false',
                'instructions'  => 'Affiche cette realisation en large dans la section "Mission Signature".',
                'default_value' => 0,
                'ui'            => 1,
            ),
            array(
                'key'        => 'field_real_results',
                'label'      => 'Resultats cles',
                'name'       => 'realisation_results',
                'type'       => 'repeater',
                'min'        => 0,
                'max'        => 6,
                'layout'     => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_real_result_text',
                        'label' => 'Resultat',
                        'name'  => 'text',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'key'        => 'field_real_kpis',
                'label'      => 'KPIs (Mission Signature)',
                'name'       => 'realisation_kpis',
                'type'       => 'repeater',
                'min'        => 0,
                'max'        => 4,
                'layout'     => 'table',
                'instructions' => 'Chiffres cles affiches dans la section Mission Signature.',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_real_kpi_value',
                        'label' => 'Valeur',
                        'name'  => 'value',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_real_kpi_label',
                        'label' => 'Label',
                        'name'  => 'label',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'key'        => 'field_real_tags',
                'label'      => 'Tags',
                'name'       => 'realisation_tags',
                'type'       => 'repeater',
                'min'        => 0,
                'max'        => 4,
                'layout'     => 'table',
                'instructions' => 'Ex: Institution Publique, Cote d\'Ivoire',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_real_tag_text',
                        'label' => 'Tag',
                        'name'  => 'text',
                        'type'  => 'text',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'realisation',
                ),
            ),
        ),
    ) );

    // ========================================
    // GROUPE : Page Realisations - Sections
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_page_realisations',
        'title'    => 'Page Realisations - Contenus',
        'fields'   => array(
            // --- Hero ---
            array(
                'key'   => 'field_real_page_eyebrow',
                'label' => 'Eyebrow Hero',
                'name'  => 'real_page_eyebrow',
                'type'  => 'text',
                'default_value' => 'Preuves d\'Impact',
            ),
            array(
                'key'   => 'field_real_page_title',
                'label' => 'Titre Hero',
                'name'  => 'real_page_title',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => "Des resultats qui parlent d'eux-memes.",
            ),
            array(
                'key'   => 'field_real_page_desc',
                'label' => 'Description Hero',
                'name'  => 'real_page_desc',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => "Gouvernements, institutions internationales, entreprises panafricaines : decouvrez les missions qui ont transforme les perceptions et bati des reputations.",
            ),
            array(
                'key'           => 'field_real_page_hero_image',
                'label'         => 'Image Hero',
                'name'          => 'real_page_hero_image',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'card-medium',
            ),
            // --- Stats ---
            array(
                'key'        => 'field_real_page_stats',
                'label'      => 'Statistiques (barre)',
                'name'       => 'real_page_stats',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 4,
                'layout'     => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_real_stat_value',
                        'label' => 'Valeur',
                        'name'  => 'value',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_real_stat_label',
                        'label' => 'Label',
                        'name'  => 'label',
                        'type'  => 'text',
                    ),
                    array(
                        'key'           => 'field_real_stat_highlight',
                        'label'         => 'Valeur en rouge ?',
                        'name'          => 'highlight',
                        'type'          => 'true_false',
                        'default_value' => 0,
                        'ui'            => 1,
                    ),
                ),
            ),
            // --- Citation ---
            array(
                'key'   => 'field_real_page_quote',
                'label' => 'Citation',
                'name'  => 'real_page_quote',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => "Nous ne mesurons pas notre succes en titres de presse. Nous le mesurons en decisions politiques, en contrats signes et en reputations preservees.",
            ),
            array(
                'key'   => 'field_real_page_quote_author',
                'label' => 'Auteur citation',
                'name'  => 'real_page_quote_author',
                'type'  => 'text',
                'default_value' => 'Direction Generale — RCG West Africa',
            ),
            // --- Secteurs ---
            array(
                'key'   => 'field_real_page_secteurs_title',
                'label' => 'Titre secteurs',
                'name'  => 'real_page_secteurs_title',
                'type'  => 'text',
                'default_value' => 'Une expertise transversale, des resultats cibles',
            ),
            array(
                'key'   => 'field_real_page_secteurs_desc',
                'label' => 'Description secteurs',
                'name'  => 'real_page_secteurs_desc',
                'type'  => 'textarea',
                'rows'  => 2,
            ),
            array(
                'key'        => 'field_real_page_secteurs',
                'label'      => 'Secteurs d\'intervention',
                'name'       => 'real_page_secteurs',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 8,
                'layout'     => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_real_secteur_icon',
                        'label' => 'Icone Material',
                        'name'  => 'icon',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_real_secteur_label',
                        'label' => 'Label',
                        'name'  => 'label',
                        'type'  => 'text',
                    ),
                ),
            ),
            // --- Timeline ---
            array(
                'key'        => 'field_real_page_timeline',
                'label'      => 'Timeline (Histoire & Impact)',
                'name'       => 'real_page_timeline',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 10,
                'layout'     => 'block',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_real_tl_year',
                        'label' => 'Annee',
                        'name'  => 'year',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_real_tl_title',
                        'label' => 'Titre',
                        'name'  => 'title',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_real_tl_desc',
                        'label' => 'Description',
                        'name'  => 'description',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ),
                    array(
                        'key'           => 'field_real_tl_current',
                        'label'         => 'Annee actuelle ?',
                        'name'          => 'is_current',
                        'type'          => 'true_false',
                        'default_value' => 0,
                        'ui'            => 1,
                    ),
                ),
            ),
            // --- Expertises droite timeline ---
            array(
                'key'        => 'field_real_page_expertises_list',
                'label'      => 'Liste expertises (colonne droite timeline)',
                'name'       => 'real_page_expertises_list',
                'type'       => 'repeater',
                'min'        => 0,
                'max'        => 8,
                'layout'     => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_real_exp_label',
                        'label' => 'Label',
                        'name'  => 'label',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'key'   => 'field_real_page_callout_value',
                'label' => 'Callout - Valeur (ex: 48h)',
                'name'  => 'real_page_callout_value',
                'type'  => 'text',
                'default_value' => '48h',
            ),
            array(
                'key'   => 'field_real_page_callout_text',
                'label' => 'Callout - Texte',
                'name'  => 'real_page_callout_text',
                'type'  => 'text',
                'default_value' => 'Delai max d\'activation d\'une cellule de crise',
            ),
            // --- CTA ---
            array(
                'key'   => 'field_real_page_cta_title',
                'label' => 'CTA - Titre',
                'name'  => 'real_page_cta_title',
                'type'  => 'text',
                'default_value' => 'Votre mission sera notre prochaine realisation.',
            ),
            array(
                'key'   => 'field_real_page_cta_desc',
                'label' => 'CTA - Description',
                'name'  => 'real_page_cta_desc',
                'type'  => 'text',
                'default_value' => 'Contactez-nous pour discuter de votre projet et batir ensemble votre succes.',
            ),
            array(
                'key'   => 'field_real_page_cta_btn',
                'label' => 'CTA - Texte bouton',
                'name'  => 'real_page_cta_btn',
                'type'  => 'text',
                'default_value' => 'Demarrer votre projet',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-templates/page-realisations.php',
                ),
            ),
        ),
        'menu_order' => 0,
    ) );

    // ========================================
    // GROUPE : Page A Propos - Sections
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_page_apropos',
        'title'    => 'Page A Propos - Contenus',
        'fields'   => array(
            // --- Hero ---
            array(
                'key'   => 'field_ap_eyebrow',
                'label' => 'Eyebrow Hero',
                'name'  => 'ap_eyebrow',
                'type'  => 'text',
                'default_value' => 'Notre Philosophie',
            ),
            array(
                'key'   => 'field_ap_title',
                'label' => 'Titre Hero',
                'name'  => 'ap_title',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => 'Nous donnons toujours plus que promis.',
            ),
            array(
                'key'   => 'field_ap_desc',
                'label' => 'Description Hero',
                'name'  => 'ap_desc',
                'type'  => 'textarea',
                'rows'  => 3,
            ),
            array(
                'key'           => 'field_ap_hero_image',
                'label'         => 'Image Hero',
                'name'          => 'ap_hero_image',
                'type'          => 'image',
                'return_format' => 'array',
            ),
            // --- Stats ---
            array(
                'key'        => 'field_ap_stats',
                'label'      => 'Statistiques',
                'name'       => 'ap_stats',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 4,
                'layout'     => 'table',
                'sub_fields' => array(
                    array( 'key' => 'field_ap_stat_value', 'label' => 'Valeur', 'name' => 'value', 'type' => 'text' ),
                    array( 'key' => 'field_ap_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ),
                    array( 'key' => 'field_ap_stat_hl', 'label' => 'En rouge ?', 'name' => 'highlight', 'type' => 'true_false', 'default_value' => 0, 'ui' => 1 ),
                ),
            ),
            // --- Histoire ---
            array(
                'key'   => 'field_ap_hist_title',
                'label' => 'Histoire - Titre',
                'name'  => 'ap_hist_title',
                'type'  => 'text',
                'default_value' => 'Une agence née de l\'exigence',
            ),
            array(
                'key'   => 'field_ap_hist_text',
                'label' => 'Histoire - Texte',
                'name'  => 'ap_hist_text',
                'type'  => 'wysiwyg',
                'toolbar' => 'basic',
                'tabs' => 'visual',
            ),
            array(
                'key'           => 'field_ap_hist_image',
                'label'         => 'Histoire - Image',
                'name'          => 'ap_hist_image',
                'type'          => 'image',
                'return_format' => 'array',
            ),
            array(
                'key'   => 'field_ap_hist_quote',
                'label' => 'Histoire - Citation sur image',
                'name'  => 'ap_hist_quote',
                'type'  => 'textarea',
                'rows'  => 2,
                'default_value' => 'Notre mission n\'est pas d\'être visibles. Notre mission est de vous rendre inoubliables.',
            ),
            array(
                'key'        => 'field_ap_timeline',
                'label'      => 'Histoire - Timeline',
                'name'       => 'ap_timeline',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 8,
                'layout'     => 'block',
                'sub_fields' => array(
                    array( 'key' => 'field_ap_tl_abbr', 'label' => 'Abrege (ex: 06)', 'name' => 'abbr', 'type' => 'text' ),
                    array( 'key' => 'field_ap_tl_year', 'label' => 'Annee (ex: 2006)', 'name' => 'year', 'type' => 'text' ),
                    array( 'key' => 'field_ap_tl_title', 'label' => 'Titre', 'name' => 'title', 'type' => 'text' ),
                    array( 'key' => 'field_ap_tl_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 2 ),
                    array( 'key' => 'field_ap_tl_current', 'label' => 'Dernier ?', 'name' => 'is_current', 'type' => 'true_false', 'ui' => 1, 'default_value' => 0 ),
                ),
            ),
            // --- ADN / Piliers ---
            array(
                'key'   => 'field_ap_adn_quote',
                'label' => 'ADN - Citation',
                'name'  => 'ap_adn_quote',
                'type'  => 'textarea',
                'rows'  => 2,
                'default_value' => 'L\'excellence n\'est pas un objectif. C\'est notre point de départ.',
            ),
            array(
                'key'        => 'field_ap_piliers',
                'label'      => 'ADN - 5 Piliers',
                'name'       => 'ap_piliers',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 6,
                'layout'     => 'block',
                'sub_fields' => array(
                    array( 'key' => 'field_ap_pil_letter', 'label' => 'Lettre decorative', 'name' => 'letter', 'type' => 'text' ),
                    array( 'key' => 'field_ap_pil_title', 'label' => 'Titre', 'name' => 'title', 'type' => 'text' ),
                    array( 'key' => 'field_ap_pil_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 2 ),
                ),
            ),
            // --- Valeurs ---
            array(
                'key'           => 'field_ap_valeurs_image',
                'label'         => 'Valeurs - Image',
                'name'          => 'ap_valeurs_image',
                'type'          => 'image',
                'return_format' => 'array',
            ),
            array(
                'key'        => 'field_ap_valeurs',
                'label'      => 'Valeurs - Liste',
                'name'       => 'ap_valeurs',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 8,
                'layout'     => 'block',
                'sub_fields' => array(
                    array( 'key' => 'field_ap_val_icon', 'label' => 'Icone Material', 'name' => 'icon', 'type' => 'text' ),
                    array( 'key' => 'field_ap_val_title', 'label' => 'Titre', 'name' => 'title', 'type' => 'text' ),
                    array( 'key' => 'field_ap_val_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 2 ),
                ),
            ),
            // --- Presence ---
            array(
                'key'        => 'field_ap_bureaux',
                'label'      => 'Presence - Bureaux',
                'name'       => 'ap_bureaux',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 4,
                'layout'     => 'block',
                'sub_fields' => array(
                    array( 'key' => 'field_ap_bur_city', 'label' => 'Ville, Pays', 'name' => 'city', 'type' => 'text' ),
                    array( 'key' => 'field_ap_bur_subtitle', 'label' => 'Sous-titre', 'name' => 'subtitle', 'type' => 'text' ),
                    array( 'key' => 'field_ap_bur_address', 'label' => 'Adresse', 'name' => 'address', 'type' => 'text' ),
                    array( 'key' => 'field_ap_bur_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 2 ),
                    array( 'key' => 'field_ap_bur_tags', 'label' => 'Tags (separes par virgule)', 'name' => 'tags', 'type' => 'text' ),
                    array( 'key' => 'field_ap_bur_color', 'label' => 'Couleur dot', 'name' => 'dot_color', 'type' => 'select', 'choices' => array( 'red' => 'Rouge', 'green' => 'Vert' ), 'default_value' => 'red' ),
                ),
            ),
            array(
                'key'        => 'field_ap_pays',
                'label'      => 'Presence - Pays',
                'name'       => 'ap_pays',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 20,
                'layout'     => 'table',
                'sub_fields' => array(
                    array( 'key' => 'field_ap_pays_name', 'label' => 'Pays', 'name' => 'name', 'type' => 'text' ),
                    array( 'key' => 'field_ap_pays_special', 'label' => 'Special ?', 'name' => 'is_special', 'type' => 'true_false', 'ui' => 1, 'default_value' => 0 ),
                ),
            ),
            // --- Equipe stats ---
            array(
                'key'        => 'field_ap_equipe_stats',
                'label'      => 'Equipe - Stats',
                'name'       => 'ap_equipe_stats',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 4,
                'layout'     => 'table',
                'sub_fields' => array(
                    array( 'key' => 'field_ap_eq_value', 'label' => 'Valeur', 'name' => 'value', 'type' => 'text' ),
                    array( 'key' => 'field_ap_eq_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ),
                    array( 'key' => 'field_ap_eq_color', 'label' => 'Couleur bordure', 'name' => 'color', 'type' => 'select', 'choices' => array( 'primary' => 'Rouge', 'dark' => 'Noir', 'green' => 'Vert' ), 'default_value' => 'dark' ),
                ),
            ),
            // --- Equipe photos poles ---
            array(
                'key'        => 'field_ap_equipe_poles',
                'label'      => 'Equipe - Poles (photos)',
                'name'       => 'ap_equipe_poles',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 6,
                'layout'     => 'block',
                'sub_fields' => array(
                    array( 'key' => 'field_ap_pole_image', 'label' => 'Photo', 'name' => 'image', 'type' => 'image', 'return_format' => 'array' ),
                    array( 'key' => 'field_ap_pole_line1', 'label' => 'Ligne 1', 'name' => 'line1', 'type' => 'text' ),
                    array( 'key' => 'field_ap_pole_line2', 'label' => 'Ligne 2', 'name' => 'line2', 'type' => 'text' ),
                ),
            ),
            // --- CTA ---
            array(
                'key'   => 'field_ap_cta_title',
                'label' => 'CTA - Titre',
                'name'  => 'ap_cta_title',
                'type'  => 'text',
                'default_value' => 'Rejoignez nos clients d\'exception.',
            ),
            array(
                'key'   => 'field_ap_cta_desc',
                'label' => 'CTA - Description',
                'name'  => 'ap_cta_desc',
                'type'  => 'text',
                'default_value' => 'Notre équipe analyse votre contexte et vous propose une approche entièrement sur mesure.',
            ),
            array(
                'key'   => 'field_ap_cta_btn',
                'label' => 'CTA - Texte bouton',
                'name'  => 'ap_cta_btn',
                'type'  => 'text',
                'default_value' => 'Démarrer votre projet',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-templates/page-a-propos.php',
                ),
            ),
        ),
        'menu_order' => 0,
    ) );

    // ========================================
    // GROUPE : Post (Insights) - Champs article
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_insight_fields',
        'title'    => 'Détails Insight',
        'fields'   => array(
            array(
                'key'           => 'field_insight_type',
                'label'         => 'Type d\'article',
                'name'          => 'insight_type',
                'type'          => 'select',
                'instructions'  => 'Détermine la mise en page de la carte.',
                'choices'       => array(
                    'standard' => 'Standard (avec image)',
                    'opinion'  => 'Opinion / Citation (sans image)',
                    'rapport'  => 'Rapport / Data (sans image, avec statistique)',
                ),
                'default_value' => 'standard',
            ),
            array(
                'key'           => 'field_insight_card_bg',
                'label'         => 'Fond de la carte',
                'name'          => 'insight_card_bg',
                'type'          => 'select',
                'choices'       => array(
                    'light' => 'Clair (#f4f4f4)',
                    'dark'  => 'Sombre (surface-dark)',
                    'white' => 'Blanc (bordure)',
                    'black' => 'Très sombre (background-dark)',
                ),
                'default_value' => 'light',
            ),
            array(
                'key'           => 'field_insight_featured',
                'label'         => 'Article à la une ?',
                'name'          => 'insight_featured',
                'type'          => 'true_false',
                'instructions'  => 'Affiché en grand dans le hero et en carte 2 colonnes.',
                'default_value' => 0,
                'ui'            => 1,
            ),
            array(
                'key'   => 'field_insight_read_time',
                'label' => 'Temps de lecture (min)',
                'name'  => 'insight_read_time',
                'type'  => 'number',
                'default_value' => 5,
            ),
            array(
                'key'          => 'field_insight_author_initials',
                'label'        => 'Initiales auteur',
                'name'         => 'insight_author_initials',
                'type'         => 'text',
                'instructions' => 'Ex: SA, KM, AC',
            ),
            array(
                'key'   => 'field_insight_author_title',
                'label' => 'Titre auteur (optionnel)',
                'name'  => 'insight_author_title',
                'type'  => 'text',
                'instructions' => 'Ex: Fondatrice, RCG',
            ),
            // Rapport / Data
            array(
                'key'          => 'field_insight_stat_value',
                'label'        => 'Statistique (type Rapport)',
                'name'         => 'insight_stat_value',
                'type'         => 'text',
                'instructions' => 'Ex: 73%',
                'conditional_logic' => array(
                    array( array( 'field' => 'field_insight_type', 'operator' => '==', 'value' => 'rapport' ) ),
                ),
            ),
            array(
                'key'   => 'field_insight_stat_label',
                'label' => 'Légende statistique',
                'name'  => 'insight_stat_label',
                'type'  => 'text',
                'instructions' => 'Ex: des dirigeants africains interrogés',
                'conditional_logic' => array(
                    array( array( 'field' => 'field_insight_type', 'operator' => '==', 'value' => 'rapport' ) ),
                ),
            ),
            array(
                'key'   => 'field_insight_report_pages',
                'label' => 'Nombre de pages (rapport)',
                'name'  => 'insight_report_pages',
                'type'  => 'text',
                'instructions' => 'Ex: 48 pages',
                'conditional_logic' => array(
                    array( array( 'field' => 'field_insight_type', 'operator' => '==', 'value' => 'rapport' ) ),
                ),
            ),
            array(
                'key'           => 'field_insight_report_file',
                'label'         => 'Fichier PDF (rapport)',
                'name'          => 'insight_report_file',
                'type'          => 'file',
                'return_format' => 'url',
                'mime_types'    => 'pdf',
                'conditional_logic' => array(
                    array( array( 'field' => 'field_insight_type', 'operator' => '==', 'value' => 'rapport' ) ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'post',
                ),
            ),
        ),
        'menu_order' => 0,
    ) );

    // ========================================
    // GROUPE : Page Insights - Contenus
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_page_insights',
        'title'    => 'Page Insights - Contenus',
        'fields'   => array(
            array(
                'key'   => 'field_ins_hero_eyebrow',
                'label' => 'Hero - Eyebrow catégorie',
                'name'  => 'ins_hero_eyebrow',
                'type'  => 'text',
                'default_value' => 'Analyse Stratégique',
            ),
            array(
                'key'           => 'field_ins_hero_image',
                'label'         => 'Hero - Image de fond',
                'name'          => 'ins_hero_image',
                'type'          => 'image',
                'return_format' => 'array',
            ),
            // Ticker
            array(
                'key'        => 'field_ins_ticker',
                'label'      => 'Ticker (bandeau défilant)',
                'name'       => 'ins_ticker',
                'type'       => 'repeater',
                'min'        => 0,
                'max'        => 8,
                'layout'     => 'table',
                'sub_fields' => array(
                    array( 'key' => 'field_ins_ticker_text', 'label' => 'Texte', 'name' => 'text', 'type' => 'text' ),
                ),
            ),
            // Dossiers thematiques
            array(
                'key'        => 'field_ins_dossiers',
                'label'      => 'Dossiers Thématiques',
                'name'       => 'ins_dossiers',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 6,
                'layout'     => 'block',
                'sub_fields' => array(
                    array( 'key' => 'field_ins_dos_icon', 'label' => 'Icône Material', 'name' => 'icon', 'type' => 'text' ),
                    array( 'key' => 'field_ins_dos_title', 'label' => 'Titre', 'name' => 'title', 'type' => 'text' ),
                    array( 'key' => 'field_ins_dos_count', 'label' => 'Nb articles', 'name' => 'count', 'type' => 'text' ),
                    array( 'key' => 'field_ins_dos_bg', 'label' => 'Fond', 'name' => 'bg', 'type' => 'select', 'choices' => array( 'dark' => 'Sombre', 'red' => 'Rouge' ), 'default_value' => 'dark' ),
                    array( 'key' => 'field_ins_dos_link', 'label' => 'Lien (optionnel)', 'name' => 'link', 'type' => 'url' ),
                ),
            ),
            // Newsletter
            array(
                'key'   => 'field_ins_nl_title',
                'label' => 'Newsletter - Titre',
                'name'  => 'ins_nl_title',
                'type'  => 'text',
                'default_value' => 'Ne manquez aucune analyse stratégique.',
            ),
            array(
                'key'   => 'field_ins_nl_desc',
                'label' => 'Newsletter - Description',
                'name'  => 'ins_nl_desc',
                'type'  => 'textarea',
                'rows'  => 2,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-templates/page-insights.php',
                ),
            ),
        ),
        'menu_order' => 0,
    ) );

    // ========================================
    // GROUPE : CPT Membre - Champs
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_membre_fields',
        'title'    => 'Details Membre',
        'fields'   => array(
            array(
                'key'   => 'field_membre_poste',
                'label' => 'Poste / Fonction',
                'name'  => 'membre_poste',
                'type'  => 'text',
            ),
            array(
                'key'           => 'field_membre_role',
                'label'         => 'Rôle dans l\'équipe',
                'name'          => 'membre_role',
                'type'          => 'select',
                'instructions'  => 'Détermine la mise en page sur la page Équipe.',
                'choices'       => array(
                    'direction' => 'Direction (mise en avant 2 colonnes)',
                    'senior'    => 'Membre Senior (carte avec photo)',
                    'pole'      => 'Pôle opérationnel (liste)',
                ),
                'default_value' => 'senior',
            ),
            array(
                'key'   => 'field_membre_pole',
                'label' => 'Pôle',
                'name'  => 'membre_pole',
                'type'  => 'select',
                'choices' => array(
                    'strategie' => 'Stratégie & Conseil',
                    'editorial' => 'Éditorial & Contenus',
                    'evenements' => 'Événements & Protocole',
                    'veille'     => 'Veille & Intelligence',
                    'design'     => 'Design & Identité',
                ),
                'allow_null' => 1,
            ),
            array(
                'key'   => 'field_membre_bio',
                'label' => 'Biographie',
                'name'  => 'membre_bio',
                'type'  => 'wysiwyg',
                'tabs'  => 'all',
                'toolbar' => 'basic',
            ),
            array(
                'key'   => 'field_membre_bio_court',
                'label' => 'Description courte (carte)',
                'name'  => 'membre_bio_court',
                'type'  => 'text',
                'instructions' => 'Affiché sous le nom sur la carte (ex: Expertise en communication gouvernementale & CEDEAO)',
            ),
            array(
                'key'        => 'field_membre_tags',
                'label'      => 'Tags / Spécialités',
                'name'       => 'membre_tags',
                'type'       => 'repeater',
                'min'        => 0,
                'max'        => 5,
                'layout'     => 'table',
                'sub_fields' => array(
                    array( 'key' => 'field_membre_tag_label', 'label' => 'Tag', 'name' => 'label', 'type' => 'text' ),
                ),
            ),
            array(
                'key'   => 'field_membre_linkedin',
                'label' => 'LinkedIn URL',
                'name'  => 'membre_linkedin',
                'type'  => 'url',
            ),
            array(
                'key'   => 'field_membre_email',
                'label' => 'Email',
                'name'  => 'membre_email',
                'type'  => 'email',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'membre',
                ),
            ),
        ),
    ) );

    // ========================================
    // GROUPE : Page Équipe - Contenus
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_page_equipe',
        'title'    => 'Page Équipe - Contenus',
        'fields'   => array(
            // Hero
            array(
                'key'   => 'field_eq_hero_eyebrow',
                'label' => 'Hero - Eyebrow',
                'name'  => 'eq_hero_eyebrow',
                'type'  => 'text',
                'default_value' => '— Notre Équipe',
            ),
            array(
                'key'   => 'field_eq_hero_title',
                'label' => 'Hero - Titre (HTML autorisé)',
                'name'  => 'eq_hero_title',
                'type'  => 'textarea',
                'rows'  => 3,
                'new_lines' => 'br',
            ),
            array(
                'key'   => 'field_eq_hero_desc',
                'label' => 'Hero - Description',
                'name'  => 'eq_hero_desc',
                'type'  => 'textarea',
                'rows'  => 2,
            ),
            array(
                'key'           => 'field_eq_hero_image',
                'label'         => 'Hero - Image de fond',
                'name'          => 'eq_hero_image',
                'type'          => 'image',
                'return_format' => 'array',
            ),
            // Stats hero
            array(
                'key'        => 'field_eq_hero_stats',
                'label'      => 'Hero - Compteurs',
                'name'       => 'eq_hero_stats',
                'type'       => 'repeater',
                'min'        => 0,
                'max'        => 4,
                'layout'     => 'table',
                'sub_fields' => array(
                    array( 'key' => 'field_eq_stat_val', 'label' => 'Valeur', 'name' => 'value', 'type' => 'text' ),
                    array( 'key' => 'field_eq_stat_suffix', 'label' => 'Suffixe (+, etc.)', 'name' => 'suffix', 'type' => 'text' ),
                    array( 'key' => 'field_eq_stat_lbl', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ),
                ),
            ),
            // Manifesto quote
            array(
                'key'   => 'field_eq_manifesto',
                'label' => 'Citation manifesto (bandeau rouge)',
                'name'  => 'eq_manifesto',
                'type'  => 'textarea',
                'rows'  => 2,
            ),
            // Philosophie RH
            array(
                'key'   => 'field_eq_philo_eyebrow',
                'label' => 'Philosophie RH - Eyebrow',
                'name'  => 'eq_philo_eyebrow',
                'type'  => 'text',
                'default_value' => '— Notre philosophie RH',
            ),
            array(
                'key'   => 'field_eq_philo_title',
                'label' => 'Philosophie RH - Titre (HTML)',
                'name'  => 'eq_philo_title',
                'type'  => 'textarea',
                'rows'  => 2,
                'new_lines' => 'br',
            ),
            array(
                'key'   => 'field_eq_philo_desc',
                'label' => 'Philosophie RH - Description',
                'name'  => 'eq_philo_desc',
                'type'  => 'textarea',
                'rows'  => 3,
            ),
            array(
                'key'        => 'field_eq_philo_criteria',
                'label'      => 'Philosophie RH - Critères',
                'name'       => 'eq_philo_criteria',
                'type'       => 'repeater',
                'min'        => 0,
                'max'        => 6,
                'layout'     => 'table',
                'sub_fields' => array(
                    array( 'key' => 'field_eq_crit_text', 'label' => 'Critère', 'name' => 'text', 'type' => 'text' ),
                ),
            ),
            array(
                'key'   => 'field_eq_philo_cta',
                'label' => 'Philosophie RH - Texte bouton',
                'name'  => 'eq_philo_cta',
                'type'  => 'text',
                'default_value' => 'Rejoindre l\'Équipe →',
            ),
            // Poles operationnels
            array(
                'key'        => 'field_eq_poles',
                'label'      => 'Pôles Opérationnels',
                'name'       => 'eq_poles',
                'type'       => 'repeater',
                'min'        => 0,
                'max'        => 8,
                'layout'     => 'block',
                'sub_fields' => array(
                    array( 'key' => 'field_eq_pole_title', 'label' => 'Nom du pôle', 'name' => 'title', 'type' => 'text' ),
                    array( 'key' => 'field_eq_pole_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 2 ),
                    array(
                        'key'        => 'field_eq_pole_tags',
                        'label'      => 'Tags',
                        'name'       => 'tags',
                        'type'       => 'repeater',
                        'min'        => 0,
                        'max'        => 4,
                        'layout'     => 'table',
                        'sub_fields' => array(
                            array( 'key' => 'field_eq_pole_tag_l', 'label' => 'Tag', 'name' => 'label', 'type' => 'text' ),
                        ),
                    ),
                ),
            ),
            // CTA final
            array(
                'key'   => 'field_eq_cta_title',
                'label' => 'CTA - Titre',
                'name'  => 'eq_cta_title',
                'type'  => 'text',
                'default_value' => 'Travaillons ensemble.',
            ),
            array(
                'key'   => 'field_eq_cta_desc',
                'label' => 'CTA - Description',
                'name'  => 'eq_cta_desc',
                'type'  => 'text',
                'default_value' => 'Notre équipe est prête à relever vos défis les plus complexes.',
            ),
            array(
                'key'   => 'field_eq_cta_btn',
                'label' => 'CTA - Texte bouton',
                'name'  => 'eq_cta_btn',
                'type'  => 'text',
                'default_value' => 'Démarrer un projet',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-templates/page-equipe.php',
                ),
            ),
        ),
        'menu_order' => 0,
    ) );

    // ========================================
    // GROUPE : Page Contact - Contenus
    // ========================================
    acf_add_local_field_group( array(
        'key'      => 'group_page_contact',
        'title'    => 'Page Contact - Contenus',
        'fields'   => array(
            // Hero
            array(
                'key'   => 'field_ct_hero_eyebrow',
                'label' => 'Hero - Eyebrow',
                'name'  => 'ct_hero_eyebrow',
                'type'  => 'text',
                'default_value' => 'Prise de Contact',
            ),
            array(
                'key'   => 'field_ct_hero_title',
                'label' => 'Hero - Titre',
                'name'  => 'ct_hero_title',
                'type'  => 'text',
                'default_value' => 'Travaillons Ensemble.',
            ),
            array(
                'key'   => 'field_ct_hero_desc',
                'label' => 'Hero - Description',
                'name'  => 'ct_hero_desc',
                'type'  => 'text',
                'default_value' => 'Décrivez votre projet — notre équipe vous répondra sous 24 heures ouvrables.',
            ),
            // Formulaire
            array(
                'key'   => 'field_ct_form_title',
                'label' => 'Formulaire - Titre section',
                'name'  => 'ct_form_title',
                'type'  => 'text',
                'default_value' => 'Décrivez votre besoin',
            ),
            array(
                'key'           => 'field_ct_form_shortcode',
                'label'         => 'Shortcode formulaire (CF7 / WPForms)',
                'name'          => 'ct_form_shortcode',
                'type'          => 'text',
                'instructions'  => 'Si renseigné, remplace le formulaire statique. Ex: [contact-form-7 id="123"]',
            ),
            // Sidebar info
            array(
                'key'   => 'field_ct_tel',
                'label' => 'Téléphone',
                'name'  => 'ct_tel',
                'type'  => 'text',
                'default_value' => '+225 00 00 00 00',
            ),
            array(
                'key'   => 'field_ct_email',
                'label' => 'Email de contact',
                'name'  => 'ct_email',
                'type'  => 'email',
                'default_value' => 'contact@rcg.com',
            ),
            array(
                'key'        => 'field_ct_bureaux',
                'label'      => 'Bureaux',
                'name'       => 'ct_bureaux',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 4,
                'layout'     => 'block',
                'sub_fields' => array(
                    array( 'key' => 'field_ct_bur_label', 'label' => 'Label (ex: Siège Abidjan)', 'name' => 'label', 'type' => 'text' ),
                    array( 'key' => 'field_ct_bur_color', 'label' => 'Couleur label', 'name' => 'color', 'type' => 'select', 'choices' => array( 'primary' => 'Rouge (primary)', 'blue' => 'Bleu (#13549E)' ), 'default_value' => 'primary' ),
                    array( 'key' => 'field_ct_bur_addr', 'label' => 'Adresse', 'name' => 'address', 'type' => 'textarea', 'rows' => 2, 'new_lines' => 'br' ),
                ),
            ),
            array(
                'key'   => 'field_ct_promise',
                'label' => 'Citation / promesse (sidebar)',
                'name'  => 'ct_promise',
                'type'  => 'textarea',
                'rows'  => 2,
                'default_value' => '"Notre engagement : vous répondre sous 24 heures ouvrables en toute confidentialité."',
            ),
            // Google Maps
            array(
                'key'          => 'field_ct_map_embed',
                'label'        => 'Code embed Google Maps',
                'name'         => 'ct_map_embed',
                'type'         => 'textarea',
                'rows'         => 3,
                'instructions' => 'Collez le code iframe Google Maps. Si vide, un placeholder sera affiché.',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-templates/page-contact.php',
                ),
            ),
        ),
        'menu_order' => 0,
    ) );
}
add_action( 'acf/init', 'rcg_register_acf_fields' );
