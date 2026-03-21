<?php
/**
 * Donnees de demonstration — Realisations et taxonomies
 *
 * Cree automatiquement les posts CPT "realisation" et les termes
 * de la taxonomie "categorie_expertise" lors de l'activation du theme.
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Insertion des donnees de demo
 */
function rcg_seed_demo_data() {

    // Ne pas re-inserer si deja fait
    if ( get_option( 'rcg_demo_data_seeded' ) ) {
        return;
    }

    // === Creer les termes de taxonomie ===
    $categories = array(
        'strategie'    => 'Stratégie',
        'image'        => 'Image & Réputation',
        'medias'       => 'Relations Médias',
        'crise'        => 'Communication de Crise',
        'evenementiel' => 'Événementiel',
        'branding'     => 'Branding Institutionnel',
    );

    $term_ids = array();
    foreach ( $categories as $slug => $name ) {
        $existing = term_exists( $name, 'categorie_expertise' );
        if ( $existing ) {
            $term_ids[ $slug ] = (int) $existing['term_id'];
        } else {
            $result = wp_insert_term( $name, 'categorie_expertise', array( 'slug' => $slug ) );
            if ( ! is_wp_error( $result ) ) {
                $term_ids[ $slug ] = $result['term_id'];
            }
        }
    }

    // === Donnees des realisations ===
    $realisations = array(
        array(
            'title'       => 'Repositionnement stratégique d\'une agence gouvernementale',
            'excerpt'     => 'Redéfinition du positionnement et de la stratégie de communication d\'une agence publique majeure en Côte d\'Ivoire.',
            'content'     => '<p>Mission de conseil stratégique pour le repositionnement global d\'une agence gouvernementale. Audit de perception, refonte du narratif institutionnel et déploiement d\'un plan de communication sur 12 mois couvrant médias traditionnels et digitaux.</p>
<p>L\'objectif était de renforcer la crédibilité de l\'institution auprès des partenaires internationaux tout en consolidant sa légitimité sur le plan national. Une approche intégrée combinant relations presse, événementiel institutionnel et stratégie éditoriale.</p>',
            'category'    => 'strategie',
            'badge_color' => 'blue',
            'client'      => 'Agence Gouvernementale — Côte d\'Ivoire',
            'short_desc'  => 'Audit de perception, refonte du narratif institutionnel et déploiement d\'un plan de communication sur 12 mois.',
            'is_featured' => '1',
            'is_crisis'   => '',
            'kpis'        => array(
                array( 'value' => '+65%', 'label' => 'Couverture médiatique' ),
                array( 'value' => '4',    'label' => 'Pays ciblés en simultané' ),
                array( 'value' => '8 Sem.', 'label' => 'Temps de déploiement' ),
            ),
            'tags'        => array(
                array( 'text' => 'Institution Publique' ),
                array( 'text' => 'Côte d\'Ivoire' ),
            ),
            'results'     => array(
                array( 'text' => 'Crédibilité renforcée' ),
                array( 'text' => '+65% médias' ),
            ),
            'order'       => 1,
        ),
        array(
            'title'       => 'Sommet International sur l\'Innovation à Abidjan',
            'excerpt'     => 'Organisation et couverture médiatique d\'un sommet réunissant 800 décideurs de 12 pays.',
            'content'     => '<p>Conception et déploiement de la stratégie de communication pour un sommet international majeur sur l\'innovation en Afrique de l\'Ouest. Gestion des relations presse internationales, production de contenus multilingues et coordination de la couverture médiatique en temps réel.</p>
<p>RCG a mobilisé une équipe de 15 personnes sur 3 semaines pour assurer une couverture sans faille : 45 journalistes accrédités, 120 retombées presse dans 8 pays, et une audience digitale cumulée de 2,5 millions de personnes.</p>',
            'category'    => 'evenementiel',
            'badge_color' => 'amber',
            'client'      => 'Organisation Internationale — Abidjan',
            'short_desc'  => 'Stratégie médiatique pour un sommet réunissant 800 décideurs de 12 pays africains.',
            'is_featured' => '',
            'is_crisis'   => '',
            'kpis'        => array(
                array( 'value' => '800+', 'label' => 'Participants' ),
                array( 'value' => '12',   'label' => 'Pays représentés' ),
                array( 'value' => '120',  'label' => 'Retombées presse' ),
            ),
            'tags'        => array(
                array( 'text' => 'Org. Internationale' ),
                array( 'text' => 'Événementiel' ),
            ),
            'results'     => array(
                array( 'text' => '120 retombées' ),
                array( 'text' => '2.5M audience' ),
            ),
            'order'       => 2,
        ),
        array(
            'title'       => 'Programme de leadership pour Dirigeants de PME',
            'excerpt'     => 'Personal branding et coaching média pour un groupe de dirigeants d\'entreprises panafricaines.',
            'content'     => '<p>Programme de 6 mois destiné à construire et renforcer l\'image publique de dirigeants d\'entreprises en pleine croissance. Media training intensif, stratégie de présence sur LinkedIn, préparation aux interventions télévisées et positionnement en tant que thought leaders dans leurs secteurs respectifs.</p>
<p>Résultats mesurables : augmentation moyenne de 340% de la visibilité LinkedIn, 12 tribunes publiées dans des médias de référence, et 3 invitations à des forums économiques internationaux pour les participants.</p>',
            'category'    => 'image',
            'badge_color' => 'green',
            'client'      => 'Réseau PME Panafricain',
            'short_desc'  => 'Personal branding et media training pour un groupe de dirigeants d\'entreprises en pleine croissance.',
            'is_featured' => '',
            'is_crisis'   => '',
            'kpis'        => array(
                array( 'value' => '+340%', 'label' => 'Visibilité LinkedIn' ),
                array( 'value' => '12',    'label' => 'Tribunes publiées' ),
                array( 'value' => '6 mois', 'label' => 'Durée programme' ),
            ),
            'tags'        => array(
                array( 'text' => 'Entreprise' ),
                array( 'text' => 'Personal Branding' ),
            ),
            'results'     => array(
                array( 'text' => '+340% visibilité' ),
                array( 'text' => '12 tribunes' ),
            ),
            'order'       => 3,
        ),
        array(
            'title'       => 'Gestion de crise — Grève sectorielle industrielle',
            'excerpt'     => 'Maîtrise du narratif face à une crise syndicale dans le secteur extractif ivoirien.',
            'content'     => '<p>Intervention d\'urgence pour une entreprise du secteur extractif confrontée à un mouvement social menaçant d\'impacter les cours d\'exportation et la confiance des investisseurs internationaux. Activation de la cellule de crise sous 2h, élaboration des éléments de langage, gestion des relations avec les médias et coordination avec les autorités.</p>
<p>Grâce à une communication transparente et proactive, le dialogue social a été rétabli en 72h sans jour d\'arrêt de production. La couverture médiatique est restée factuelle et équilibrée, préservant la réputation de l\'entreprise auprès de ses partenaires financiers.</p>',
            'category'    => 'crise',
            'badge_color' => 'red',
            'client'      => 'Industrie Extractive — Côte d\'Ivoire',
            'short_desc'  => 'Maîtrise du narratif face à une crise syndicale risquant d\'impacter les cours d\'exportation.',
            'is_featured' => '',
            'is_crisis'   => '1',
            'kpis'        => array(
                array( 'value' => '0', 'label' => 'Jour d\'arrêt' ),
                array( 'value' => '72h', 'label' => 'Résolution' ),
                array( 'value' => '100%', 'label' => 'Réputation préservée' ),
            ),
            'tags'        => array(
                array( 'text' => 'Com. de Crise' ),
                array( 'text' => 'Industrie' ),
            ),
            'results'     => array(
                array( 'text' => '0 jour d\'arrêt' ),
                array( 'text' => 'Dialogue rétabli' ),
            ),
            'order'       => 4,
        ),
        array(
            'title'       => 'Rebranding Banque Panafricaine',
            'excerpt'     => 'Modernisation de l\'identité visuelle et repositionnement d\'un groupe bancaire historique.',
            'content'     => '<p>Refonte complète de l\'identité de marque d\'un groupe bancaire leader en Afrique de l\'Ouest. De l\'audit de marque à la nouvelle charte graphique, en passant par la campagne de lancement multicanal, RCG a piloté l\'ensemble du processus de transformation.</p>
<p>Le nouveau positionnement « Innovation & Tradition » a permis d\'attirer une clientèle plus jeune (+28% de comptes ouverts par les 25-35 ans) tout en rassurant la base historique de clients corporate. Adhésion interne de 90% dès le premier mois.</p>',
            'category'    => 'branding',
            'badge_color' => 'green',
            'client'      => 'Groupe Bancaire Leader — Abidjan',
            'short_desc'  => 'Moderniser l\'image d\'une institution historique pour attirer une nouvelle génération d\'investisseurs.',
            'is_featured' => '',
            'is_crisis'   => '',
            'kpis'        => array(
                array( 'value' => '+28%', 'label' => 'Nouveaux comptes jeunes' ),
                array( 'value' => '90%',  'label' => 'Adhésion interne' ),
                array( 'value' => '5',    'label' => 'Pays déployés' ),
            ),
            'tags'        => array(
                array( 'text' => 'Entreprise' ),
                array( 'text' => 'Branding' ),
            ),
            'results'     => array(
                array( 'text' => 'Nouvelle identité' ),
                array( 'text' => 'Adhésion +90%' ),
            ),
            'order'       => 5,
        ),
        array(
            'title'       => 'Campagne de plaidoyer — Santé publique régionale',
            'excerpt'     => 'Stratégie de communication pour un programme de vaccination dans 6 pays de la CEDEAO.',
            'content'     => '<p>Conception et déploiement d\'une campagne de plaidoyer multilingue pour accompagner un programme de vaccination initié par une organisation internationale de santé. Mobilisation de leaders d\'opinion, production de contenus adaptés aux contextes culturels locaux et coordination des relations médias dans 6 pays simultanément.</p>
<p>La campagne a touché 15 millions de personnes via les canaux médiatiques et 8 millions via les réseaux sociaux, contribuant à une augmentation de 42% du taux de vaccination dans les zones cibles.</p>',
            'category'    => 'strategie',
            'badge_color' => 'amber',
            'client'      => 'Organisation de Santé Internationale',
            'short_desc'  => 'Campagne de plaidoyer multilingue pour un programme de vaccination dans 6 pays de la CEDEAO.',
            'is_featured' => '',
            'is_crisis'   => '',
            'kpis'        => array(
                array( 'value' => '6',    'label' => 'Pays couverts' ),
                array( 'value' => '+42%', 'label' => 'Taux vaccination' ),
                array( 'value' => '23M',  'label' => 'Personnes touchées' ),
            ),
            'tags'        => array(
                array( 'text' => 'Org. Internationale' ),
                array( 'text' => 'Santé Publique' ),
            ),
            'results'     => array(
                array( 'text' => '+42% vaccination' ),
                array( 'text' => '23M touchés' ),
            ),
            'order'       => 6,
        ),
    );

    // === Inserer les realisations ===
    foreach ( $realisations as $real ) {
        // Verifier si un post avec le meme titre existe deja
        $existing = get_page_by_title( $real['title'], OBJECT, 'realisation' );
        if ( $existing ) {
            continue;
        }

        $post_id = wp_insert_post( array(
            'post_type'    => 'realisation',
            'post_title'   => $real['title'],
            'post_excerpt' => $real['excerpt'],
            'post_content' => $real['content'],
            'post_status'  => 'publish',
            'menu_order'   => $real['order'],
        ) );

        if ( is_wp_error( $post_id ) ) {
            continue;
        }

        // Assigner la categorie d'expertise
        if ( isset( $term_ids[ $real['category'] ] ) ) {
            wp_set_object_terms( $post_id, $term_ids[ $real['category'] ], 'categorie_expertise' );
        }

        // Champs ACF (si ACF est actif)
        if ( function_exists( 'update_field' ) ) {
            update_field( 'realisation_client', $real['client'], $post_id );
            update_field( 'realisation_short_desc', $real['short_desc'], $post_id );
            update_field( 'realisation_badge_color', $real['badge_color'], $post_id );
            update_field( 'realisation_is_featured', $real['is_featured'], $post_id );
            update_field( 'realisation_is_crisis', $real['is_crisis'], $post_id );
            update_field( 'realisation_kpis', $real['kpis'], $post_id );
            update_field( 'realisation_tags', $real['tags'], $post_id );
            update_field( 'realisation_results', $real['results'], $post_id );
        } else {
            // Fallback : stocker en post_meta standard
            update_post_meta( $post_id, 'realisation_client', $real['client'] );
            update_post_meta( $post_id, 'realisation_short_desc', $real['short_desc'] );
            update_post_meta( $post_id, 'realisation_badge_color', $real['badge_color'] );
            update_post_meta( $post_id, 'realisation_is_featured', $real['is_featured'] );
            update_post_meta( $post_id, 'realisation_is_crisis', $real['is_crisis'] );
            update_post_meta( $post_id, 'realisation_kpis', $real['kpis'] );
            update_post_meta( $post_id, 'realisation_tags', $real['tags'] );
            update_post_meta( $post_id, 'realisation_results', $real['results'] );
        }
    }

    // Creer les pages du site
    rcg_create_pages();

    // Marquer comme fait
    update_option( 'rcg_demo_data_seeded', true );
}
add_action( 'after_switch_theme', 'rcg_seed_demo_data' );

/**
 * Lancer aussi via admin_init si le theme est deja actif
 */
function rcg_ensure_demo_data() {
    if ( ! get_option( 'rcg_demo_data_seeded' ) ) {
        rcg_seed_demo_data();
        return;
    }

    // Verifier si les pages ont ete creees (ajout tardif)
    if ( ! get_option( 'rcg_pages_created' ) ) {
        rcg_create_pages();
    }
}
add_action( 'admin_init', 'rcg_ensure_demo_data' );

/**
 * Creer les pages du site (peut etre appele independamment)
 */
function rcg_create_pages() {

    if ( get_option( 'rcg_pages_created' ) ) {
        return;
    }

    $pages = array(
        array(
            'title'    => 'Accueil',
            'slug'     => 'accueil',
            'template' => '',
        ),
        array(
            'title'    => 'À Propos',
            'slug'     => 'a-propos',
            'template' => 'page-templates/page-a-propos.php',
        ),
        array(
            'title'    => 'Expertises',
            'slug'     => 'expertises',
            'template' => 'page-templates/page-expertises.php',
        ),
        array(
            'title'    => 'Réalisations',
            'slug'     => 'realisations',
            'template' => 'page-templates/page-realisations.php',
        ),
        array(
            'title'    => 'Insights',
            'slug'     => 'insights',
            'template' => 'page-templates/page-insights.php',
        ),
        array(
            'title'    => 'Équipe',
            'slug'     => 'equipe',
            'template' => 'page-templates/page-equipe.php',
        ),
        array(
            'title'    => 'Contact',
            'slug'     => 'contact',
            'template' => 'page-templates/page-contact.php',
        ),
    );

    foreach ( $pages as $page_data ) {
        $existing = get_page_by_path( $page_data['slug'] );
        if ( ! $existing ) {
            $page_id = wp_insert_post( array(
                'post_type'    => 'page',
                'post_title'   => $page_data['title'],
                'post_name'    => $page_data['slug'],
                'post_content' => '',
                'post_status'  => 'publish',
            ) );
            if ( ! is_wp_error( $page_id ) && $page_data['template'] ) {
                update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
            }
        }
    }

    // Page d'accueil statique
    $front_page = get_page_by_path( 'accueil' );
    if ( $front_page ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page->ID );
    }

    // Page des articles
    $blog_page = get_page_by_path( 'insights' );
    if ( $blog_page ) {
        update_option( 'page_for_posts', $blog_page->ID );
    }

    update_option( 'rcg_pages_created', true );
}
