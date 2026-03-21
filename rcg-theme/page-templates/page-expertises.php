<?php
/**
 * Template Name: Expertises
 *
 * Reproduit fidelement la maquette expertise.htm :
 * - Header hero plein ecran avec image de fond
 * - Breadcrumb + eyebrow + titre + description
 * - Pastilles d'ancres vers les 6 expertises
 * - 6 sections alternees (texte/image) avec layouts varies
 * - Bandeau CTA final
 *
 * Fallback statique complet si aucun CPT expertise n'existe.
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Verifier si on a des expertises dynamiques
$expertises = new WP_Query( array(
    'post_type'      => 'expertise',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );
$use_dynamic = $expertises->found_posts >= 3;

// Donnees statiques (fallback maquette)
$static_expertises = array(
    array(
        'number'   => '01',
        'anchor'   => 'strategie',
        'eyebrow'  => 'Conseil Strategique',
        'title'    => 'Conseil Strategique & Communication Institutionnelle',
        'desc'     => 'Au coeur de l\'offre RCG West Africa : le conseil strategique de haut niveau pour institutions, gouvernements et organisations en Afrique de l\'Ouest. Audit de positionnement, architecture de la communication et pilotage operationnel.',
        'bg'       => 'white',
        'layout'   => 'text-left',
        'list'     => 'steps',
        'items'    => array(
            array( 'icon' => '01', 'title' => 'Audit & Diagnostic Institutionnel', 'desc' => 'Cartographie de votre environnement communicationnel, analyse des risques reputationnels et identification des leviers d\'influence.' ),
            array( 'icon' => '02', 'title' => 'Strategie & Feuille de Route', 'desc' => 'Conception de la plateforme de marque institutionnelle, plan de communication global et strategie de positionnement.' ),
            array( 'icon' => '03', 'title' => 'Pilotage & Indicateurs de Performance', 'desc' => 'KPIs, tableaux de bord et reporting a 360. Chaque action est mesuree et optimisee en continu.' ),
        ),
        'quote'    => 'Le conseil strategique est le fondement de toute communication institutionnelle reussie. — Ibrahim KOUROUMA, Fondateur RCG',
        'stats'    => array(),
        'image'    => RCG_URI . '/assets/images/exp-strategie.png',
    ),
    array(
        'number'   => '02',
        'anchor'   => 'relations-publiques',
        'eyebrow'  => 'Relations Publiques & Image',
        'title'    => 'Relations Publiques & Gestion de Reputation',
        'desc'     => 'Construction et protection de l\'image des decideurs et institutions. Personal branding, veille reputationnelle et strategie d\'influence pour les leaders d\'Afrique de l\'Ouest — de la CEDEAO aux entreprises du secteur prive.',
        'bg'       => 'gray',
        'layout'   => 'text-right',
        'list'     => 'arrows',
        'items'    => array(
            array( 'desc' => 'Veille strategique et mediatique en temps reel sur l\'Afrique de l\'Ouest' ),
            array( 'desc' => 'Coaching communication et media training pour dirigeants et porte-paroles' ),
            array( 'desc' => 'Strategie de presence digitale et influence institutionnelle' ),
            array( 'desc' => 'Monitoring des risques reputationnels et gestion proactive de l\'image' ),
        ),
        'quote'    => '',
        'stats'    => array(
            array( 'value' => '50+', 'label' => 'Clients accompagnes' ),
            array( 'value' => '10+', 'label' => 'Pays couverts' ),
            array( 'value' => '24/7', 'label' => 'Veille active' ),
        ),
        'image'    => RCG_URI . '/assets/images/exp-image.png',
        'tags'     => array( 'Relations Publiques', 'Personal Branding' ),
    ),
    array(
        'number'   => '03',
        'anchor'   => 'relations-presse',
        'eyebrow'  => 'Relations Presse & Medias',
        'title'    => 'Relations Presse & Couverture Mediatique',
        'desc'     => 'Un reseau presse panafricain et international mobilisable rapidement. RCG organise votre visibilite mediatique avec precision : conferences de presse, communiques, media training et voyages de presse en Afrique de l\'Ouest.',
        'bg'       => 'surface-dark',
        'layout'   => 'text-left',
        'list'     => 'hover',
        'items'    => array(
            array( 'title' => 'Cartographie presse Afrique de l\'Ouest & International' ),
            array( 'title' => 'Organisation de conferences et voyages de presse' ),
            array( 'title' => 'Redaction de communiques et dossiers de presse premium' ),
            array( 'title' => 'Media training et preparation des porte-paroles institutionnels' ),
        ),
        'quote'    => '',
        'stats'    => array(),
        'image'    => '',
    ),
    array(
        'number'   => '04',
        'anchor'   => 'contenus',
        'eyebrow'  => 'Creation de Contenus',
        'title'    => 'Creation de Contenus & Production Editoriale',
        'desc'     => 'Contenus strategiques qui positionnent vos dirigeants comme des references : tribunes, discours, rapports annuels, publications institutionnelles et contenus digitaux. Une expertise editoriale au service de votre credibilite.',
        'bg'       => 'white',
        'layout'   => 'text-right',
        'list'     => 'arrows',
        'items'    => array(
            array( 'desc' => 'Tribunes, editoriaux et prises de parole strategiques' ),
            array( 'desc' => 'Speechwriting et discours institutionnels sur mesure' ),
            array( 'desc' => 'Rapports annuels, bilans d\'activite et publications corporate' ),
            array( 'desc' => 'Contenus digitaux, strategie editoriale web et reseaux sociaux' ),
        ),
        'quote'    => '',
        'stats'    => array(),
        'image'    => RCG_URI . '/assets/images/exp-editorial.png',
    ),
    array(
        'number'   => '05',
        'anchor'   => 'crise',
        'eyebrow'  => 'Communication de Crise',
        'title'    => 'Communication de Crise & Gestion des Risques',
        'desc'     => 'Dispositif de crise operationnel : anticipation, cellule de crise, gestion mediatique et reconstruction de reputation. RCG West Africa intervient aupres des institutions et dirigeants confrontes a des situations sensibles en Afrique.',
        'bg'       => 'dark',
        'layout'   => 'text-left',
        'list'     => 'timeline',
        'items'    => array(
            array( 'icon' => '!', 'title' => 'Alerte & Activation Rapide', 'desc' => 'Detection precoce des signaux faibles et mobilisation immediate de la cellule de crise RCG.' ),
            array( 'icon' => '>', 'title' => 'Pilotage & Gestion Operationnelle', 'desc' => 'Strategie de reponse, elements de langage, coordination media et accompagnement des porte-paroles.' ),
            array( 'icon' => '+', 'title' => 'Reconstruction & Rehabilitation', 'desc' => 'Plan de rehabilitation de l\'image, veille post-crise et reconstruction progressive de la confiance.' ),
        ),
        'quote'    => '',
        'stats'    => array(),
        'image'    => '',
    ),
    array(
        'number'   => '06',
        'anchor'   => 'branding-evenementiel',
        'eyebrow'  => 'Branding & Evenementiel',
        'title'    => 'Branding Institutionnel & Evenementiel de Haut Niveau',
        'desc'     => 'Identites visuelles qui incarnent la credibilite de votre institution, et evenements strategiques de haut niveau : sommets, conferences internationales, forums et ceremonies. RCG concoit et pilote des evenements institutionnels majeurs en Afrique de l\'Ouest.',
        'bg'       => 'white',
        'layout'   => 'text-left',
        'list'     => 'cards',
        'items'    => array(
            array( 'icon' => 'palette', 'title' => 'Identite Visuelle' ),
            array( 'icon' => 'menu_book', 'title' => 'Charte Graphique' ),
            array( 'icon' => 'event', 'title' => 'Sommets & Conferences' ),
            array( 'icon' => 'groups', 'title' => 'Forums Institutionnels' ),
            array( 'icon' => 'devices', 'title' => 'Digital & Web Design' ),
            array( 'icon' => 'school', 'title' => 'Formation & Coaching' ),
        ),
        'quote'    => 'L\'identite institutionnelle et l\'evenementiel sont les vitrines de votre credibilite. — RCG West Africa',
        'stats'    => array(),
        'image'    => '',
    ),
);

$contact_page = get_page_by_path( 'contact' );
$contact_url  = $contact_page ? get_permalink( $contact_page ) : '#';
$reals_url    = get_permalink( get_page_by_path( 'realisations' ) );
if ( ! $reals_url ) {
    $reals_url = '#';
}
?>

<!-- ============================================
     HEADER HERO
     ============================================ -->
<header class="relative bg-background-dark text-white overflow-hidden" style="min-height:75vh">
    <div class="absolute inset-0 z-0">
        <?php
        $header_img = get_field( 'expertise_header_image' );
        if ( $header_img ) :
        ?>
            <img src="<?php echo esc_url( $header_img['url'] ); ?>" alt="<?php echo esc_attr( $header_img['alt'] ); ?>" class="w-full h-full object-cover opacity-30 object-top">
        <?php else : ?>
            <img src="<?php echo esc_url( RCG_URI . '/assets/images/exp-header-hero.png' ); ?>" alt="Expertises RCG" class="w-full h-full object-cover opacity-30 object-top">
        <?php endif; ?>
        <div class="absolute inset-0 bg-gradient-to-r from-background-dark via-background-dark/80 to-background-dark/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent"></div>
    </div>

    <div class="absolute top-0 right-0 border-t-[300px] border-r-[300px] border-t-primary/20 border-r-transparent z-0"></div>

    <div class="relative z-10 container mx-auto px-6 lg:px-12 flex flex-col justify-end" style="min-height:75vh;padding-bottom:80px;padding-top:80px">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-6">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-primary/60 text-[9px] uppercase tracking-widest font-semibold hover:text-primary transition-colors">Accueil</a>
                <span class="text-white/20 text-xs">/</span>
                <span class="text-white/60 text-[9px] uppercase tracking-widest font-semibold">Expertises</span>
            </div>

            <span class="eyebrow mb-6">&mdash; Nos Expertises en Communication</span>

            <h1 class="font-black text-5xl lg:text-[72px] uppercase leading-[1.05] mb-8 tracking-tight mt-4">
                <?php
                $hero_title = get_field( 'expertise_hero_title' );
                echo esc_html( $hero_title ? $hero_title : 'Dix domaines d\'expertise au service de votre influence' );
                ?>
            </h1>

            <div class="line-accent mb-8"></div>

            <p class="text-white/60 text-lg max-w-xl leading-relaxed font-light">
                <?php
                $hero_desc = get_field( 'expertise_hero_description' );
                echo esc_html( $hero_desc ? $hero_desc : 'Conseil strategique, communication de crise, relations publiques, branding institutionnel, evenementiel, creation de contenus, veille, formation, relations presse et digital. RCG West Africa maitrise chaque levier de la communication institutionnelle en Afrique de l\'Ouest.' );
                ?>
            </p>

            <!-- Pastilles d'ancres -->
            <div class="flex flex-wrap gap-3 mt-12 pt-8 border-t border-white/10">
                <?php
                $anchors_data = $use_dynamic ? array() : $static_expertises;
                if ( $use_dynamic ) :
                    while ( $expertises->have_posts() ) :
                        $expertises->the_post();
                        $anchor = get_field( 'expertise_anchor', get_the_ID() );
                        $number = get_field( 'expertise_number', get_the_ID() );
                        if ( ! $anchor ) {
                            $anchor = sanitize_title( get_the_title() );
                        }
                ?>
                    <a href="#<?php echo esc_attr( $anchor ); ?>" class="tag-pill text-white/50 border-white/20 hover:text-primary hover:border-primary transition-colors">
                        <?php echo esc_html( $number ); ?> &mdash; <?php echo esc_html( get_the_title() ); ?>
                    </a>
                <?php
                    endwhile;
                    $expertises->rewind_posts();
                else :
                    foreach ( $static_expertises as $se ) :
                ?>
                    <a href="#<?php echo esc_attr( $se['anchor'] ); ?>" class="tag-pill text-white/50 border-white/20 hover:text-primary hover:border-primary transition-colors">
                        <?php echo esc_html( $se['number'] ); ?> &mdash; <?php echo esc_html( $se['title'] ); ?>
                    </a>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
</header>

<!-- ============================================
     SECTIONS EXPERTISES
     ============================================ -->
<?php
if ( $use_dynamic ) :
    // === MODE DYNAMIQUE ===
    while ( $expertises->have_posts() ) :
        $expertises->the_post();
        $number    = get_field( 'expertise_number' );
        $anchor    = get_field( 'expertise_anchor' );
        $eyebrow   = get_field( 'expertise_eyebrow' );
        $bg        = get_field( 'expertise_bg' ) ?: 'white';
        $layout    = get_field( 'expertise_layout' ) ?: 'text-left';
        $image     = get_field( 'expertise_image' );
        $quote     = get_field( 'expertise_quote' );
        $list_type = get_field( 'expertise_list_type' ) ?: 'arrows';
        $exp_title = get_the_title();
        $exp_desc  = get_the_excerpt();
        if ( ! $anchor ) {
            $anchor = sanitize_title( $exp_title );
        }
        $image_url = $image ? $image['url'] : '';
        $image_alt = $image ? $image['alt'] : $exp_title;

        include locate_template( 'template-parts/expertise-section.php' );
    endwhile;
    wp_reset_postdata();

else :
    // === MODE STATIQUE (FALLBACK) ===
    foreach ( $static_expertises as $exp ) :
        $number    = $exp['number'];
        $anchor    = $exp['anchor'];
        $eyebrow   = $exp['eyebrow'];
        $bg        = $exp['bg'];
        $layout    = $exp['layout'];
        $list_type = $exp['list'];
        $exp_title = $exp['title'];
        $exp_desc  = $exp['desc'];
        $quote     = $exp['quote'];
        $image_url = isset( $exp['image'] ) ? $exp['image'] : '';
        $image_alt = $exp_title;
        $static_items = $exp['items'];
        $static_stats = $exp['stats'];
        $static_tags  = isset( $exp['tags'] ) ? $exp['tags'] : array();

        include locate_template( 'template-parts/expertise-section.php' );
    endforeach;
endif;
?>

<!-- ============================================
     BANDEAU CTA FINAL
     ============================================ -->
<section class="bg-primary py-20">
    <div class="container mx-auto px-6 lg:px-12 flex flex-col md:flex-row justify-between items-center gap-8">
        <div>
            <h2 class="font-black text-3xl lg:text-4xl uppercase tracking-tight text-white">Un enjeu de communication institutionnelle ?</h2>
            <p class="text-white/70 mt-2 text-lg">Conseil strategique, crise, relations publiques ou evenementiel — parlons de votre projet.</p>
        </div>
        <a href="<?php echo esc_url( $contact_url ); ?>" class="bg-white text-primary font-bold text-xs uppercase tracking-widest px-10 py-5 hover:scale-105 transition-transform inline-block whitespace-nowrap">
            Contactez RCG
        </a>
    </div>
</section>

<?php get_footer(); ?>
