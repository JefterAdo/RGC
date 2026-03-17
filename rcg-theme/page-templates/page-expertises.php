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
        'eyebrow'  => 'Expertise Strategique',
        'title'    => 'Strategie de Communication Institutionnelle',
        'desc'     => 'Conseil strategique de haut niveau pour definir, structurer et deployer des programmes de communication a fort impact. De l\'audit de positionnement au plan global, nous tracons la voie.',
        'bg'       => 'white',
        'layout'   => 'text-left',
        'list'     => 'steps',
        'items'    => array(
            array( 'icon' => '01', 'title' => 'Audit & Diagnostic', 'desc' => 'Cartographie complete de votre positionnement et des risques reputationnels.' ),
            array( 'icon' => '02', 'title' => 'Architecture Strategique', 'desc' => 'Conception de la plateforme de marque et de la feuille de route communication.' ),
            array( 'icon' => '03', 'title' => 'Pilotage & Mesure', 'desc' => 'KPIs definis, tableaux de bord et reporting a 360 pour chaque etape.' ),
        ),
        'quote'    => 'Une strategie institutionnelle puissante ne se contente pas d\'informer, elle oriente l\'opinion et asseoit la legitimite du decideur.',
        'stats'    => array(),
        'image'    => RCG_URI . '/assets/images/exp-strategie.png',
    ),
    array(
        'number'   => '02',
        'anchor'   => 'image',
        'eyebrow'  => 'Gestion d\'Image',
        'title'    => 'Image & Reputation des Dirigeants',
        'desc'     => 'Personal branding des decideurs et gestion de la reputation institutionnelle a long terme. Nous construisons des images de leaders qui resistent aux crises et imposent le respect.',
        'bg'       => 'gray',
        'layout'   => 'text-right',
        'list'     => 'arrows',
        'items'    => array(
            array( 'desc' => 'Veille strategique et mediatique 360 en temps reel' ),
            array( 'desc' => 'Coaching communication et media training dirigeants' ),
            array( 'desc' => 'Strategie de presence digitale et influence institutionnelle' ),
            array( 'desc' => 'Monitoring des vulnerabilites et gestion proactive des risques' ),
        ),
        'quote'    => '',
        'stats'    => array(
            array( 'value' => '50+', 'label' => 'Dirigeants accompagnes' ),
            array( 'value' => '15', 'label' => 'Pays couverts' ),
            array( 'value' => '24h', 'label' => 'Veille permanente' ),
        ),
        'image'    => RCG_URI . '/assets/images/exp-image.png',
        'tags'     => array( 'Personal Branding' ),
    ),
    array(
        'number'   => '03',
        'anchor'   => 'medias',
        'eyebrow'  => 'Relations Medias',
        'title'    => 'Medias & Relations Presse',
        'desc'     => 'Un reseau presse panafricain et international activable sous 24h. Nous faconnons votre couverture mediatique avec la rigueur d\'un cabinet de lobbying et l\'efficacite d\'une newsroom.',
        'bg'       => 'surface-dark',
        'layout'   => 'text-left',
        'list'     => 'hover',
        'items'    => array(
            array( 'title' => 'Cartographie presse Afrique & International' ),
            array( 'title' => 'Conferences & voyages de presse' ),
            array( 'title' => 'Press kits & communiques premium' ),
            array( 'title' => 'Media training & coaching porte-paroles' ),
        ),
        'quote'    => '',
        'stats'    => array(),
        'image'    => '',
    ),
    array(
        'number'   => '04',
        'anchor'   => 'editorial',
        'eyebrow'  => 'Contenu & Editorial',
        'title'    => 'Production Editoriale & Contenus',
        'desc'     => 'Des contenus premium qui positionnent vos dirigeants comme des references : tribunes, discours, rapports annuels et publications institutionnelles d\'exception.',
        'bg'       => 'white',
        'layout'   => 'text-right',
        'list'     => 'arrows',
        'items'    => array(
            array( 'desc' => 'Tribunes et prises de parole strategiques' ),
            array( 'desc' => 'Discours institutionnels et speechwriting' ),
            array( 'desc' => 'Rapports annuels et publications corporate' ),
            array( 'desc' => 'Contenus digitaux et strategie editoriale' ),
        ),
        'quote'    => '',
        'stats'    => array(),
        'image'    => RCG_URI . '/assets/images/exp-editorial.png',
    ),
    array(
        'number'   => '05',
        'anchor'   => 'crise',
        'eyebrow'  => 'Gestion de Crise',
        'title'    => 'Communication de Crise',
        'desc'     => 'Dispositif de crise active 24/7 : anticipation, cellule de crise, media management et reconstruction de la reputation. Nous sommes votre bouclier communicationnel.',
        'bg'       => 'dark',
        'layout'   => 'text-left',
        'list'     => 'timeline',
        'items'    => array(
            array( 'icon' => '!', 'title' => 'Alerte & Activation', 'desc' => 'Detection precoce et mobilisation de la cellule de crise sous 2h.' ),
            array( 'icon' => '>', 'title' => 'Pilotage Operationnel', 'desc' => 'Strategie de reponse, elements de langage et coordination media.' ),
            array( 'icon' => '+', 'title' => 'Reconstruction', 'desc' => 'Plan de rehabilitation de l\'image et monitoring post-crise.' ),
        ),
        'quote'    => '',
        'stats'    => array(),
        'image'    => '',
    ),
    array(
        'number'   => '06',
        'anchor'   => 'branding',
        'eyebrow'  => 'Identite & Marque',
        'title'    => 'Branding & Identite Institutionnelle',
        'desc'     => 'Creation et evolution d\'identites visuelles qui incarnent la puissance et la credibilite de votre institution. Du logo a l\'ecosysteme de marque complet.',
        'bg'       => 'white',
        'layout'   => 'text-left',
        'list'     => 'cards',
        'items'    => array(
            array( 'icon' => 'palette', 'title' => 'Identite Visuelle' ),
            array( 'icon' => 'menu_book', 'title' => 'Charte Graphique' ),
            array( 'icon' => 'language', 'title' => 'Ecosysteme' ),
            array( 'icon' => 'trending_up', 'title' => 'Evolution Marque' ),
            array( 'icon' => 'devices', 'title' => 'Digital Design' ),
            array( 'icon' => 'print', 'title' => 'Print & Edition' ),
        ),
        'quote'    => 'Une identite institutionnelle forte est le socle de toute strategie de communication credible.',
        'stats'    => array(),
        'image'    => '',
    ),
);

$contact_page = get_page_by_path( 'contact' );
$contact_url  = $contact_page ? get_permalink( $contact_page ) : '#';
$reals_url    = get_permalink( get_page_by_path( 'realisations' ) );
if ( ! $reals_url ) $reals_url = '#';
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

            <span class="eyebrow mb-6">&mdash; Domaines d'Intervention</span>

            <h1 class="font-black text-5xl lg:text-[72px] uppercase leading-[1.05] mb-8 tracking-tight mt-4">
                <?php
                $hero_title = get_field( 'expertise_hero_title' );
                echo esc_html( $hero_title ? $hero_title : 'Six leviers au service de votre influence' );
                ?>
            </h1>

            <div class="line-accent mb-8"></div>

            <p class="text-white/60 text-lg max-w-xl leading-relaxed font-light">
                <?php
                $hero_desc = get_field( 'expertise_hero_description' );
                echo esc_html( $hero_desc ? $hero_desc : 'Six poles d\'excellence pour maitriser chaque dimension de la communication institutionnelle ouest-africaine — avec une precision et une exigence hors normes.' );
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
                        if ( ! $anchor ) $anchor = sanitize_title( get_the_title() );
                ?>
                    <a href="#<?php echo esc_attr( $anchor ); ?>" class="tag-pill text-white/50 border-white/20 hover:text-primary hover:border-primary transition-colors">
                        <?php echo esc_html( $number ); ?> &mdash; <?php the_title(); ?>
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
        if ( ! $anchor ) $anchor = sanitize_title( $exp_title );
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
            <h2 class="font-black text-3xl lg:text-4xl uppercase tracking-tight text-white">Un besoin specifique ?</h2>
            <p class="text-white/70 mt-2 text-lg">Notre equipe analyse votre contexte et vous propose une approche sur mesure.</p>
        </div>
        <a href="<?php echo esc_url( $contact_url ); ?>" class="bg-white text-primary font-bold text-xs uppercase tracking-widest px-10 py-5 hover:scale-105 transition-transform inline-block whitespace-nowrap">
            Planifier un echange
        </a>
    </div>
</section>

<?php get_footer(); ?>
