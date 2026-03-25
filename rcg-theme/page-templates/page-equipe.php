<?php
/**
 * Template Name: Équipe
 * Description: Page equipe RCG - Direction, membres seniors, poles operationnels
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// === Donnees ACF ===
$hero_img     = get_field( 'eq_hero_image' );
$hero_url     = $hero_img ? $hero_img['url'] : get_template_directory_uri() . '/assets/images/equipe-hero.png';
$hero_eyebrow = get_field( 'eq_hero_eyebrow' ) ?: '— L\'Equipe RCG West Africa';
$hero_title   = get_field( 'eq_hero_title' );
$hero_desc    = get_field( 'eq_hero_desc' ) ?: 'Strateges, experts en relations publiques, conseillers en communication institutionnelle et specialistes du digital — une equipe pluridisciplinaire basee a Abidjan, au service des decideurs et institutions d\'Afrique de l\'Ouest.';

// Stats hero
$hero_stats = get_field( 'eq_hero_stats' );
if ( ! $hero_stats ) {
    $hero_stats = array(
        array( 'value' => '20', 'suffix' => '+', 'label' => 'Experts & Consultants' ),
        array( 'value' => '10', 'suffix' => '+', 'label' => 'Domaines d\'expertise' ),
        array( 'value' => '15', 'suffix' => '+', 'label' => 'Annees d\'experience cumulee' ),
    );
}

// Manifesto
$manifesto = get_field( 'eq_manifesto' ) ?: '"Chaque membre de l\'equipe RCG est un stratege. Nous selectionnons des experts capables d\'allier rigueur internationale et connaissance approfondie du terrain africain." — Ibrahim KOUROUMA';

// Philosophie RH
$philo_eyebrow  = get_field( 'eq_philo_eyebrow' ) ?: '— Notre exigence';
$philo_title    = get_field( 'eq_philo_title' );
$philo_desc     = get_field( 'eq_philo_desc' ) ?: 'RCG West Africa recrute des professionnels aguerris, capables d\'intervenir sur des mandats sensibles aupres de gouvernements, institutions internationales et entreprises leaders en Afrique de l\'Ouest.';
$philo_criteria = get_field( 'eq_philo_criteria' );
if ( ! $philo_criteria ) {
    $philo_criteria = array(
        array( 'text' => 'Experience significative en communication institutionnelle ou conseil strategique' ),
        array( 'text' => 'Maitrise du francais et de l\'anglais — environnement CEDEAO' ),
        array( 'text' => 'Connaissance des ecosystemes politiques et economiques d\'Afrique de l\'Ouest' ),
        array( 'text' => 'Engagement de confidentialite absolue sur chaque mandat client' ),
    );
}
$philo_cta = get_field( 'eq_philo_cta' ) ?: 'Rejoindre l\'Équipe →';

// Poles operationnels
$poles = get_field( 'eq_poles' );
if ( ! $poles ) {
    $poles = array(
        array(
            'title' => 'Pole Conseil Strategique & Relations Publiques',
            'desc'  => 'Conseillers seniors en communication institutionnelle, relations publiques et plaidoyer. Accompagnement des decideurs et institutions en Afrique de l\'Ouest.',
            'tags'  => array( array( 'label' => 'Strategie' ), array( 'label' => 'Relations Publiques' ), array( 'label' => 'Plaidoyer' ) ),
        ),
        array(
            'title' => 'Pole Creation de Contenus & Editorial',
            'desc'  => 'Redacteurs, concepteurs et journalistes specialises dans la production de contenus institutionnels : tribunes, discours, rapports, publications.',
            'tags'  => array( array( 'label' => 'Redaction' ), array( 'label' => 'Contenus' ), array( 'label' => 'Editorial' ) ),
        ),
        array(
            'title' => 'Pole Evenementiel & Relations Presse',
            'desc'  => 'Experts en organisation de sommets, conferences institutionnelles et relations presse. Gestion du protocole et de la couverture mediatique en Afrique de l\'Ouest.',
            'tags'  => array( array( 'label' => 'Evenementiel' ), array( 'label' => 'Presse' ), array( 'label' => 'Protocole' ) ),
        ),
        array(
            'title' => 'Pole Digital, Veille & Branding',
            'desc'  => 'Specialistes du digital, de la veille strategique et du branding institutionnel. Monitoring mediatique, identite visuelle et presence en ligne.',
            'tags'  => array( array( 'label' => 'Digital' ), array( 'label' => 'Veille' ), array( 'label' => 'Branding' ) ),
        ),
    );
}

// CTA
$cta_title = get_field( 'eq_cta_title' ) ?: 'Confiez-nous vos enjeux de communication.';
$cta_desc  = get_field( 'eq_cta_desc' ) ?: 'Notre equipe d\'experts en communication institutionnelle est prete a vous accompagner. Contactez RCG West Africa a Abidjan.';
$cta_btn   = get_field( 'eq_cta_btn' ) ?: 'Contactez-nous';
$contact_url = get_permalink( get_page_by_path( 'contact' ) ) ?: '#';
?>

<!-- ============================================
     SECTION 1 : HERO
     ============================================ -->
<header class="relative bg-background-dark text-white overflow-hidden" style="min-height:80vh">
    <div class="absolute inset-0 z-0">
        <img src="<?php echo esc_url( $hero_url ); ?>" alt="<?php esc_attr_e( 'Équipe RCG West Africa', 'rcg' ); ?>" class="w-full h-full object-cover object-top opacity-40" loading="eager" fetchpriority="high" decoding="async">
        <div class="absolute inset-0 bg-gradient-to-r from-background-dark via-background-dark/80 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent"></div>
    </div>

    <div class="absolute top-0 right-0 w-[150px] h-[150px] lg:w-[300px] lg:h-[300px] bg-primary opacity-10 -translate-y-1/2 translate-x-1/2 rotate-45 z-0"></div>

    <div class="relative z-10 container mx-auto px-6 lg:px-12 flex flex-col justify-center h-full pt-20 pb-24" style="min-height:80vh">
        <div class="max-w-3xl">
            <span class="eyebrow mb-6"><?php echo esc_html( $hero_eyebrow ); ?></span>
            <?php if ( $hero_title ) : ?>
                <h1 class="font-black text-3xl md:text-5xl lg:text-[76px] uppercase leading-[1.05] mb-8 tracking-tight">
                    <?php echo wp_kses_post( $hero_title ); ?>
                </h1>
            <?php else : ?>
                <h1 class="font-black text-3xl md:text-5xl lg:text-[76px] uppercase leading-[1.05] mb-8 tracking-tight">
                    Des <span class="text-primary">experts</span><br>
                    au service<br>
                    de votre influence.
                </h1>
            <?php endif; ?>
            <div class="line-accent mb-8"></div>
            <p class="text-white/60 text-lg max-w-xl leading-relaxed font-light">
                <?php echo esc_html( $hero_desc ); ?>
            </p>
        </div>

        <div class="flex flex-wrap gap-6 lg:gap-12 mt-12 lg:mt-16 pt-8 border-t border-white/10">
            <?php foreach ( $hero_stats as $stat ) : ?>
                <div>
                    <div class="font-black text-4xl text-white"><?php echo esc_html( $stat['value'] ); ?><span class="text-primary"><?php echo esc_html( $stat['suffix'] ); ?></span></div>
                    <div class="text-[10px] uppercase tracking-widest text-white/40 mt-1"><?php echo esc_html( $stat['label'] ); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</header>

<!-- ============================================
     SECTION 2 : MANIFESTO QUOTE (bandeau rouge)
     ============================================ -->
<div class="bg-primary py-6 text-white overflow-hidden">
    <div class="container mx-auto px-6 lg:px-12 flex items-center justify-between gap-8">
        <p class="manifesto-quote text-lg text-white/90 max-w-3xl">
            <?php echo esc_html( $manifesto ); ?>
        </p>
        <span class="material-symbols-outlined text-white/40 text-5xl hidden lg:block">manage_accounts</span>
    </div>
</div>

<!-- ============================================
     SECTION 3 : DIRECTION
     ============================================ -->
<?php
// Query direction members (role = direction)
$direction_args = array(
    'post_type'      => 'membre',
    'posts_per_page' => 3,
    'meta_key'       => 'membre_role',
    'meta_value'     => 'direction',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
);
$direction_query = new WP_Query( $direction_args );
$has_direction   = $direction_query->have_posts();
?>

<section class="py-24 bg-white">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="section-sep">
            <span class="eyebrow">— Direction</span>
        </div>

        <?php if ( $has_direction ) : ?>
            <?php while ( $direction_query->have_posts() ) : $direction_query->the_post(); ?>
                <?php
                $poste     = get_field( 'membre_poste' );
                $bio       = get_field( 'membre_bio' );
                $linkedin  = get_field( 'membre_linkedin' );
                $tags      = get_field( 'membre_tags' );
                $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                ?>
                <div class="grid lg:grid-cols-2 gap-0 reveal mb-12 last:mb-0">
                    <div class="relative h-[350px] lg:h-auto overflow-hidden group">
                        <?php if ( $thumb_url ) : ?>
                            <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover object-top transition-all duration-700 group-hover:scale-105" loading="lazy" decoding="async">
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-background-dark/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 h-1 w-full bg-primary"></div>
                    </div>

                    <div class="bg-surface-dark text-white p-6 md:p-10 lg:p-16 flex flex-col justify-center relative">
                        <div class="leader-line"></div>
                        <?php if ( $poste ) : ?>
                            <span class="text-primary font-bold text-[9px] tracking-[3px] uppercase mb-8 block"><?php echo esc_html( $poste ); ?></span>
                        <?php endif; ?>
                        <h2 class="font-black text-4xl lg:text-5xl uppercase leading-[1.1] mb-6 tracking-tight">
                            <?php echo esc_html( get_the_title() ); ?>
                        </h2>
                        <div class="line-accent mb-8"></div>
                        <?php if ( $bio ) : ?>
                            <div class="text-white/65 leading-relaxed mb-10 space-y-4">
                                <?php echo wp_kses_post( $bio ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( $tags ) : ?>
                            <div class="flex flex-wrap gap-3 mb-10">
                                <?php foreach ( $tags as $tag ) : ?>
                                    <span class="tag-pill text-primary border-primary/30"><?php echo esc_html( $tag['label'] ); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="flex items-center gap-6 pt-6 border-t border-white/10">
                            <?php if ( $linkedin ) : ?>
                                <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" class="text-white/40 hover:text-white transition-colors flex items-center gap-2 text-[11px] font-semibold uppercase tracking-widest">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    LinkedIn
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo esc_url( $contact_url ); ?>" class="text-white/40 hover:text-primary transition-colors text-[11px] font-semibold uppercase tracking-widest">
                                Contacter →
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <!-- Fallback statique : Fondateur -->
            <div class="grid lg:grid-cols-2 gap-0 reveal">
                <div class="relative h-[350px] lg:h-auto overflow-hidden group">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/equipe-direction.png" alt="Ibrahim KOUROUMA - Fondateur RCG West Africa" class="w-full h-full object-cover object-top transition-all duration-700 group-hover:scale-105" loading="lazy" decoding="async">
                    <div class="absolute inset-0 bg-gradient-to-t from-background-dark/60 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 h-1 w-full bg-primary"></div>
                </div>

                <div class="bg-surface-dark text-white p-6 md:p-10 lg:p-16 flex flex-col justify-center relative">
                    <div class="leader-line"></div>
                    <span class="text-primary font-bold text-[9px] tracking-[3px] uppercase mb-8 block">Fondateur &amp; Directeur General</span>
                    <h2 class="font-black text-4xl lg:text-5xl uppercase leading-[1.1] mb-6 tracking-tight">
                        Ibrahim<br><span class="text-primary">KOUROUMA</span>
                    </h2>
                    <div class="line-accent mb-8"></div>
                    <p class="text-white/65 leading-relaxed mb-6">
                        Fondateur et Directeur General de RCG West Africa, Ibrahim KOUROUMA a cree l'agence avec une conviction forte : l'Afrique de l'Ouest merite des strateges de haut niveau en communication institutionnelle, politique et sociale.
                    </p>
                    <p class="text-white/65 leading-relaxed mb-10">
                        Sous sa direction, RCG est devenue la premiere agence africaine de communication institutionnelle, accompagnant gouvernements, organisations internationales (CEDEAO, BAD) et entreprises leaders depuis Abidjan, Cocody.
                    </p>
                    <div class="flex flex-wrap gap-3 mb-10">
                        <span class="tag-pill text-primary border-primary/30">Conseil Strategique</span>
                        <span class="tag-pill text-primary border-primary/30">Communication Institutionnelle</span>
                        <span class="tag-pill text-primary border-primary/30">Leadership</span>
                    </div>
                    <div class="flex items-center gap-6 pt-6 border-t border-white/10">
                        <a href="https://www.linkedin.com/company/rcgwestafrica" target="_blank" rel="noopener noreferrer" class="text-white/40 hover:text-white transition-colors flex items-center gap-2 text-[11px] font-semibold uppercase tracking-widest">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            LinkedIn
                        </a>
                        <a href="<?php echo esc_url( $contact_url ); ?>" class="text-white/40 hover:text-primary transition-colors text-[11px] font-semibold uppercase tracking-widest">
                            Contacter →
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ============================================
     SECTION 4 : MEMBRES SENIORS (cartes photo)
     ============================================ -->
<?php
// Query senior members
$seniors_args = array(
    'post_type'      => 'membre',
    'posts_per_page' => 12,
    'meta_key'       => 'membre_role',
    'meta_value'     => 'senior',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
);
$seniors_query = new WP_Query( $seniors_args );
$has_seniors   = $seniors_query->have_posts();

// Fallback static data
$fallback_seniors = array(
    array(
        'name'  => 'Directeur Conseil & Strategie',
        'poste' => 'Pole Conseil Strategique',
        'bio'   => 'Communication institutionnelle, conseil gouvernemental & CEDEAO',
        'tags'  => array( 'Strategie', 'Institutions' ),
        'img'   => 'equipe-strategie.png',
        'delay' => '0s',
    ),
    array(
        'name'  => 'Directeur Relations Publiques & Presse',
        'poste' => 'Pole Relations Publiques',
        'bio'   => 'Relations presse, couverture mediatique & media training',
        'tags'  => array( 'Presse', 'Relations Publiques' ),
        'img'   => 'equipe-relations.png',
        'delay' => '0.1s',
    ),
    array(
        'name'  => 'Directeur Digital & Branding',
        'poste' => 'Pole Digital & Veille',
        'bio'   => 'Branding institutionnel, strategie digitale & veille reputationnelle',
        'tags'  => array( 'Digital', 'Branding' ),
        'img'   => 'equipe-digital.png',
        'delay' => '0.2s',
    ),
);
?>

<section class="py-24 bg-[#f4f4f4]">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="section-sep">
            <span class="eyebrow">— Pôle Stratégie &amp; Conseil</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if ( $has_seniors ) : ?>
                <?php $delay = 0; while ( $seniors_query->have_posts() ) : $seniors_query->the_post(); ?>
                    <?php
                    $poste     = get_field( 'membre_poste' );
                    $bio_court = get_field( 'membre_bio_court' );
                    $tags      = get_field( 'membre_tags' );
                    $linkedin  = get_field( 'membre_linkedin' );
                    $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                    ?>
                    <div class="member-card h-[280px] md:h-[400px] lg:h-[520px] bg-surface-dark cursor-pointer reveal" style="transition-delay:<?php echo esc_attr( $delay * 0.1 ); ?>s">
                        <?php if ( $thumb_url ) : ?>
                            <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover object-top absolute inset-0" loading="lazy" decoding="async">
                        <?php endif; ?>
                        <div class="member-overlay"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-8 z-10">
                            <?php if ( $poste ) : ?>
                                <span class="text-primary font-bold text-[9px] tracking-[2.5px] uppercase mb-3"><?php echo esc_html( $poste ); ?></span>
                            <?php endif; ?>
                            <h3 class="font-black text-2xl text-white uppercase leading-tight mb-1"><?php echo esc_html( get_the_title() ); ?></h3>
                            <?php if ( $bio_court ) : ?>
                                <p class="text-white/50 text-sm mb-4"><?php echo esc_html( $bio_court ); ?></p>
                            <?php endif; ?>
                            <div class="member-social flex gap-3 items-center">
                                <?php if ( $tags ) : ?>
                                    <div class="flex gap-2">
                                        <?php foreach ( $tags as $tag ) : ?>
                                            <span class="tag-pill text-white/60 border-white/20"><?php echo esc_html( $tag['label'] ); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $linkedin ) : ?>
                                    <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" class="ml-auto text-white/40 hover:text-white transition-colors">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php $delay++; endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <!-- Fallback statique -->
                <?php foreach ( $fallback_seniors as $member ) : ?>
                    <div class="member-card h-[280px] md:h-[400px] lg:h-[520px] bg-surface-dark cursor-pointer reveal" style="transition-delay:<?php echo esc_attr( $member['delay'] ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $member['img'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>" class="w-full h-full object-cover object-top absolute inset-0" loading="lazy" decoding="async">
                        <div class="member-overlay"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-8 z-10">
                            <span class="text-primary font-bold text-[9px] tracking-[2.5px] uppercase mb-3"><?php echo esc_html( $member['poste'] ); ?></span>
                            <h3 class="font-black text-2xl text-white uppercase leading-tight mb-1"><?php echo esc_html( $member['name'] ); ?></h3>
                            <p class="text-white/50 text-sm mb-4"><?php echo esc_html( $member['bio'] ); ?></p>
                            <div class="member-social flex gap-3 items-center">
                                <div class="flex gap-2">
                                    <?php foreach ( $member['tags'] as $tag ) : ?>
                                        <span class="tag-pill text-white/60 border-white/20"><?php echo esc_html( $tag ); ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <a href="#" class="ml-auto text-white/40 hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 5 : POLES OPERATIONNELS + PHILO RH
     ============================================ -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="section-sep">
            <span class="eyebrow">— Pôles Opérationnels</span>
        </div>
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-16">

            <!-- Liste des poles -->
            <div class="space-y-0">
                <?php foreach ( $poles as $i => $pole ) :
                    $num     = str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
                    $is_last = ( $i === count( $poles ) - 1 );
                ?>
                    <div class="flex items-start gap-8 py-8 <?php echo ! $is_last ? 'border-b border-gray-100' : ''; ?> group cursor-default hover:pl-4 transition-all duration-300 reveal">
                        <span class="text-primary font-black text-2xl font-display opacity-20 group-hover:opacity-100 transition-opacity w-8 shrink-0"><?php echo esc_html( $num ); ?></span>
                        <div>
                            <h3 class="font-bold text-xl uppercase tracking-tight mb-2 group-hover:text-primary transition-colors">
                                <?php echo esc_html( $pole['title'] ); ?>
                            </h3>
                            <p class="text-gray-500 text-sm leading-relaxed">
                                <?php echo esc_html( $pole['desc'] ); ?>
                            </p>
                            <?php if ( ! empty( $pole['tags'] ) ) : ?>
                                <div class="flex gap-2 mt-4">
                                    <?php foreach ( $pole['tags'] as $tag ) : ?>
                                        <span class="tag-pill text-gray-400 border-gray-200"><?php echo esc_html( $tag['label'] ); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Sidebar : Philosophie RH -->
            <div class="bg-surface-dark text-white p-10 lg:p-12 flex flex-col self-start sticky top-24 reveal">
                <span class="text-primary font-bold text-[9px] tracking-[2.5px] uppercase mb-6 block"><?php echo esc_html( $philo_eyebrow ); ?></span>
                <?php if ( $philo_title ) : ?>
                    <h2 class="font-black text-3xl uppercase leading-tight mb-8 tracking-tight">
                        <?php echo wp_kses_post( $philo_title ); ?>
                    </h2>
                <?php else : ?>
                    <h2 class="font-black text-3xl uppercase leading-tight mb-8 tracking-tight">
                        Exigeants à<br>l'entrée.<br><span class="text-primary">Fidèles</span> à vie.
                    </h2>
                <?php endif; ?>
                <p class="text-white/55 leading-relaxed text-sm mb-10">
                    <?php echo esc_html( $philo_desc ); ?>
                </p>
                <ul class="space-y-4 text-sm mb-10">
                    <?php foreach ( $philo_criteria as $i => $crit ) :
                        $is_last = ( $i === count( $philo_criteria ) - 1 );
                    ?>
                        <li class="flex gap-4 items-start <?php echo ! $is_last ? 'pb-4 border-b border-white/10' : ''; ?>">
                            <span class="material-symbols-outlined text-primary text-xl mt-0.5 shrink-0">check_circle</span>
                            <span class="text-white/70"><?php echo esc_html( $crit['text'] ); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?php echo esc_url( $contact_url ); ?>" class="mt-auto bg-primary text-white text-[11px] font-bold uppercase tracking-widest px-6 py-4 hover:bg-red-700 transition-colors inline-block text-center">
                    <?php echo esc_html( $philo_cta ); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 6 : CTA FINAL
     ============================================ -->
<section class="bg-primary py-16">
    <div class="container mx-auto px-6 lg:px-12 flex flex-col md:flex-row justify-between items-center gap-8">
        <div>
            <h2 class="font-black text-3xl lg:text-4xl uppercase tracking-tight text-white"><?php echo esc_html( $cta_title ); ?></h2>
            <p class="text-white/70 mt-2"><?php echo esc_html( $cta_desc ); ?></p>
        </div>
        <a href="<?php echo esc_url( $contact_url ); ?>" class="bg-white text-primary text-xs font-bold uppercase tracking-widest px-10 py-5 hover:scale-105 transition-transform inline-block whitespace-nowrap">
            <?php echo esc_html( $cta_btn ); ?>
        </a>
    </div>
</section>

<?php get_footer(); ?>
