<?php
/**
 * Template Name: Insights
 * Description: Page blog/insights RCG - Articles, analyses, dossiers thematiques
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// === Donnees ACF ===
$hero_img     = get_field( 'ins_hero_image' );
$hero_url     = $hero_img ? $hero_img['url'] : get_template_directory_uri() . '/assets/images/insights-hero.png';
$hero_eyebrow = get_field( 'ins_hero_eyebrow' ) ?: 'Analyse & Décryptage';

// Ticker
$ticker_items = get_field( 'ins_ticker' );
if ( ! $ticker_items ) {
    $ticker_items = array(
        array( 'text' => 'Analyse : Communication institutionnelle et gouvernance en Afrique de l\'Ouest — Enjeux 2026' ),
        array( 'text' => 'Tendance : Personal Branding des dirigeants africains — Stratégies et bonnes pratiques' ),
        array( 'text' => 'Rapport : Relations presse & médias en zone CEDEAO — Panorama annuel RCG' ),
        array( 'text' => 'Opinion : Gestion de crise et réputation institutionnelle en UEMOA — Décryptage RCG West Africa' ),
    );
}

// Dossiers thematiques
$dossiers = get_field( 'ins_dossiers' );
if ( ! $dossiers ) {
    $dossiers = array(
        array( 'icon' => 'psychology',    'title' => 'Personal Branding',       'count' => '7 articles', 'bg' => 'dark', 'link' => '' ),
        array( 'icon' => 'crisis_alert',  'title' => 'Communication de Crise',  'count' => '5 articles', 'bg' => 'red',  'link' => '' ),
        array( 'icon' => 'newspaper',     'title' => 'Relations Presse & RP',   'count' => '9 articles', 'bg' => 'dark', 'link' => '' ),
        array( 'icon' => 'public',        'title' => 'Institutions & CEDEAO',   'count' => '4 articles', 'bg' => 'dark', 'link' => '' ),
    );
}

// Newsletter
$nl_title = get_field( 'ins_nl_title' ) ?: 'Ne manquez aucune analyse stratégique.';
$nl_desc  = get_field( 'ins_nl_desc' ) ?: 'La lettre mensuelle RCG Intelligence : analyses exclusives sur la communication institutionnelle en Afrique de l\'Ouest, décryptages des enjeux CEDEAO et perspectives des experts de RCG West Africa depuis Abidjan.';

// Filtre categories
$filter_cats = array(
    'all'       => 'Tous',
    'strategie' => 'Stratégie',
    'medias'    => 'Médias & RP',
    'crise'     => 'Communication de Crise',
    'leadership'=> 'Leadership & Image',
    'opinions'  => 'Opinions',
);

// === Article a la une (featured) ===
$featured_query = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'meta_key'       => 'insight_featured',
    'meta_value'     => '1',
) );
$featured_post = null;
$featured_id   = 0;
if ( $featured_query->have_posts() ) {
    $featured_query->the_post();
    $featured_post = get_post();
    $featured_id   = $featured_post->ID;
    wp_reset_postdata();
}

// Card bg map
$bg_map = array(
    'light' => 'bg-[#f4f4f4]',
    'dark'  => 'bg-surface-dark text-white',
    'white' => 'bg-white border border-gray-100',
    'black' => 'bg-background-dark text-white',
);
?>

<!-- ============================================
     TICKER / MARQUEE
     ============================================ -->
<div class="bg-surface-dark py-3 overflow-hidden border-b border-white/5">
    <div class="ticker-inner">
        <?php for ( $t = 0; $t < 2; $t++ ) : // Dupliquer pour boucle infinie ?>
            <span class="text-[10px] font-bold uppercase tracking-widest text-white/20 mx-6">RCG Insights —</span>
            <?php foreach ( $ticker_items as $ti ) : ?>
                <span class="text-[10px] tracking-wider text-white/50 mx-4"><?php echo esc_html( $ti['text'] ); ?></span>
                <span class="text-white/20 mx-3">·</span>
            <?php endforeach; ?>
        <?php endfor; ?>
    </div>
</div>

<!-- ============================================
     HERO HEADER — Article a la une
     ============================================ -->
<header class="relative bg-background-dark text-white overflow-hidden" style="min-height:90vh">
    <!-- Red accent line top -->
    <div class="absolute top-0 left-0 w-full h-1 bg-primary z-20"></div>

    <?php
    // Image hero : celle du post featured ou fallback
    $hero_thumb = '';
    if ( $featured_id ) {
        $hero_thumb = get_the_post_thumbnail_url( $featured_id, 'hero-large' );
    }
    if ( ! $hero_thumb ) {
        $hero_thumb = $hero_url;
    }
    ?>
    <img src="<?php echo esc_url( $hero_thumb ); ?>" alt="Insights RCG" class="absolute inset-0 w-full h-full object-cover opacity-35">
    <div class="absolute inset-0 bg-gradient-to-r from-background-dark via-background-dark/75 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 flex items-end justify-start" style="min-height:90vh">
        <div class="max-w-2xl pb-24 pt-20">
            <?php if ( $featured_post ) : ?>
                <?php
                $f_read    = get_field( 'insight_read_time', $featured_id ) ?: 8;
                $f_initials= get_field( 'insight_author_initials', $featured_id ) ?: 'RCG';
                $f_author  = get_the_author_meta( 'display_name', $featured_post->post_author );
                $f_cats    = get_the_terms( $featured_id, 'thematique_insight' );
                $f_cat_name= $f_cats && ! is_wp_error( $f_cats ) ? $f_cats[0]->name : $hero_eyebrow;
                $f_date    = get_the_date( 'F Y', $featured_id );
                ?>
                <!-- Tags -->
                <div class="flex items-center gap-3 mb-6 flex-wrap">
                    <span class="cat-tag text-primary border-primary/40"><?php echo esc_html( $f_cat_name ); ?></span>
                    <span class="text-white/30 text-[9px] uppercase tracking-widest font-semibold"><?php echo esc_html( $f_date ); ?></span>
                    <span class="read-time"><?php echo esc_html( $f_read ); ?> min de lecture</span>
                </div>
                <h1 class="font-black text-4xl lg:text-[60px] uppercase leading-[1.05] mb-6 tracking-tight">
                    <?php echo esc_html( get_the_title( $featured_id ) ); ?>
                </h1>
                <div class="line-accent mb-6"></div>
                <p class="text-white/60 text-lg leading-relaxed mb-8 font-light max-w-xl"><?php echo esc_html( get_the_excerpt( $featured_id ) ); ?></p>
                <div class="flex items-center gap-6">
                    <a href="<?php echo esc_url( get_permalink( $featured_id ) ); ?>" class="feature-link">
                        <?php esc_html_e( 'Lire l\'article complet', 'rcg' ); ?> <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </a>
                    <div class="h-4 w-[1px] bg-white/20"></div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white text-[9px] font-bold"><?php echo esc_html( $f_initials ); ?></div>
                        <span class="text-white/50 text-xs">par <strong class="text-white/80"><?php echo esc_html( $f_author ); ?></strong></span>
                    </div>
                </div>
            <?php else : ?>
                <!-- Fallback statique -->
                <div class="flex items-center gap-3 mb-6 flex-wrap">
                    <span class="cat-tag text-primary border-primary/40"><?php echo esc_html( $hero_eyebrow ); ?></span>
                    <span class="text-white/30 text-[9px] uppercase tracking-widest font-semibold">Mars 2026</span>
                    <span class="read-time">8 min de lecture</span>
                </div>
                <h1 class="font-black text-4xl lg:text-[60px] uppercase leading-[1.05] mb-6 tracking-tight">
                    Communication institutionnelle : enjeux et <span class="text-primary">stratégie</span> en Afrique de l'Ouest
                </h1>
                <div class="line-accent mb-6"></div>
                <p class="text-white/60 text-lg leading-relaxed mb-8 font-light max-w-xl">De la CEDEAO aux grandes entreprises ouest-africaines, la communication institutionnelle se réinvente. Décryptage des nouvelles stratégies par les experts de RCG West Africa.</p>
                <div class="flex items-center gap-6">
                    <span class="feature-link">Lire l'article complet <span class="material-symbols-outlined text-base">arrow_forward</span></span>
                    <div class="h-4 w-[1px] bg-white/20"></div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white text-[9px] font-bold">IK</div>
                        <span class="text-white/50 text-xs">par <strong class="text-white/80">Ibrahim KOUROUMA</strong></span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>

<!-- ============================================
     FILTER BAR (sticky)
     ============================================ -->
<div class="bg-white border-b border-gray-100 sticky top-[72px] z-40">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex items-center gap-0 overflow-x-auto" id="insights-filter-bar">
        <?php foreach ( $filter_cats as $slug => $label ) : ?>
            <button class="filter-tab<?php echo 'all' === $slug ? ' active' : ''; ?>" data-filter="<?php echo esc_attr( $slug ); ?>">
                <?php echo esc_html( $label ); ?>
            </button>
        <?php endforeach; ?>
    </div>
</div>

<!-- ============================================
     ARTICLES GRID — Dernières Publications
     ============================================ -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <!-- En-tete -->
        <div class="flex items-end justify-between mb-12">
            <div>
                <span class="eyebrow mb-3"><?php esc_html_e( 'Dernières Publications', 'rcg' ); ?></span>
                <h2 class="font-black text-3xl lg:text-4xl uppercase tracking-tight mt-2"><?php esc_html_e( 'Nos Analyses & Décryptages', 'rcg' ); ?></h2>
            </div>
            <?php
            $total_posts = wp_count_posts();
            $count       = $total_posts->publish;
            ?>
            <span class="hidden lg:block text-[10px] uppercase tracking-widest text-gray-400 font-semibold"><?php echo esc_html( $count . ' publications' ); ?></span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="insights-grid">
            <?php
            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $total_published = (int) wp_count_posts()->publish;
            $use_dynamic     = $total_published >= 3; // Minimum 3 articles pour le rendu dynamique

            $insights_query = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 9,
                'paged'          => $paged,
                'post__not_in'   => $featured_id ? array( $featured_id ) : array(),
            ) );

            if ( $use_dynamic && $insights_query->have_posts() ) :
                $index = 0;
                while ( $insights_query->have_posts() ) : $insights_query->the_post();
                    $index++;
                    $type       = get_field( 'insight_type' ) ?: 'standard';
                    $card_bg    = get_field( 'insight_card_bg' ) ?: 'light';
                    $read_time  = get_field( 'insight_read_time' ) ?: 5;
                    $initials   = get_field( 'insight_author_initials' ) ?: 'RCG';
                    $auth_title = get_field( 'insight_author_title' );
                    $is_dark    = in_array( $card_bg, array( 'dark', 'black' ), true );
                    $bg_class   = isset( $bg_map[ $card_bg ] ) ? $bg_map[ $card_bg ] : $bg_map['light'];

                    // Taxonomy
                    $terms    = get_the_terms( get_the_ID(), 'thematique_insight' );
                    $cat_name = $terms && ! is_wp_error( $terms ) ? $terms[0]->name : '';
                    $cat_slug = $terms && ! is_wp_error( $terms ) ? $terms[0]->slug : '';

                    // First article = 2-col featured card
                    $is_first   = ( 1 === $index );
                    $col_span   = $is_first ? ' lg:col-span-2' : '';
                    $img_height = $is_first ? 'h-72 lg:h-[420px]' : 'h-52';
            ?>

                <?php if ( 'standard' === $type ) : ?>
                    <!-- CARTE STANDARD (avec image) -->
                    <div class="article-card <?php echo esc_attr( $bg_class . $col_span ); ?> group reveal" data-cat="<?php echo esc_attr( $cat_slug ); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="relative <?php echo esc_attr( $img_height ); ?> overflow-hidden">
                                <?php the_post_thumbnail( $is_first ? 'hero-large' : 'card-medium', array( 'class' => 'w-full h-full object-cover' ) ); ?>
                                <div class="absolute inset-0 bg-gradient-to-t <?php echo $is_dark ? 'from-surface-dark via-surface-dark/40' : 'from-background-dark/50'; ?> to-transparent"></div>
                                <?php if ( $cat_name ) : ?>
                                    <div class="absolute top-4 left-4">
                                        <span class="cat-tag <?php echo $is_dark ? 'text-primary border-primary/40' : 'text-white bg-background-dark/60 border-transparent backdrop-blur-sm'; ?>"><?php echo esc_html( $cat_name ); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $is_first ) : ?>
                                    <div class="article-num">01</div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="p-8">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-[9px] uppercase tracking-widest <?php echo $is_dark ? 'text-white/40' : 'text-gray-400'; ?> font-semibold"><?php echo esc_html( get_the_date( 'F Y' ) ); ?></span>
                                <span class="read-time"><?php echo esc_html( $read_time ); ?> min</span>
                            </div>
                            <h3 class="font-bold text-lg uppercase tracking-tight leading-tight mb-3">
                                <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors"><?php echo esc_html( get_the_title() ); ?></a>
                            </h3>
                            <p class="text-sm <?php echo $is_dark ? 'text-white/50' : 'text-gray-500'; ?> leading-relaxed mb-6"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 25 ) ); ?></p>
                            <div class="flex items-center justify-between mt-auto">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full <?php echo $is_dark ? 'bg-primary' : 'bg-surface-dark'; ?> flex items-center justify-center text-white text-[9px] font-bold"><?php echo esc_html( $initials ); ?></div>
                                    <span class="text-xs <?php echo $is_dark ? 'text-white/50' : 'text-gray-400'; ?>"><?php echo esc_html( get_the_author() ); ?></span>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="text-[10px] font-bold uppercase tracking-widest text-primary flex items-center gap-1 hover:gap-2 transition-all">
                                    <?php esc_html_e( 'Lire', 'rcg' ); ?> <span class="material-symbols-outlined text-sm">north_east</span>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php elseif ( 'opinion' === $type ) : ?>
                    <!-- CARTE OPINION / CITATION -->
                    <div class="article-card bg-white border border-gray-100 hover:shadow-lg group p-8 flex flex-col justify-between reveal" data-cat="<?php echo esc_attr( $cat_slug ); ?>">
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <?php if ( $cat_name ) : ?>
                                    <span class="cat-tag text-accent-opinion border-accent-opinion/30"><?php echo esc_html( $cat_name ); ?></span>
                                <?php endif; ?>
                                <span class="text-[9px] uppercase tracking-widest text-gray-400 font-semibold"><?php echo esc_html( get_the_date( 'M. Y' ) ); ?></span>
                            </div>
                            <div class="relative">
                                <span class="font-serif text-7xl text-primary/10 absolute -top-2 -left-2">"</span>
                                <h3 class="font-bold text-lg uppercase tracking-tight leading-tight pt-8 mb-4">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors"><?php echo esc_html( get_the_title() ); ?></a>
                                </h3>
                            </div>
                            <p class="text-sm text-gray-500 leading-relaxed"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?></p>
                        </div>
                        <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-background-dark flex items-center justify-center text-white text-[8px] font-bold"><?php echo esc_html( $initials ); ?></div>
                                <div>
                                    <span class="text-xs font-bold text-background-dark block"><?php echo esc_html( get_the_author() ); ?></span>
                                    <?php if ( $auth_title ) : ?>
                                        <span class="text-[9px] text-gray-400"><?php echo esc_html( $auth_title ); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="text-[10px] font-bold uppercase tracking-widest text-primary">Lire →</a>
                        </div>
                    </div>

                <?php elseif ( 'rapport' === $type ) : ?>
                    <!-- CARTE RAPPORT / DATA -->
                    <?php
                    $stat_val   = get_field( 'insight_stat_value' ) ?: '73%';
                    $stat_label = get_field( 'insight_stat_label' ) ?: '';
                    $report_pg  = get_field( 'insight_report_pages' ) ?: '';
                    $report_url = get_field( 'insight_report_file' ) ?: get_permalink();
                    ?>
                    <div class="article-card bg-background-dark text-white p-8 flex flex-col justify-between group reveal" data-cat="<?php echo esc_attr( $cat_slug ); ?>">
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <?php if ( $cat_name ) : ?>
                                    <span class="cat-tag text-accent-rapport border-accent-rapport/40"><?php echo esc_html( $cat_name ); ?></span>
                                <?php endif; ?>
                                <span class="text-[9px] uppercase tracking-widest text-white/40 font-semibold"><?php echo esc_html( get_the_date( 'M. Y' ) ); ?></span>
                            </div>
                            <div class="font-black text-6xl text-primary leading-none mb-2"><?php echo esc_html( $stat_val ); ?></div>
                            <?php if ( $stat_label ) : ?>
                                <span class="text-[10px] uppercase tracking-widest text-white/40"><?php echo esc_html( $stat_label ); ?></span>
                            <?php endif; ?>
                            <h3 class="font-bold text-lg uppercase tracking-tight leading-tight mt-6 mb-3">
                                <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors"><?php echo esc_html( get_the_title() ); ?></a>
                            </h3>
                            <p class="text-sm text-white/50 leading-relaxed"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 25 ) ); ?></p>
                        </div>
                        <div class="flex items-center justify-between mt-8 pt-6 border-t border-white/10">
                            <?php if ( $report_pg ) : ?>
                                <span class="text-[9px] uppercase tracking-widest text-white/30 font-semibold">Rapport Complet — <?php echo esc_html( $report_pg ); ?></span>
                            <?php endif; ?>
                            <a href="<?php echo esc_url( $report_url ); ?>" class="text-[10px] font-bold uppercase tracking-widest text-primary flex items-center gap-1 hover:gap-2 transition-all">
                                <?php esc_html_e( 'Télécharger', 'rcg' ); ?> <span class="material-symbols-outlined text-sm">download</span>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // ============================
                // FALLBACK STATIQUE (5 articles)
                // ============================
                $fallback_articles = array(
                    array(
                        'type' => 'standard', 'bg' => 'bg-surface-dark text-white', 'span' => ' lg:col-span-2', 'img_h' => 'h-72 lg:h-[420px]',
                        'img' => 'insights-leaders.png', 'cat' => 'Stratégie', 'cat_slug' => 'strategie', 'cat_class' => 'text-primary border-primary/40',
                        'date' => 'Mars 2026', 'read' => '12', 'title' => 'Gouvernance & Communication Institutionnelle : Le nouveau paradigme des décideurs en zone CEDEAO',
                        'excerpt' => 'Comment les institutions ouest-africaines — CEDEAO, BAD, UEMOA — repensent leur stratégie de communication face aux exigences des citoyens et partenaires internationaux. Analyse RCG West Africa.',
                        'initials' => 'IK', 'author' => 'Ibrahim KOUROUMA', 'dark' => true, 'num' => '01',
                    ),
                    array(
                        'type' => 'standard', 'bg' => 'bg-[#f4f4f4]', 'span' => '', 'img_h' => 'h-52',
                        'img' => 'insights-journaliste.png', 'cat' => 'Médias & RP', 'cat_slug' => 'medias', 'cat_class' => 'text-white bg-background-dark/60 border-transparent backdrop-blur-sm',
                        'date' => 'Février 2026', 'read' => '6', 'title' => 'Relations Presse en Afrique de l\'Ouest : Stratégies RP pour institutions et entreprises',
                        'excerpt' => 'Le paysage médiatique ouest-africain évolue rapidement. Décryptage des nouvelles approches de relations presse efficaces en Côte d\'Ivoire et dans la sous-région.',
                        'initials' => 'RCG', 'author' => 'Équipe RCG', 'dark' => false, 'num' => '',
                    ),
                    array(
                        'type' => 'standard', 'bg' => 'bg-surface-dark text-white', 'span' => '', 'img_h' => 'h-52',
                        'img' => 'insights-crise.png', 'cat' => 'Crise', 'cat_slug' => 'crise', 'cat_class' => 'text-primary border-primary/40',
                        'date' => 'Janvier 2026', 'read' => '10', 'title' => 'Communication de Crise en Afrique : Anticiper, Réagir, Protéger la réputation',
                        'excerpt' => 'De la cellule de crise traditionnelle au dispositif digital : comment les organisations africaines modernisent leur gestion de crise réputationnelle.',
                        'initials' => 'RCG', 'author' => 'Pôle Conseil RCG', 'dark' => true, 'num' => '',
                    ),
                    array(
                        'type' => 'opinion', 'cat' => 'Opinion', 'cat_slug' => 'opinions',
                        'date' => 'Déc. 2025', 'title' => 'La discrétion stratégique reste le premier atout du communicant institutionnel en Afrique de l\'Ouest.',
                        'excerpt' => 'Dans un monde sursaturé de visibilité, savoir quand et comment communiquer devient un avantage stratégique. Réflexion sur le conseil en communication institutionnelle en zone CEDEAO.',
                        'initials' => 'IK', 'author' => 'Ibrahim KOUROUMA', 'auth_title' => 'Fondateur & DG, RCG West Africa',
                    ),
                    array(
                        'type' => 'rapport', 'cat' => 'Rapport', 'cat_slug' => 'strategie',
                        'date' => 'Nov. 2025', 'stat' => '73', 'stat_unit' => '%', 'stat_label' => 'des dirigeants ouest-africains interrogés',
                        'title' => 'Baromètre 2025 de la Communication Institutionnelle en Afrique de l\'Ouest — CEDEAO',
                        'excerpt' => 'Résultats exclusifs de notre étude sur les pratiques de communication institutionnelle dans 10 pays d\'Afrique de l\'Ouest : Côte d\'Ivoire, Sénégal, Ghana, Guinée, Mali et plus.',
                        'pages' => '48 pages',
                    ),
                );

                foreach ( $fallback_articles as $art ) :
                    if ( 'standard' === $art['type'] ) :
            ?>
                <div class="article-card <?php echo esc_attr( $art['bg'] . $art['span'] ); ?> group reveal" data-cat="<?php echo esc_attr( $art['cat_slug'] ); ?>">
                    <div class="relative <?php echo esc_attr( $art['img_h'] ); ?> overflow-hidden">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $art['img'] ); ?>" alt="<?php echo esc_attr( $art['title'] ); ?>" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t <?php echo $art['dark'] ? 'from-surface-dark via-surface-dark/40' : 'from-background-dark/50'; ?> to-transparent"></div>
                        <div class="absolute top-4 left-4">
                            <span class="cat-tag <?php echo esc_attr( $art['cat_class'] ); ?>"><?php echo esc_html( $art['cat'] ); ?></span>
                        </div>
                        <?php if ( $art['num'] ) : ?>
                            <div class="article-num"><?php echo esc_html( $art['num'] ); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-[9px] uppercase tracking-widest <?php echo $art['dark'] ? 'text-white/40' : 'text-gray-400'; ?> font-semibold"><?php echo esc_html( $art['date'] ); ?></span>
                            <span class="read-time"><?php echo esc_html( $art['read'] ); ?> min</span>
                        </div>
                        <h3 class="font-bold text-lg uppercase tracking-tight leading-tight mb-3"><?php echo esc_html( $art['title'] ); ?></h3>
                        <p class="text-sm <?php echo $art['dark'] ? 'text-white/50' : 'text-gray-500'; ?> leading-relaxed mb-6"><?php echo esc_html( $art['excerpt'] ); ?></p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full <?php echo $art['dark'] ? 'bg-primary' : 'bg-surface-dark'; ?> flex items-center justify-center text-white text-[9px] font-bold"><?php echo esc_html( $art['initials'] ); ?></div>
                                <span class="text-xs <?php echo $art['dark'] ? 'text-white/50' : 'text-gray-400'; ?>"><?php echo esc_html( $art['author'] ); ?></span>
                            </div>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-primary flex items-center gap-1">Lire <span class="material-symbols-outlined text-sm">north_east</span></span>
                        </div>
                    </div>
                </div>
            <?php elseif ( 'opinion' === $art['type'] ) : ?>
                <div class="article-card bg-white border border-gray-100 hover:shadow-lg group p-8 flex flex-col justify-between reveal" data-cat="<?php echo esc_attr( $art['cat_slug'] ); ?>">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="cat-tag text-accent-opinion border-accent-opinion/30"><?php echo esc_html( $art['cat'] ); ?></span>
                            <span class="text-[9px] uppercase tracking-widest text-gray-400 font-semibold"><?php echo esc_html( $art['date'] ); ?></span>
                        </div>
                        <div class="relative">
                            <span class="font-serif text-7xl text-primary/10 absolute -top-2 -left-2">"</span>
                            <h3 class="font-bold text-lg uppercase tracking-tight leading-tight pt-8 mb-4"><?php echo esc_html( $art['title'] ); ?></h3>
                        </div>
                        <p class="text-sm text-gray-500 leading-relaxed"><?php echo esc_html( $art['excerpt'] ); ?></p>
                    </div>
                    <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-background-dark flex items-center justify-center text-white text-[8px] font-bold"><?php echo esc_html( $art['initials'] ); ?></div>
                            <div>
                                <span class="text-xs font-bold text-background-dark block"><?php echo esc_html( $art['author'] ); ?></span>
                                <span class="text-[9px] text-gray-400"><?php echo esc_html( $art['auth_title'] ); ?></span>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-primary">Lire →</span>
                    </div>
                </div>
            <?php elseif ( 'rapport' === $art['type'] ) : ?>
                <div class="article-card bg-background-dark text-white p-8 flex flex-col justify-between group reveal" data-cat="<?php echo esc_attr( $art['cat_slug'] ); ?>">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="cat-tag text-accent-rapport border-accent-rapport/40"><?php echo esc_html( $art['cat'] ); ?></span>
                            <span class="text-[9px] uppercase tracking-widest text-white/40 font-semibold"><?php echo esc_html( $art['date'] ); ?></span>
                        </div>
                        <div class="font-black text-6xl text-primary leading-none mb-2"><?php echo esc_html( $art['stat'] ); ?><span class="text-3xl"><?php echo esc_html( $art['stat_unit'] ); ?></span></div>
                        <span class="text-[10px] uppercase tracking-widest text-white/40"><?php echo esc_html( $art['stat_label'] ); ?></span>
                        <h3 class="font-bold text-lg uppercase tracking-tight leading-tight mt-6 mb-3"><?php echo esc_html( $art['title'] ); ?></h3>
                        <p class="text-sm text-white/50 leading-relaxed"><?php echo esc_html( $art['excerpt'] ); ?></p>
                    </div>
                    <div class="flex items-center justify-between mt-8 pt-6 border-t border-white/10">
                        <span class="text-[9px] uppercase tracking-widest text-white/30 font-semibold">Rapport Complet — <?php echo esc_html( $art['pages'] ); ?></span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-primary flex items-center gap-1">Télécharger <span class="material-symbols-outlined text-sm">download</span></span>
                    </div>
                </div>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Charger plus -->
        <div class="text-center mt-16" id="load-more-wrap">
            <button id="load-more-btn" class="border border-background-dark text-background-dark font-bold text-[11px] uppercase tracking-widest px-10 py-4 hover:bg-background-dark hover:text-white transition-all">
                <?php esc_html_e( 'Charger plus d\'articles', 'rcg' ); ?>
            </button>
        </div>
    </div>
</section>

<!-- ============================================
     DOSSIERS THEMATIQUES
     ============================================ -->
<section class="py-20 bg-[#f4f4f4] reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <span class="eyebrow mb-3"><?php esc_html_e( 'Dossiers Thématiques', 'rcg' ); ?></span>
        <h2 class="font-black text-2xl lg:text-3xl uppercase tracking-tight mt-2 mb-10"><?php esc_html_e( 'Explorez par thème', 'rcg' ); ?></h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <?php foreach ( $dossiers as $dos ) :
                $is_red  = 'red' === $dos['bg'];
                $bg_cls  = $is_red ? 'bg-primary text-white' : 'bg-surface-dark text-white';
                $icon_cl = $is_red ? 'text-white' : 'text-primary';
            ?>
                <a href="<?php echo $dos['link'] ? esc_url( $dos['link'] ) : '#'; ?>" class="dossier-card <?php echo esc_attr( $bg_cls ); ?> h-56 flex flex-col justify-between p-6 group relative overflow-hidden cursor-pointer">
                    <!-- Hover overlay -->
                    <div class="absolute inset-0 bg-primary opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div>
                        <span class="material-symbols-outlined text-3xl <?php echo esc_attr( $icon_cl ); ?> mb-3 block"><?php echo esc_html( $dos['icon'] ); ?></span>
                        <h3 class="font-bold text-lg uppercase tracking-tight"><?php echo esc_html( $dos['title'] ); ?></h3>
                    </div>
                    <div>
                        <span class="text-[9px] uppercase tracking-widest <?php echo $is_red ? 'text-white/70' : 'text-white/40'; ?> font-semibold"><?php echo esc_html( $dos['count'] ); ?></span>
                        <div class="dossier-bar h-0.5 bg-primary mt-3 <?php echo $is_red ? 'bg-white' : ''; ?>"></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================
     NEWSLETTER
     ============================================ -->
<section class="newsletter-band py-24 text-white reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <!-- Texte -->
            <div>
                <span class="eyebrow mb-4"><?php esc_html_e( 'RCG Intelligence', 'rcg' ); ?></span>
                <h2 class="font-black text-3xl lg:text-4xl uppercase tracking-tight mt-2">
                    <?php
                    $nl_parts = explode( ' ', $nl_title );
                    $nl_last  = array_pop( $nl_parts );
                    echo esc_html( implode( ' ', $nl_parts ) );
                    ?>
                    <span class="text-primary"><?php echo esc_html( $nl_last ); ?></span>
                </h2>
                <div class="line-accent mt-4 mb-6"></div>
                <p class="text-white/60 text-sm leading-relaxed max-w-md"><?php echo esc_html( $nl_desc ); ?></p>
                <div class="mt-6 space-y-3">
                    <?php
                    $checks = array( '1 édition par mois depuis Abidjan', 'Analyses exclusives sur la zone CEDEAO', 'Décryptages et données sectorielles' );
                    foreach ( $checks as $check ) :
                    ?>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-sm">check_circle</span>
                            <span class="text-white/60 text-xs"><?php echo esc_html( $check ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="bg-surface-mid p-10">
                <h3 class="font-bold text-lg uppercase tracking-tight mb-6"><?php esc_html_e( 'S\'abonner à la lettre', 'rcg' ); ?></h3>
                <form class="space-y-4" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <?php wp_nonce_field( 'rcg_newsletter', 'rcg_newsletter_nonce' ); ?>
                    <input type="hidden" name="action" value="rcg_newsletter_subscribe">
                    <div>
                        <label class="text-[9px] uppercase tracking-widest text-white/40 font-semibold block mb-2"><?php esc_html_e( 'Nom & Prénom', 'rcg' ); ?></label>
                        <input type="text" name="nl_name" class="w-full bg-white/5 border border-white/10 px-4 py-3 text-sm text-white placeholder-white/30 focus:border-primary focus:outline-none transition-colors" placeholder="Votre nom complet">
                    </div>
                    <div>
                        <label class="text-[9px] uppercase tracking-widest text-white/40 font-semibold block mb-2"><?php esc_html_e( 'Email Professionnel', 'rcg' ); ?> *</label>
                        <input type="email" name="nl_email" required class="w-full bg-white/5 border border-white/10 px-4 py-3 text-sm text-white placeholder-white/30 focus:border-primary focus:outline-none transition-colors" placeholder="prenom@organisation.com">
                    </div>
                    <div>
                        <label class="text-[9px] uppercase tracking-widest text-white/40 font-semibold block mb-2"><?php esc_html_e( 'Thématiques d\'intérêt', 'rcg' ); ?></label>
                        <select name="nl_theme" class="w-full bg-white/5 border border-white/10 px-4 py-3 text-sm text-white/60 focus:border-primary focus:outline-none transition-colors appearance-none">
                            <option value="all"><?php esc_html_e( 'Toutes les thématiques', 'rcg' ); ?></option>
                            <option value="strategie"><?php esc_html_e( 'Stratégie & Conseil', 'rcg' ); ?></option>
                            <option value="medias"><?php esc_html_e( 'Médias & Relations Presse', 'rcg' ); ?></option>
                            <option value="crise"><?php esc_html_e( 'Communication de Crise', 'rcg' ); ?></option>
                            <option value="leadership"><?php esc_html_e( 'Leadership & Image', 'rcg' ); ?></option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-primary text-white font-bold text-[11px] uppercase tracking-widest py-4 hover:bg-red-700 transition-colors mt-2">
                        <?php esc_html_e( 'S\'abonner gratuitement →', 'rcg' ); ?>
                    </button>
                    <p class="text-[9px] text-white/30 text-center mt-2"><?php esc_html_e( 'Sans engagement. Désinscription à tout moment.', 'rcg' ); ?></p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
