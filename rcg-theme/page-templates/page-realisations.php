<?php
/**
 * Template Name: Realisations
 * Description: Page vitrine des realisations RCG avec filtres, mission signature, timeline
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// === Donnees ACF (avec fallbacks) ===
$eyebrow    = get_field( 'real_page_eyebrow' ) ?: 'Preuves d\'Impact';
$hero_title = get_field( 'real_page_title' ) ?: 'Des résultats qui parlent d\'eux-mêmes.';
$hero_desc  = get_field( 'real_page_desc' ) ?: 'Gouvernements, institutions internationales, entreprises panafricaines : découvrez les missions qui ont transformé les perceptions et bâti des réputations.';
$hero_img   = get_field( 'real_page_hero_image' );
$hero_url   = $hero_img ? $hero_img['url'] : get_template_directory_uri() . '/assets/images/real-header-hero.png';

// Stats
$stats = get_field( 'real_page_stats' );
if ( ! $stats ) {
    $stats = array(
        array( 'value' => '120+', 'label' => 'Missions accomplies', 'highlight' => true ),
        array( 'value' => '15',   'label' => 'Pays d\'intervention', 'highlight' => false ),
        array( 'value' => '98%',  'label' => 'Objectifs atteints',   'highlight' => false ),
        array( 'value' => '18',   'label' => 'Années d\'expertise',  'highlight' => false ),
    );
}

// Quote
$quote        = get_field( 'real_page_quote' ) ?: 'Nous ne mesurons pas notre succès en titres de presse. Nous le mesurons en décisions politiques, en contrats signés et en réputations préservées.';
$quote_author = get_field( 'real_page_quote_author' ) ?: 'Direction Générale — RCG West Africa';

// Secteurs
$secteurs_title = get_field( 'real_page_secteurs_title' ) ?: 'Une expertise transversale, des résultats ciblés';
$secteurs_desc  = get_field( 'real_page_secteurs_desc' ) ?: 'RCG intervient dans des environnements complexes où la communication est un levier de pouvoir. Chaque secteur bénéficie d\'une approche sur mesure.';
$secteurs       = get_field( 'real_page_secteurs' );
if ( ! $secteurs ) {
    $secteurs = array(
        array( 'icon' => 'account_balance',   'label' => 'Institutions Publiques' ),
        array( 'icon' => 'public',            'label' => 'Org. Internationales' ),
        array( 'icon' => 'corporate_fare',    'label' => 'Entreprises Privées' ),
        array( 'icon' => 'handshake',         'label' => 'Diplomatie' ),
        array( 'icon' => 'health_and_safety', 'label' => 'Santé Publique' ),
        array( 'icon' => 'factory',           'label' => 'Industrie & Mines' ),
    );
}

// Timeline
$timeline = get_field( 'real_page_timeline' );
if ( ! $timeline ) {
    $timeline = array(
        array( 'year' => '2006', 'title' => 'Fondation à Abidjan',    'description' => 'Création de RCG avec une vision claire : professionnaliser la communication institutionnelle en Afrique de l\'Ouest.', 'is_current' => false ),
        array( 'year' => '2012', 'title' => 'Expansion Régionale',    'description' => 'Ouverture du bureau de Paris et extension à 8 nouveaux pays de la sous-région.', 'is_current' => false ),
        array( 'year' => '2018', 'title' => '100ème Mission',         'description' => 'Cap symbolique franchi avec des clients dans 12 pays et 3 langues de travail.', 'is_current' => false ),
        array( 'year' => '2026', 'title' => 'Leader Incontesté',      'description' => '18 ans d\'expertise, 120+ missions réussies, et un réseau inégalé en Afrique de l\'Ouest.', 'is_current' => true ),
    );
}

$exp_list = get_field( 'real_page_expertises_list' );
if ( ! $exp_list ) {
    $exp_list = array(
        array( 'label' => 'Communication Gouvernementale' ),
        array( 'label' => 'Gestion de Crise & Réputation' ),
        array( 'label' => 'Relations Presse Panafricaines' ),
        array( 'label' => 'Branding Institutionnel' ),
        array( 'label' => 'Stratégie Éditoriale & Contenus' ),
    );
}
$callout_value = get_field( 'real_page_callout_value' ) ?: '48h';
$callout_text  = get_field( 'real_page_callout_text' ) ?: 'Délai max d\'activation d\'une cellule de crise';

// CTA
$cta_title = get_field( 'real_page_cta_title' ) ?: 'Votre mission sera notre prochaine réalisation.';
$cta_desc  = get_field( 'real_page_cta_desc' ) ?: 'Contactez-nous pour discuter de votre projet et bâtir ensemble votre succès.';
$cta_btn   = get_field( 'real_page_cta_btn' ) ?: 'Démarrer votre projet';

// Contact URL
$contact_page = get_page_by_path( 'contact' );
$contact_url  = $contact_page ? get_permalink( $contact_page ) : '#';

// Filtres categories
$filter_cats = array(
    'all'         => 'Tous',
    'institution' => 'Institutions Publiques',
    'entreprise'  => 'Entreprises',
    'orga'        => 'Org. Internationales',
    'crise'       => 'Com. de Crise',
);

// Badge color map
$badge_colors = array(
    'red'   => 'text-primary border-primary/50',
    'green' => 'text-accent-green border-accent-green/50',
    'blue'  => 'text-accent-blue border-accent-blue/50',
    'amber' => 'text-amber-500 border-amber-500/50',
);

// Category slug map (badge_color => data-cat)
$cat_slug_map = array(
    'red'   => 'crise',
    'green' => 'entreprise',
    'blue'  => 'institution',
    'amber' => 'orga',
);
?>

<!-- ============================================
     SECTION 1 : HERO HEADER
     ============================================ -->
<header class="relative bg-background-dark text-white min-h-[75vh] flex items-end overflow-hidden">
    <!-- Image de fond -->
    <img src="<?php echo esc_url( $hero_url ); ?>" alt="<?php echo esc_attr( $hero_title ); ?>" class="absolute inset-0 w-full h-full object-cover object-top opacity-35" loading="eager">

    <!-- Gradient overlays -->
    <div class="absolute inset-0 bg-gradient-to-r from-background-dark via-background-dark/80 to-background-dark/20"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent"></div>

    <!-- Triangle decoratif -->
    <div class="absolute top-0 right-0 w-0 h-0 border-t-[300px] border-r-[300px] border-t-primary/20 border-r-transparent"></div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-12 pb-0 pt-32">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-[9px] uppercase tracking-widest mb-8">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-primary/60 hover:text-primary transition-colors"><?php esc_html_e( 'Accueil', 'rcg' ); ?></a>
            <span class="text-white/40">/</span>
            <span class="text-white/60"><?php esc_html_e( 'Réalisations', 'rcg' ); ?></span>
        </div>

        <!-- Eyebrow -->
        <span class="eyebrow mb-6"><?php echo esc_html( $eyebrow ); ?></span>

        <!-- Titre -->
        <h1 class="font-black text-5xl lg:text-[72px] uppercase leading-[1.05] tracking-tight mt-4 max-w-4xl">
            <?php
            $title_parts = explode( ' ', $hero_title );
            $last_word   = array_pop( $title_parts );
            echo esc_html( implode( ' ', $title_parts ) );
            ?>
            <span class="text-primary"><?php echo esc_html( $last_word ); ?></span>
        </h1>

        <!-- Ligne accent -->
        <div class="line-accent mt-6 mb-6"></div>

        <!-- Description -->
        <p class="text-white/60 text-lg font-light max-w-2xl"><?php echo esc_html( $hero_desc ); ?></p>

        <!-- Filtres -->
        <div class="border-t border-white/10 mt-12 pt-8 pb-12 flex flex-wrap gap-3" id="filter-bar">
            <?php foreach ( $filter_cats as $slug => $label ) : ?>
                <button class="filter-btn tag-pill text-white/50 border-white/20<?php echo 'all' === $slug ? ' active' : ''; ?>" data-filter="<?php echo esc_attr( $slug ); ?>">
                    <?php echo esc_html( $label ); ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</header>

<!-- ============================================
     SECTION 2 : BARRE DE STATS
     ============================================ -->
<section class="py-16 bg-white border-b border-gray-100 reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <?php foreach ( $stats as $stat ) :
                $is_highlight = ! empty( $stat['highlight'] );
                $value_class  = $is_highlight ? 'text-primary' : 'text-background-dark';
            ?>
                <div class="stat-left">
                    <div class="text-4xl font-black <?php echo esc_attr( $value_class ); ?>"><?php echo esc_html( $stat['value'] ); ?></div>
                    <div class="text-xs uppercase tracking-widest text-gray-500 mt-1 font-semibold"><?php echo esc_html( $stat['label'] ); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 3 : MISSION SIGNATURE (Featured)
     ============================================ -->
<?php
// Chercher la realisation "featured"
$featured_query = new WP_Query( array(
    'post_type'      => 'realisation',
    'posts_per_page' => 1,
    'meta_key'       => 'realisation_is_featured',
    'meta_value'     => '1',
) );

// Fallback si pas de featured
$has_featured = $featured_query->have_posts();
?>

<section class="py-24 bg-white reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <!-- En-tete -->
        <span class="eyebrow mb-4"><?php esc_html_e( 'Mission Signature', 'rcg' ); ?></span>
        <h2 class="text-3xl lg:text-5xl font-black uppercase tracking-tight mt-2 mb-12"><?php esc_html_e( 'Le cas de référence', 'rcg' ); ?></h2>

        <?php if ( $has_featured ) : ?>
            <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
                <?php
                $f_client    = get_field( 'realisation_client' );
                $f_desc      = get_field( 'realisation_short_desc' );
                $f_kpis      = get_field( 'realisation_kpis' );
                $f_tags      = get_field( 'realisation_tags' );
                $f_thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'hero-large' );
                if ( ! $f_thumb_url ) {
                    $f_thumb_url = get_template_directory_uri() . '/assets/images/real-mission-signature.png';
                }
                ?>
                <div class="bg-surface-dark text-white grid lg:grid-cols-[55%_45%] overflow-hidden">
                    <!-- Texte -->
                    <div class="p-10 lg:p-16 flex flex-col justify-center">
                        <!-- Tags -->
                        <?php if ( $f_tags ) : ?>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <?php foreach ( $f_tags as $i => $tag ) : ?>
                                    <span class="tag-pill <?php echo 0 === $i ? 'text-primary border-primary/40' : 'text-white/40 border-white/20'; ?>">
                                        <?php echo esc_html( $tag['text'] ); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <h3 class="text-2xl lg:text-3xl font-black uppercase tracking-tight leading-tight"><?php echo esc_html( get_the_title() ); ?></h3>

                        <?php if ( $f_desc ) : ?>
                            <p class="text-white/60 mt-4 text-sm leading-relaxed"><?php echo esc_html( $f_desc ); ?></p>
                        <?php endif; ?>

                        <!-- KPIs -->
                        <?php if ( $f_kpis ) : ?>
                            <div class="grid grid-cols-3 gap-6 mt-8 pt-8 border-t border-white/10">
                                <?php foreach ( $f_kpis as $kpi ) : ?>
                                    <div>
                                        <div class="text-2xl font-black text-primary"><?php echo esc_html( $kpi['value'] ); ?></div>
                                        <div class="text-[10px] uppercase tracking-widest text-white/40 mt-1"><?php echo esc_html( $kpi['label'] ); ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <a href="<?php echo esc_url( $contact_url ); ?>" class="inline-flex items-center gap-2 mt-8 text-[10px] font-bold uppercase tracking-widest text-primary hover:text-white transition-colors">
                            <?php esc_html_e( 'Mission similaire ? Parlons', 'rcg' ); ?> <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                    <!-- Image -->
                    <div class="relative h-80 lg:h-auto overflow-hidden">
                        <img src="<?php echo esc_url( $f_thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-background-dark/60 to-transparent lg:hidden"></div>
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-primary"></div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

        <?php else : ?>
            <!-- Fallback statique -->
            <div class="bg-surface-dark text-white grid lg:grid-cols-[55%_45%] overflow-hidden">
                <div class="p-10 lg:p-16 flex flex-col justify-center">
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="tag-pill text-primary border-primary/40">Institution Publique</span>
                        <span class="tag-pill text-white/40 border-white/20">Côte d'Ivoire</span>
                    </div>
                    <h3 class="text-2xl lg:text-3xl font-black uppercase tracking-tight leading-tight">Stratégie de Communication Nationale — Ministère de l'Économie</h3>
                    <p class="text-white/60 mt-4 text-sm leading-relaxed">Redéfinition complète du narratif économique pour rassurer les bailleurs de fonds internationaux suite à un contexte inflationniste mondial. Une opération coup de poing sur 8 semaines couvrant 4 pays simultanément.</p>
                    <div class="grid grid-cols-3 gap-6 mt-8 pt-8 border-t border-white/10">
                        <div>
                            <div class="text-2xl font-black text-primary">+65%</div>
                            <div class="text-[10px] uppercase tracking-widest text-white/40 mt-1">Couverture médiatique</div>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-primary">4</div>
                            <div class="text-[10px] uppercase tracking-widest text-white/40 mt-1">Pays Ciblés en simultané</div>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-primary">8 Sem.</div>
                            <div class="text-[10px] uppercase tracking-widest text-white/40 mt-1">Temps de déploiement</div>
                        </div>
                    </div>
                    <a href="<?php echo esc_url( $contact_url ); ?>" class="inline-flex items-center gap-2 mt-8 text-[10px] font-bold uppercase tracking-widest text-primary hover:text-white transition-colors">
                        Mission similaire ? Parlons <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
                <div class="relative h-80 lg:h-auto overflow-hidden">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/real-mission-signature.png' ); ?>" alt="Stratégie Ministère Économie" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-primary"></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ============================================
     SECTION 4 : GRILLE PORTFOLIO (toutes realisations)
     ============================================ -->
<section id="grid-section" class="py-24 bg-[#f4f4f4] reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="cases-grid">
            <?php
            $cases_query = new WP_Query( array(
                'post_type'      => 'realisation',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order date',
                'order'          => 'ASC',
            ) );

            if ( $cases_query->have_posts() ) :
                while ( $cases_query->have_posts() ) : $cases_query->the_post();
                    $r_client      = get_field( 'realisation_client' );
                    $r_desc        = get_field( 'realisation_short_desc' );
                    $r_badge_color = get_field( 'realisation_badge_color' ) ?: 'red';
                    $r_is_crisis   = get_field( 'realisation_is_crisis' );
                    $r_results     = get_field( 'realisation_results' );
                    $r_thumb_url   = get_the_post_thumbnail_url( get_the_ID(), 'card-medium' );

                    // Categorie taxonomy
                    $terms    = get_the_terms( get_the_ID(), 'categorie_expertise' );
                    $cat_name = $terms && ! is_wp_error( $terms ) ? $terms[0]->name : '';
                    $cat_slug = isset( $cat_slug_map[ $r_badge_color ] ) ? $cat_slug_map[ $r_badge_color ] : 'all';

                    $badge_class = isset( $badge_colors[ $r_badge_color ] ) ? $badge_colors[ $r_badge_color ] : $badge_colors['red'];
            ?>
                <div class="case-card case-item bg-white flex flex-col cursor-default border-t-[3px] border-transparent hover:border-primary" data-cat="<?php echo esc_attr( $cat_slug ); ?>">
                    <!-- Image -->
                    <div class="case-img relative h-52 overflow-hidden">
                        <?php if ( $r_thumb_url ) : ?>
                            <img src="<?php echo esc_url( $r_thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover">
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-background-dark/60 to-transparent"></div>
                        <!-- Badge categorie -->
                        <div class="absolute top-4 left-4">
                            <span class="tag-pill <?php echo esc_attr( $badge_class ); ?> bg-white/80 backdrop-blur-sm">
                                <?php echo esc_html( $cat_name ); ?>
                                <?php if ( $r_is_crisis ) : ?>
                                    <span class="crisis-dot ml-1"></span>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                    <!-- Contenu -->
                    <div class="p-8 flex flex-col flex-1">
                        <h3 class="font-bold text-lg uppercase tracking-tight leading-tight"><?php echo esc_html( get_the_title() ); ?></h3>
                        <?php if ( $r_client ) : ?>
                            <span class="text-[10px] uppercase tracking-widest text-gray-400 mt-2 block"><?php echo esc_html( $r_client ); ?></span>
                        <?php endif; ?>
                        <hr class="h-px bg-gray-100 border-0 my-4">
                        <?php if ( $r_desc ) : ?>
                            <p class="text-sm text-gray-500 leading-relaxed flex-1"><?php echo esc_html( $r_desc ); ?></p>
                        <?php endif; ?>
                        <!-- Resultats -->
                        <?php if ( $r_results ) : ?>
                            <div class="flex items-center gap-4 mt-4 pt-4 border-t border-gray-100">
                                <?php foreach ( array_slice( $r_results, 0, 2 ) as $result ) : ?>
                                    <div class="flex items-center gap-1.5 text-[10px] uppercase tracking-widest font-semibold text-background-dark">
                                        <span class="material-symbols-outlined text-primary text-sm">check_circle</span>
                                        <?php echo esc_html( $result['text'] ); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback statique : 6 cartes
                $fallback_cases = array(
                    array(
                        'title'   => 'Rebranding Banque Panafricaine',
                        'client'  => 'Groupe Bancaire Leader - Abidjan',
                        'cat'     => 'entreprise',
                        'badge'   => 'Entreprise',
                        'color'   => 'text-accent-green border-accent-green/50',
                        'crisis'  => false,
                        'desc'    => 'Moderniser l\'image d\'une institution historique pour attirer une nouvelle génération d\'investisseurs et affirmer un positionnement régional ambitieux.',
                        'results' => array( 'Nouvelle identité', 'Adhésion +90%' ),
                        'img'     => 'real-rebranding-banque.png',
                    ),
                    array(
                        'title'   => 'Gestion de Grève Sectorielle',
                        'client'  => 'Industrie Extractive - Côte d\'Ivoire',
                        'cat'     => 'crise',
                        'badge'   => 'Com. de Crise',
                        'color'   => 'text-primary border-primary/50',
                        'crisis'  => true,
                        'desc'    => 'Maîtrise du narratif face à une crise syndicale risquant d\'impacter les cours d\'exportation et la confiance des investisseurs internationaux.',
                        'results' => array( '0 jour d\'arrêt', 'Dialogue rétabli' ),
                        'img'     => 'real-crise-sectorielle.png',
                    ),
                    array(
                        'title'   => 'Campagne de Santé Publique',
                        'client'  => 'Organisation Mondiale - 5 pays',
                        'cat'     => 'orga',
                        'badge'   => 'Org. Internationale',
                        'color'   => 'text-amber-500 border-amber-500/50',
                        'crisis'  => false,
                        'desc'    => 'Déploiement d\'une stratégie de terrain massive pour accélérer l\'adhésion à un programme préventif dans 5 pays d\'Afrique de l\'Ouest.',
                        'results' => array( '2M touchés', '100% objectifs' ),
                        'img'     => 'real-sante-publique.png',
                    ),
                    array(
                        'title'   => 'Coordination Sommet Régional CEDEAO',
                        'client'  => 'Union Économique - Dakar',
                        'cat'     => 'institution',
                        'badge'   => 'Institution Publique',
                        'color'   => 'text-accent-blue border-accent-blue/50',
                        'crisis'  => false,
                        'desc'    => 'Pilotage intégral de la communication du Sommet des Chefs d\'État avec 15 délégations et plus de 300 médias accrédités.',
                        'results' => array( '300+ médias', '15 délégations' ),
                        'img'     => 'real-sommet-cedeao.png',
                    ),
                    array(
                        'title'   => 'Personal Branding CEO Panafricain',
                        'client'  => 'Groupe Industriel - Lagos / Abidjan',
                        'cat'     => 'entreprise',
                        'badge'   => 'Entreprise',
                        'color'   => 'text-accent-green border-accent-green/50',
                        'crisis'  => false,
                        'desc'    => 'Construction de l\'image publique d\'un dirigeant influent à travers une présence média stratégique et un positionnement thought-leader.',
                        'results' => array( 'Top 10 voix secteur', '5 grands médias' ),
                        'img'     => 'real-branding-ceo.png',
                    ),
                    array(
                        'title'   => 'Restauration Réputation Institutionnelle',
                        'client'  => 'Banque Publique - Afrique de l\'Ouest',
                        'cat'     => 'crise',
                        'badge'   => 'Com. de Crise',
                        'color'   => 'text-primary border-primary/50',
                        'crisis'  => true,
                        'desc'    => 'Suite à une polémique sur des allégations de mauvaise gouvernance, RCG a mis en place en 72h un dispositif complet de réponse et de restauration d\'image.',
                        'results' => array( 'Crise maîtrisée', 'Image restaurée' ),
                        'img'     => 'real-crise-reputation.png',
                    ),
                );

                foreach ( $fallback_cases as $case ) :
            ?>
                <div class="case-card case-item bg-white flex flex-col cursor-default border-t-[3px] border-transparent hover:border-primary" data-cat="<?php echo esc_attr( $case['cat'] ); ?>">
                    <div class="case-img relative h-52 overflow-hidden">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $case['img'] ); ?>" alt="<?php echo esc_attr( $case['title'] ); ?>" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-background-dark/60 to-transparent"></div>
                        <div class="absolute top-4 left-4">
                            <span class="tag-pill <?php echo esc_attr( $case['color'] ); ?> bg-white/80 backdrop-blur-sm">
                                <?php echo esc_html( $case['badge'] ); ?>
                                <?php if ( $case['crisis'] ) : ?>
                                    <span class="crisis-dot ml-1"></span>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col flex-1">
                        <h3 class="font-bold text-lg uppercase tracking-tight leading-tight"><?php echo esc_html( $case['title'] ); ?></h3>
                        <span class="text-[10px] uppercase tracking-widest text-gray-400 mt-2 block"><?php echo esc_html( $case['client'] ); ?></span>
                        <hr class="h-px bg-gray-100 border-0 my-4">
                        <p class="text-sm text-gray-500 leading-relaxed flex-1"><?php echo esc_html( $case['desc'] ); ?></p>
                        <div class="flex items-center gap-4 mt-4 pt-4 border-t border-gray-100">
                            <?php foreach ( $case['results'] as $result ) : ?>
                                <div class="flex items-center gap-1.5 text-[10px] uppercase tracking-widest font-semibold text-background-dark">
                                    <span class="material-symbols-outlined text-primary text-sm">check_circle</span>
                                    <?php echo esc_html( $result ); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- No results -->
        <div id="no-results" class="hidden text-center py-16">
            <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">search_off</span>
            <h3 class="text-xl font-bold uppercase tracking-tight"><?php esc_html_e( 'Aucune réalisation trouvée', 'rcg' ); ?></h3>
            <p class="text-sm text-gray-500 mt-2"><?php esc_html_e( 'Essayez un autre filtre pour découvrir nos missions.', 'rcg' ); ?></p>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 5 : CITATION / TESTIMONIAL
     ============================================ -->
<section class="py-24 bg-background-dark overflow-hidden reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 relative">
        <!-- Decoratif -->
        <div class="absolute -top-20 -left-10 text-[300px] font-black text-white/5 leading-none select-none pointer-events-none">&laquo;</div>

        <div class="relative z-10 max-w-3xl mx-auto text-center">
            <blockquote class="font-lora italic text-2xl lg:text-3xl text-white/80 leading-relaxed">
                &laquo; <?php echo esc_html( $quote ); ?> &raquo;
            </blockquote>
            <div class="mt-8 flex items-center justify-center gap-3">
                <div class="w-8 h-px bg-primary"></div>
                <span class="text-[10px] uppercase tracking-widest text-white/40 font-semibold"><?php echo esc_html( $quote_author ); ?></span>
                <div class="w-8 h-px bg-primary"></div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 6 : SECTEURS D'INTERVENTION
     ============================================ -->
<section class="py-24 bg-white reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <div class="grid lg:grid-cols-3 gap-12 mb-16">
            <!-- Texte -->
            <div class="lg:col-span-2">
                <span class="eyebrow mb-4"><?php esc_html_e( 'Secteurs d\'Intervention', 'rcg' ); ?></span>
                <h2 class="text-3xl lg:text-4xl font-black uppercase tracking-tight mt-2"><?php echo esc_html( $secteurs_title ); ?></h2>
                <p class="text-gray-500 mt-4 text-sm leading-relaxed max-w-xl"><?php echo esc_html( $secteurs_desc ); ?></p>
            </div>
            <!-- Encart rouge -->
            <div class="bg-primary text-white p-8 flex flex-col justify-center">
                <p class="font-lora italic text-sm text-white/80 leading-relaxed">"Chaque secteur a ses codes, ses enjeux et ses publics. Notre force : les maîtriser tous."</p>
                <div class="mt-6 pt-4 border-t border-white/20">
                    <span class="text-3xl font-black">15</span>
                    <span class="text-[10px] uppercase tracking-widest text-white/60 ml-2">Pays couverts</span>
                </div>
            </div>
        </div>

        <!-- Grille secteurs -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <?php foreach ( $secteurs as $secteur ) : ?>
                <div class="sector-card bg-[#f4f4f4] p-6 text-center group cursor-default">
                    <span class="material-symbols-outlined text-3xl text-primary mb-3 block transition-colors"><?php echo esc_html( $secteur['icon'] ); ?></span>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-background-dark transition-colors"><?php echo esc_html( $secteur['label'] ); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 7 : TIMELINE (Histoire & Impact)
     ============================================ -->
<section class="py-24 bg-surface-dark text-white overflow-hidden reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 relative">

        <!-- Decoratif "18" -->
        <div class="absolute -top-20 right-0 text-[300px] lg:text-[400px] font-black text-white/5 leading-none select-none pointer-events-none">18</div>

        <div class="relative z-10">
            <span class="eyebrow mb-4"><?php esc_html_e( 'Histoire & Impact', 'rcg' ); ?></span>
            <h2 class="text-3xl lg:text-5xl font-black uppercase tracking-tight mt-2 mb-16"><?php esc_html_e( '18 ans d\'excellence', 'rcg' ); ?></h2>

            <div class="grid lg:grid-cols-2 gap-16">
                <!-- Timeline gauche -->
                <div class="space-y-0">
                    <?php foreach ( $timeline as $entry ) :
                        $is_current   = ! empty( $entry['is_current'] );
                        $circle_class = $is_current
                            ? 'w-8 h-8 rounded-full bg-primary flex items-center justify-center shrink-0'
                            : 'w-8 h-8 rounded-full border-2 border-primary/40 flex items-center justify-center shrink-0';
                        $dot_class    = $is_current
                            ? 'w-3 h-3 rounded-full bg-white'
                            : 'w-2 h-2 rounded-full bg-primary/60';
                    ?>
                        <div class="timeline-item pb-10">
                            <div class="flex items-start gap-4" style="margin-left:-2px;">
                                <div class="<?php echo esc_attr( $circle_class ); ?>">
                                    <div class="<?php echo esc_attr( $dot_class ); ?>"></div>
                                </div>
                                <div class="pt-1">
                                    <span class="text-primary font-black text-xl"><?php echo esc_html( $entry['year'] ); ?></span>
                                    <h3 class="font-bold text-lg uppercase tracking-tight mt-1"><?php echo esc_html( $entry['title'] ); ?></h3>
                                    <p class="text-white/50 text-sm mt-2 leading-relaxed"><?php echo esc_html( $entry['description'] ); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Expertises droite -->
                <div>
                    <h3 class="text-[10px] font-bold uppercase tracking-widest text-white/40 mb-6"><?php esc_html_e( 'Domaines d\'excellence', 'rcg' ); ?></h3>
                    <div class="space-y-4">
                        <?php foreach ( $exp_list as $exp ) : ?>
                            <div class="flex items-center gap-3 py-3 border-b border-white/10 hover:text-primary transition-colors cursor-default">
                                <span class="material-symbols-outlined text-primary text-sm">arrow_forward</span>
                                <span class="text-sm font-semibold uppercase tracking-wider"><?php echo esc_html( $exp['label'] ); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Callout box -->
                    <div class="bg-primary p-6 mt-8">
                        <div class="text-4xl font-black"><?php echo esc_html( $callout_value ); ?></div>
                        <div class="text-[10px] uppercase tracking-widest text-white/80 mt-1 font-semibold"><?php echo esc_html( $callout_text ); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 8 : CTA FINAL
     ============================================ -->
<section class="bg-primary py-20 reveal">
    <div class="max-w-4xl mx-auto px-6 lg:px-12 text-center text-white">
        <h2 class="text-3xl lg:text-4xl font-black uppercase tracking-tight"><?php echo esc_html( $cta_title ); ?></h2>
        <p class="text-white/80 mt-4 text-lg font-light"><?php echo esc_html( $cta_desc ); ?></p>
        <a href="<?php echo esc_url( $contact_url ); ?>" class="inline-block mt-8 bg-white text-primary font-bold text-[11px] uppercase tracking-widest px-10 py-4 rounded-btn hover:scale-105 transition-transform">
            <?php echo esc_html( $cta_btn ); ?>
        </a>
    </div>
</section>

<?php get_footer(); ?>
