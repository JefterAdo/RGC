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

    // Creer les articles Insights demo
    rcg_create_demo_posts();

    // Creer les menus de navigation
    rcg_create_demo_menus();

    // Configurer les permaliens
    update_option( 'permalink_structure', '/%postname%/' );
    flush_rewrite_rules();

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
    if ( ! get_option( 'rcg_demo_posts_created' ) ) {
        rcg_create_demo_posts();
    }
    if ( ! get_option( 'rcg_demo_menus_created' ) ) {
        rcg_create_demo_menus();
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

/**
 * Creer les articles de blog (Insights) de demonstration
 */
function rcg_create_demo_posts() {

    if ( get_option( 'rcg_demo_posts_created' ) ) {
        return;
    }

    // === Creer les termes de taxonomie thematique_insight ===
    $thematiques = array(
        'strategie'  => 'Stratégie',
        'medias'     => 'Médias & RP',
        'crise'      => 'Communication de Crise',
        'leadership' => 'Leadership & Image',
        'opinions'   => 'Opinions',
    );

    $them_ids = array();
    foreach ( $thematiques as $slug => $name ) {
        $existing = term_exists( $name, 'thematique_insight' );
        if ( $existing ) {
            $them_ids[ $slug ] = (int) $existing['term_id'];
        } else {
            $result = wp_insert_term( $name, 'thematique_insight', array( 'slug' => $slug ) );
            if ( ! is_wp_error( $result ) ) {
                $them_ids[ $slug ] = $result['term_id'];
            }
        }
    }

    // === Articles demo ===
    $articles = array(
        array(
            'title'      => 'Gouvernance & Communication Institutionnelle : Le nouveau paradigme en zone CEDEAO',
            'excerpt'    => 'Comment les institutions ouest-africaines repensent leur strategie de communication face aux exigences des citoyens et partenaires internationaux.',
            'content'    => '<p>La communication institutionnelle en Afrique de l\'Ouest connait une transformation profonde. Les organisations publiques, les institutions regionales comme la CEDEAO et l\'UEMOA, et les grandes entreprises repensent fundamentalement leur approche communicationnelle.</p>
<p>L\'ere du communique de presse unidirectionnel est revolue. Les decideurs africains doivent desormais conjuguer transparence, reactivite et maitrise du narratif dans un ecosysteme mediatique en mutation permanente. Les reseaux sociaux, les medias en ligne et les plateformes de fact-checking imposent de nouvelles regles du jeu.</p>
<p>Chez RCG West Africa, nous observons trois tendances majeures : la montee en puissance du personal branding des dirigeants, l\'exigence croissante de communication de crise proactive, et l\'integration du digital dans les strategies institutionnelles traditionnelles.</p>',
            'thematique' => 'strategie',
            'read_time'  => '8',
            'initials'   => 'IK',
            'featured'   => '1',
            'type'       => 'standard',
            'card_bg'    => 'dark',
        ),
        array(
            'title'      => 'Relations Presse en Afrique de l\'Ouest : les nouvelles regles du jeu',
            'excerpt'    => 'Le paysage mediatique ouest-africain evolue. Decryptage des approches RP efficaces pour institutions et entreprises.',
            'content'    => '<p>Le paysage mediatique en Afrique de l\'Ouest se transforme a une vitesse sans precedent. L\'essor des medias en ligne, des podcasts et des newsletters specialisees redessine les contours des relations presse traditionnelles.</p>
<p>En Cote d\'Ivoire, au Senegal et au Ghana, les communicants institutionnels doivent desormais gerer un ecosysteme mediatique fragmentee : medias publics, presse privee, blogueurs influents, et plateformes sociales coexistent et s\'influencent mutuellement.</p>
<p>Les strategies de relations presse qui fonctionnent aujourd\'hui en Afrique de l\'Ouest combinent ciblage precis des journalistes cles, production de contenus adaptes a chaque format, et monitoring en temps reel des retombees mediatiques.</p>',
            'thematique' => 'medias',
            'read_time'  => '6',
            'initials'   => 'RCG',
            'featured'   => '',
            'type'       => 'standard',
            'card_bg'    => 'light',
        ),
        array(
            'title'      => 'Communication de Crise : anticiper, reagir, proteger la reputation',
            'excerpt'    => 'De la cellule de crise au dispositif digital : comment les organisations africaines modernisent leur gestion de crise.',
            'content'    => '<p>La gestion de crise en Afrique de l\'Ouest a considerablement evolue ces dernieres annees. Les organisations font face a des crises de plus en plus complexes — syndicales, reputationnelles, sanitaires, securitaires — qui se propagent instantanement via les reseaux sociaux.</p>
<p>L\'experience de RCG West Africa sur plus de 15 ans montre que les organisations les mieux preparees sont celles qui ont investi dans trois piliers : un plan de crise actualise, une equipe formee au media training, et des outils de veille et monitoring actifs 24/7.</p>
<p>La cle reside dans la reactivite : les premieres heures d\'une crise determinent 80% de son issue mediatique. Un dispositif de communication de crise efficace doit permettre d\'activer une cellule en moins de 2 heures, avec des elements de langage valides et un porte-parole designe.</p>',
            'thematique' => 'crise',
            'read_time'  => '10',
            'initials'   => 'RCG',
            'featured'   => '',
            'type'       => 'standard',
            'card_bg'    => 'dark',
        ),
        array(
            'title'      => 'La discretion strategique : premier atout du communicant institutionnel africain',
            'excerpt'    => 'Dans un monde sursature de visibilite, savoir quand et comment communiquer devient un avantage strategique.',
            'content'    => '<p>Le paradoxe de la communication institutionnelle en Afrique de l\'Ouest tient en une phrase : les meilleurs communicants sont souvent les moins visibles. La discretion strategique n\'est pas l\'absence de communication — c\'est l\'art de communiquer avec precision, mesure et impact.</p>
<p>Dans un contexte ou les reseaux sociaux poussent a l\'hyper-visibilite, les institutions et les dirigeants qui choisissent deliberement leurs moments de prise de parole gagnent en credibilite et en influence. C\'est ce que nous appelons chez RCG le « capital de discretion ».</p>',
            'thematique' => 'opinions',
            'read_time'  => '5',
            'initials'   => 'IK',
            'featured'   => '',
            'type'       => 'opinion',
            'card_bg'    => 'white',
            'auth_title' => 'Fondateur & DG, RCG West Africa',
        ),
        array(
            'title'      => 'Personal Branding des dirigeants africains : strategies et bonnes pratiques',
            'excerpt'    => 'Comment construire une image publique forte et coherente pour les decideurs en Afrique de l\'Ouest.',
            'content'    => '<p>Le personal branding des dirigeants est devenu un levier strategique incontournable en Afrique de l\'Ouest. Que ce soit pour un ministre, un PDG ou un directeur d\'institution internationale, la construction d\'une image publique maitrisee est desormais un imperatif professionnel.</p>
<p>Les dirigeants les plus influents de la zone CEDEAO partagent des caracteristiques communes : une presence LinkedIn soignee, des prises de parole calibrees dans les medias de reference, et une coherence entre leur communication publique et leur action sur le terrain.</p>
<p>RCG West Africa accompagne les decideurs africains dans cette demarche depuis plus de 15 ans, avec une approche sur-mesure qui tient compte des specificites culturelles et institutionnelles de chaque pays.</p>',
            'thematique' => 'leadership',
            'read_time'  => '7',
            'initials'   => 'RCG',
            'featured'   => '',
            'type'       => 'standard',
            'card_bg'    => 'light',
        ),
    );

    foreach ( $articles as $i => $art ) {
        $existing = get_page_by_title( $art['title'], OBJECT, 'post' );
        if ( $existing ) {
            continue;
        }

        $post_id = wp_insert_post( array(
            'post_type'    => 'post',
            'post_title'   => $art['title'],
            'post_excerpt' => $art['excerpt'],
            'post_content' => $art['content'],
            'post_status'  => 'publish',
            'post_date'    => gmdate( 'Y-m-d H:i:s', strtotime( '-' . ( $i * 12 ) . ' days' ) ),
        ) );

        if ( is_wp_error( $post_id ) ) {
            continue;
        }

        // Assigner la thematique
        if ( isset( $them_ids[ $art['thematique'] ] ) ) {
            wp_set_object_terms( $post_id, $them_ids[ $art['thematique'] ], 'thematique_insight' );
        }

        // Champs meta pour les articles Insights
        update_post_meta( $post_id, 'insight_type', $art['type'] );
        update_post_meta( $post_id, 'insight_read_time', $art['read_time'] );
        update_post_meta( $post_id, 'insight_author_initials', $art['initials'] );
        update_post_meta( $post_id, 'insight_card_bg', $art['card_bg'] );
        if ( ! empty( $art['featured'] ) ) {
            update_post_meta( $post_id, 'insight_featured', '1' );
        }
        if ( ! empty( $art['auth_title'] ) ) {
            update_post_meta( $post_id, 'insight_author_title', $art['auth_title'] );
        }
    }

    update_option( 'rcg_demo_posts_created', true );
}

/**
 * Creer les menus de navigation WordPress
 */
function rcg_create_demo_menus() {

    if ( get_option( 'rcg_demo_menus_created' ) ) {
        return;
    }

    // === Menu Principal ===
    $menu_name   = 'Menu Principal RCG';
    $menu_exists = wp_get_nav_menu_object( $menu_name );
    if ( ! $menu_exists ) {
        $menu_id = wp_create_nav_menu( $menu_name );

        if ( ! is_wp_error( $menu_id ) ) {
            $pages_menu = array(
                'a-propos'     => 'À Propos',
                'expertises'   => 'Expertises',
                'realisations' => 'Réalisations',
                'insights'     => 'Insights',
                'equipe'       => 'Équipe',
            );

            $position = 0;
            foreach ( $pages_menu as $slug => $title ) {
                $page = get_page_by_path( $slug );
                if ( $page ) {
                    $position++;
                    wp_update_nav_menu_item( $menu_id, 0, array(
                        'menu-item-title'     => $title,
                        'menu-item-object'    => 'page',
                        'menu-item-object-id' => $page->ID,
                        'menu-item-type'      => 'post_type',
                        'menu-item-status'    => 'publish',
                        'menu-item-position'  => $position,
                    ) );
                }
            }

            // Assigner au menu-principal
            $locations                     = get_theme_mod( 'nav_menu_locations', array() );
            $locations['menu-principal']    = $menu_id;
            set_theme_mod( 'nav_menu_locations', $locations );
        }
    }

    // === Menu Footer ===
    $footer_name   = 'Menu Footer RCG';
    $footer_exists = wp_get_nav_menu_object( $footer_name );
    if ( ! $footer_exists ) {
        $footer_id = wp_create_nav_menu( $footer_name );

        if ( ! is_wp_error( $footer_id ) ) {
            $pages_footer = array(
                'a-propos'     => 'À Propos',
                'expertises'   => 'Expertises',
                'realisations' => 'Réalisations',
                'insights'     => 'Insights',
                'equipe'       => 'Équipe',
                'contact'      => 'Contact',
            );

            $position = 0;
            foreach ( $pages_footer as $slug => $title ) {
                $page = get_page_by_path( $slug );
                if ( $page ) {
                    $position++;
                    wp_update_nav_menu_item( $footer_id, 0, array(
                        'menu-item-title'     => $title,
                        'menu-item-object'    => 'page',
                        'menu-item-object-id' => $page->ID,
                        'menu-item-type'      => 'post_type',
                        'menu-item-status'    => 'publish',
                        'menu-item-position'  => $position,
                    ) );
                }
            }

            $locations                = get_theme_mod( 'nav_menu_locations', array() );
            $locations['menu-footer'] = $footer_id;
            set_theme_mod( 'nav_menu_locations', $locations );
        }
    }

    // === Menu Legal ===
    $legal_name   = 'Menu Legal RCG';
    $legal_exists = wp_get_nav_menu_object( $legal_name );
    if ( ! $legal_exists ) {
        $legal_id = wp_create_nav_menu( $legal_name );

        if ( ! is_wp_error( $legal_id ) ) {
            // Creer les pages legales si elles n'existent pas
            $legal_pages = array(
                'mentions-legales'          => 'Mentions Légales',
                'politique-confidentialite' => 'Politique de Confidentialité',
            );

            $position = 0;
            foreach ( $legal_pages as $slug => $title ) {
                $page = get_page_by_path( $slug );
                if ( ! $page ) {
                    $page_id = wp_insert_post( array(
                        'post_type'    => 'page',
                        'post_title'   => $title,
                        'post_name'    => $slug,
                        'post_content' => '',
                        'post_status'  => 'publish',
                    ) );
                    $page = get_post( $page_id );
                }

                if ( $page && ! is_wp_error( $page ) ) {
                    $position++;
                    wp_update_nav_menu_item( $legal_id, 0, array(
                        'menu-item-title'     => $title,
                        'menu-item-object'    => 'page',
                        'menu-item-object-id' => $page->ID,
                        'menu-item-type'      => 'post_type',
                        'menu-item-status'    => 'publish',
                        'menu-item-position'  => $position,
                    ) );
                }
            }

            $locations                = get_theme_mod( 'nav_menu_locations', array() );
            $locations['menu-legal']  = $legal_id;
            set_theme_mod( 'nav_menu_locations', $locations );
        }
    }

    update_option( 'rcg_demo_menus_created', true );
}
