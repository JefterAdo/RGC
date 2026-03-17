<?php
/**
 * Template Name: A Propos
 * Description: Page A Propos RCG - Histoire, ADN, Valeurs, Presence, Equipe
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// === Donnees ACF (avec fallbacks) ===
$eyebrow    = get_field( 'ap_eyebrow' ) ?: 'Notre Philosophie';
$hero_title = get_field( 'ap_title' ) ?: 'Nous donnons toujours plus que promis.';
$hero_desc  = get_field( 'ap_desc' ) ?: 'Chez RCG, nous ne nous contentons pas de répondre aux attentes — nous les surpassons. Fondée sur l\'excellence et la rigueur, notre agence est l\'architecte invisible des grandes ambitions institutionnelles en Afrique de l\'Ouest.';
$hero_img   = get_field( 'ap_hero_image' );
$hero_url   = $hero_img ? $hero_img['url'] : get_template_directory_uri() . '/assets/images/apropos-hero.png';

// Stats
$stats = get_field( 'ap_stats' );
if ( ! $stats ) {
    $stats = array(
        array( 'value' => '2006', 'label' => 'Année de fondation', 'highlight' => true ),
        array( 'value' => '15',   'label' => 'Pays d\'intervention', 'highlight' => false ),
        array( 'value' => '120+', 'label' => 'Missions accomplies', 'highlight' => false ),
        array( 'value' => '50+',  'label' => 'Dirigeants accompagnés', 'highlight' => false ),
    );
}

// Histoire
$hist_title = get_field( 'ap_hist_title' ) ?: 'Une agence née de l\'exigence';
$hist_text  = get_field( 'ap_hist_text' );
$hist_image = get_field( 'ap_hist_image' );
$hist_img_url = $hist_image ? $hist_image['url'] : get_template_directory_uri() . '/assets/images/apropos-direction.png';
$hist_quote = get_field( 'ap_hist_quote' ) ?: 'Notre mission n\'est pas d\'être visibles. Notre mission est de vous rendre inoubliables.';

// Timeline
$timeline = get_field( 'ap_timeline' );
if ( ! $timeline ) {
    $timeline = array(
        array( 'abbr' => '06', 'year' => '2006', 'title' => 'Fondation à Abidjan',              'description' => 'Création de l\'agence avec la conviction que l\'Afrique de l\'Ouest méritait des stratèges de haut niveau.', 'is_current' => false ),
        array( 'abbr' => '18', 'year' => '2018', 'title' => 'Premiers Mandats Gouvernementaux',  'description' => 'Confiance accordée par les premières institutions publiques d\'envergure — un tournant décisif.', 'is_current' => false ),
        array( 'abbr' => '21', 'year' => '2021', 'title' => 'Expansion Panafricaine',            'description' => 'Extension des opérations à 15 pays — du Sénégal au Nigeria, du Bénin au Cameroun.', 'is_current' => false ),
        array( 'abbr' => '25', 'year' => '2025', 'title' => 'Bureau de Liaison Paris',           'description' => 'Ouverture du bureau parisien pour renforcer la présence diplomatique et institutionnelle en Europe.', 'is_current' => true ),
    );
}

// ADN / Piliers
$adn_quote = get_field( 'ap_adn_quote' ) ?: 'L\'excellence n\'est pas un objectif. C\'est notre point de départ.';
$piliers   = get_field( 'ap_piliers' );
if ( ! $piliers ) {
    $piliers = array(
        array( 'letter' => 'R', 'title' => 'Réactivité',       'description' => 'Capacité à déployer une force de frappe stratégique et opérationnelle sous 24h, quelle que soit la complexité de la situation.' ),
        array( 'letter' => 'R', 'title' => 'Rigueur',          'description' => 'Exécution des mandats avec une précision d\'orfèvre — sans jamais sacrifier la justesse de l\'analyse à la vitesse d\'intervention.' ),
        array( 'letter' => 'S', 'title' => 'Surentraînement',  'description' => 'Une équipe dont la formation continue permet de dominer les crises les plus complexes avec sérénité et maîtrise.' ),
        array( 'letter' => 'D', 'title' => 'Discrétion',       'description' => 'Confidentialité absolue : nous sommes les architectes invisibles de votre influence. Votre succès est notre seule signature.' ),
        array( 'letter' => 'P', 'title' => 'Précision',        'description' => 'Livrables sans faille. Chaque mot, chaque virgule, chaque action est calculée pour produire un impact maximal et mesurable.' ),
    );
}

// Valeurs
$valeurs_image = get_field( 'ap_valeurs_image' );
$valeurs_img_url = $valeurs_image ? $valeurs_image['url'] : get_template_directory_uri() . '/assets/images/apropos-valeurs.png';
$valeurs = get_field( 'ap_valeurs' );
if ( ! $valeurs ) {
    $valeurs = array(
        array( 'icon' => 'verified',    'title' => 'Excellence sans compromis',          'description' => 'Chaque livrable est traité avec le niveau d\'exigence d\'une opération critique, qu\'il s\'agisse d\'un discours ou d\'un plan global.' ),
        array( 'icon' => 'handshake',   'title' => 'Partenariat sur le long terme',      'description' => 'Nous refusons la logique de prestataire. Nous nous positionnons comme des partenaires stratégiques investis dans votre réussite durable.' ),
        array( 'icon' => 'diversity_3', 'title' => 'Ancrage africain, vision mondiale',  'description' => 'Nous maîtrisons les codes culturels locaux tout en appliquant les meilleures pratiques internationales — un équilibre rare et décisif.' ),
        array( 'icon' => 'lock',        'title' => 'Confidentialité absolue',            'description' => 'La confiance est la pierre angulaire de notre relation. Chaque engagement est protégé par un cadre strict de discrétion professionnelle.' ),
        array( 'icon' => 'trending_up', 'title' => 'Impact mesurable',                  'description' => 'Nous définissons des KPIs clairs avant chaque mission et livrons des rapports de performance rigoureux. L\'impact se prouve, il ne se déclare pas.' ),
    );
}

// Presence - Bureaux
$bureaux = get_field( 'ap_bureaux' );
if ( ! $bureaux ) {
    $bureaux = array(
        array( 'city' => 'Abidjan, Côte d\'Ivoire', 'subtitle' => 'Siège Social · Bureau Principal', 'address' => 'Cité des Cadres, Cocody Ambassades — BP 452 Abidjan 01', 'description' => 'Centre de commandement opérationnel et stratégique pour toute l\'Afrique de l\'Ouest.', 'tags' => 'Hub Stratégique, Cellule de Crise', 'dot_color' => 'red' ),
        array( 'city' => 'Paris, France', 'subtitle' => 'Bureau de Liaison · Europe', 'address' => '8 Rue de la Paix, 75002 Paris', 'description' => 'Interface diplomatique et institutionnelle pour les relations franco-africaines et les organisations internationales.', 'tags' => 'Diplomatie, Relations Intl.', 'dot_color' => 'green' ),
    );
}

// Presence - Pays
$pays = get_field( 'ap_pays' );
if ( ! $pays ) {
    $pays = array(
        array( 'name' => 'Côte d\'Ivoire', 'is_special' => false ),
        array( 'name' => 'Sénégal',        'is_special' => false ),
        array( 'name' => 'Mali',            'is_special' => false ),
        array( 'name' => 'Burkina Faso',    'is_special' => false ),
        array( 'name' => 'Ghana',           'is_special' => false ),
        array( 'name' => 'Nigeria',         'is_special' => false ),
        array( 'name' => 'Bénin',           'is_special' => false ),
        array( 'name' => 'Togo',            'is_special' => false ),
        array( 'name' => 'Cameroun',        'is_special' => false ),
        array( 'name' => 'Guinée',          'is_special' => false ),
        array( 'name' => 'Niger',           'is_special' => false ),
        array( 'name' => 'Gabon',           'is_special' => false ),
        array( 'name' => 'Congo',           'is_special' => false ),
        array( 'name' => 'Maroc',           'is_special' => false ),
        array( 'name' => '+ Europe',        'is_special' => true ),
    );
}

// Equipe stats
$eq_stats = get_field( 'ap_equipe_stats' );
if ( ! $eq_stats ) {
    $eq_stats = array(
        array( 'value' => '25+',  'label' => 'Collaborateurs',     'color' => 'primary' ),
        array( 'value' => '12',   'label' => 'Nationalités',       'color' => 'dark' ),
        array( 'value' => '8',    'label' => 'Langues maîtrisées', 'color' => 'dark' ),
        array( 'value' => '100%', 'label' => 'Engagement client',  'color' => 'green' ),
    );
}

// Equipe poles
$poles = get_field( 'ap_equipe_poles' );
if ( ! $poles ) {
    $poles = array(
        array( 'image' => null, 'line1' => 'Direction', 'line2' => 'Générale',  'fallback_img' => 'apropos-equipe-direction.png' ),
        array( 'image' => null, 'line1' => 'Pôle',      'line2' => 'Stratégie', 'fallback_img' => 'apropos-equipe-strategie.png' ),
        array( 'image' => null, 'line1' => 'Pôle',      'line2' => 'Relations', 'fallback_img' => 'apropos-equipe-relations.png' ),
        array( 'image' => null, 'line1' => 'Pôle',      'line2' => 'Digital',   'fallback_img' => 'apropos-equipe-digital.png' ),
    );
}

// CTA
$cta_title = get_field( 'ap_cta_title' ) ?: 'Rejoignez nos clients d\'exception.';
$cta_desc  = get_field( 'ap_cta_desc' ) ?: 'Notre équipe analyse votre contexte et vous propose une approche entièrement sur mesure.';
$cta_btn   = get_field( 'ap_cta_btn' ) ?: 'Démarrer votre projet';

$contact_page = get_page_by_path( 'contact' );
$contact_url  = $contact_page ? get_permalink( $contact_page ) : '#';
$equipe_page  = get_page_by_path( 'equipe' );
$equipe_url   = $equipe_page ? get_permalink( $equipe_page ) : '#';

// Color map for equipe stats
$eq_color_map = array(
    'primary' => array( 'text' => 'text-primary', 'border' => 'border-primary' ),
    'dark'    => array( 'text' => 'text-background-dark', 'border' => 'border-background-dark' ),
    'green'   => array( 'text' => 'text-accent-green', 'border' => 'border-accent-green' ),
);

// Anchor nav
$anchors = array(
    array( 'id' => 'histoire', 'label' => '01 Histoire' ),
    array( 'id' => 'adn',      'label' => '02 Notre ADN' ),
    array( 'id' => 'valeurs',  'label' => '03 Valeurs' ),
    array( 'id' => 'presence', 'label' => '04 Présence' ),
    array( 'id' => 'equipe',   'label' => '05 Équipe' ),
);
?>

<!-- ============================================
     SECTION 1 : HERO HEADER
     ============================================ -->
<header class="relative bg-background-dark text-white overflow-hidden" style="min-height:75vh">
    <!-- Image de fond -->
    <img src="<?php echo esc_url( $hero_url ); ?>" alt="<?php echo esc_attr( $hero_title ); ?>" class="hero-img absolute inset-0 w-full h-full object-cover opacity-35 object-top">

    <!-- Gradient overlays -->
    <div class="absolute inset-0 bg-gradient-to-r from-background-dark via-background-dark/80 to-background-dark/20"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent"></div>

    <!-- Triangle decoratif -->
    <div class="absolute top-0 right-0 w-0 h-0 border-t-[300px] border-r-[300px] border-t-primary/20 border-r-transparent"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 flex items-end" style="min-height:75vh">
        <div class="max-w-3xl pb-0 pt-20">

            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-[9px] uppercase tracking-widest mb-8">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-primary/60 hover:text-primary transition-colors"><?php esc_html_e( 'Accueil', 'rcg' ); ?></a>
                <span class="text-white/40">/</span>
                <span class="text-white/60"><?php esc_html_e( 'À Propos', 'rcg' ); ?></span>
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
            <div class="line-accent mt-6 mb-8"></div>

            <!-- Description -->
            <p class="text-white/60 text-lg max-w-xl leading-relaxed font-light"><?php echo esc_html( $hero_desc ); ?></p>

            <!-- Navigation ancres -->
            <div class="border-t border-white/10 mt-12 pt-8 pb-12 flex flex-wrap gap-3">
                <?php foreach ( $anchors as $anchor ) : ?>
                    <a href="#<?php echo esc_attr( $anchor['id'] ); ?>" class="tag-pill text-white/50 border-white/20 hover:text-primary hover:border-primary transition-colors">
                        <?php echo esc_html( $anchor['label'] ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</header>

<!-- ============================================
     SECTION 2 : BARRE DE STATS
     ============================================ -->
<section class="py-16 bg-white border-b border-gray-100 reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-0">
            <?php foreach ( $stats as $i => $stat ) :
                $is_hl      = ! empty( $stat['highlight'] );
                $val_class  = $is_hl ? 'text-primary' : 'text-background-dark';
                $border     = $i > 0 ? ' border-l border-gray-100' : '';
            ?>
                <div class="stat-left<?php echo esc_attr( $border ); ?>">
                    <div class="font-black text-5xl leading-none <?php echo esc_attr( $val_class ); ?>"><?php echo esc_html( $stat['value'] ); ?></div>
                    <div class="text-[9px] uppercase tracking-widest text-gray-400 mt-3"><?php echo esc_html( $stat['label'] ); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 3 : #histoire — Qui Sommes-Nous
     ============================================ -->
<section id="histoire" class="py-24 bg-white scroll-mt-24 reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid lg:grid-cols-2 gap-0">

            <!-- Colonne gauche : texte + timeline -->
            <div class="flex flex-col justify-center lg:pr-16 py-8">
                <div class="font-black text-[80px] text-background-dark/[0.04] leading-none select-none">01</div>
                <span class="eyebrow mb-4"><?php esc_html_e( 'Qui Sommes-Nous', 'rcg' ); ?></span>
                <h2 class="font-black text-4xl lg:text-5xl uppercase leading-tight tracking-tight text-background-dark"><?php echo esc_html( $hist_title ); ?></h2>
                <div class="line-accent mt-4 mb-6"></div>

                <?php if ( $hist_text ) : ?>
                    <div class="text-gray-500 text-sm leading-relaxed space-y-4"><?php echo wp_kses_post( $hist_text ); ?></div>
                <?php else : ?>
                    <p class="text-gray-500 text-sm leading-relaxed">RCG est avant tout une réponse au besoin croissant des décideurs africains de s'entourer de stratèges capables d'allier les standards internationaux au pragmatisme du terrain.</p>
                    <p class="text-gray-500 text-sm leading-relaxed mt-4">Notre équipe pluridisciplinaire agit dans l'ombre pour garantir que votre image, vos messages et vos objectifs soient protégés et propulsés avec la plus grande efficacité imaginable. Nous ne sommes pas une agence de communication ordinaire — nous sommes vos architectes de l'influence.</p>
                <?php endif; ?>

                <!-- Timeline -->
                <div class="mt-10 space-y-0">
                    <?php foreach ( $timeline as $entry ) :
                        $is_current = ! empty( $entry['is_current'] );
                        $circle     = $is_current
                            ? 'w-10 h-10 rounded-full bg-primary flex items-center justify-center shrink-0 relative z-10'
                            : 'w-10 h-10 rounded-full border-2 border-primary flex items-center justify-center shrink-0 relative z-10';
                        $abbr_class = $is_current ? 'text-white text-xs font-black' : 'text-primary text-xs font-black';
                        $year_class = $is_current ? 'text-primary' : '';
                    ?>
                        <div class="timeline-node pb-8">
                            <div class="flex items-start gap-4">
                                <div class="<?php echo esc_attr( $circle ); ?>">
                                    <span class="<?php echo esc_attr( $abbr_class ); ?>"><?php echo esc_html( $entry['abbr'] ); ?></span>
                                </div>
                                <div class="pt-1">
                                    <h3 class="font-bold text-sm uppercase tracking-wider <?php echo esc_attr( $year_class ); ?>">
                                        <?php echo esc_html( $entry['year'] . ' — ' . $entry['title'] ); ?>
                                    </h3>
                                    <p class="text-gray-400 text-xs mt-1 leading-relaxed"><?php echo esc_html( $entry['description'] ); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Colonne droite : image + citation -->
            <div class="relative h-[600px] lg:h-auto group overflow-hidden">
                <img src="<?php echo esc_url( $hist_img_url ); ?>" alt="Direction RCG" class="absolute inset-0 w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-[1.03]">
                <div class="absolute inset-0 bg-gradient-to-t from-background-dark/90 via-background-dark/30 to-transparent"></div>

                <!-- Citation overlay -->
                <div class="absolute bottom-0 left-0 right-0 p-8 lg:p-12">
                    <blockquote class="quote-bar font-lora italic text-white/80 text-lg leading-relaxed">
                        "<?php echo esc_html( $hist_quote ); ?>"
                    </blockquote>
                    <span class="text-[9px] uppercase tracking-widest text-white/40 mt-4 block"><?php esc_html_e( 'Direction Générale · RCG West Africa', 'rcg' ); ?></span>
                </div>

                <!-- Accent rouge en bas -->
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-primary"></div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 4 : #adn — Les 5 Piliers
     ============================================ -->
<section id="adn" class="py-24 bg-surface-dark text-white scroll-mt-24 reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <!-- En-tete -->
        <div class="grid lg:grid-cols-3 gap-12 mb-16">
            <div class="lg:col-span-2">
                <div class="font-black text-[80px] text-white/[0.04] leading-none select-none">02</div>
                <span class="eyebrow mb-4"><?php esc_html_e( 'Notre ADN', 'rcg' ); ?></span>
                <h2 class="font-black text-3xl lg:text-5xl uppercase leading-tight tracking-tight mt-2">Les 5 piliers<br>de l'excellence</h2>
                <div class="line-accent mt-4 mb-6"></div>
                <p class="text-white/60 text-sm leading-relaxed max-w-xl">Ce que nous appelons en interne le "Code Ninja" — la méthodologie absolue qui guide chacune de nos opérations de communication à travers l'Afrique et au-delà.</p>
            </div>

            <!-- Encart citation rouge -->
            <div class="bg-primary text-white p-8 flex flex-col justify-center">
                <p class="font-lora italic text-sm text-white/90 leading-relaxed">"<?php echo esc_html( $adn_quote ); ?>"</p>
                <div class="mt-6 pt-4 border-t border-white/20">
                    <span class="text-3xl font-black">18</span>
                    <span class="text-[10px] uppercase tracking-widest text-white/60 ml-2">Années d'expertise</span>
                </div>
            </div>
        </div>

        <!-- Grille 5 piliers -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <?php foreach ( $piliers as $pilier ) : ?>
                <div class="pillar-card bg-surface-mid p-8 cursor-default">
                    <div class="pillar-letter font-black text-7xl text-primary/10 absolute top-4 right-4"><?php echo esc_html( $pilier['letter'] ); ?></div>
                    <h3 class="font-bold text-sm uppercase tracking-wider mt-2 transition-colors"><?php echo esc_html( $pilier['title'] ); ?></h3>
                    <p class="text-white/50 text-xs leading-relaxed mt-3"><?php echo esc_html( $pilier['description'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 5 : #valeurs — Ce Qui Nous Definit
     ============================================ -->
<section id="valeurs" class="py-24 bg-white scroll-mt-24 reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <!-- Image gauche -->
            <div class="relative h-[500px] group overflow-hidden">
                <img src="<?php echo esc_url( $valeurs_img_url ); ?>" alt="Valeurs RCG" class="absolute inset-0 w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-[1.04] transition-all duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-background-dark/70 to-transparent"></div>
                <div class="absolute top-4 left-4">
                    <span class="tag-pill text-primary border-primary/40 bg-white/90 backdrop-blur-sm">Nos Valeurs</span>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-primary"></div>
            </div>

            <!-- Texte droite -->
            <div>
                <div class="font-black text-[80px] text-background-dark/[0.04] leading-none select-none">03</div>
                <span class="eyebrow mb-4"><?php esc_html_e( 'Ce Qui Nous Définit', 'rcg' ); ?></span>
                <h2 class="font-black text-3xl lg:text-4xl uppercase leading-tight tracking-tight mt-2"><?php esc_html_e( 'Valeurs & Engagements', 'rcg' ); ?></h2>
                <div class="line-accent mt-4 mb-6"></div>
                <p class="text-gray-500 text-sm leading-relaxed mb-8">Nos valeurs ne sont pas des slogans accrochés au mur. Ce sont des engagements concrets que nous prenons vis-à-vis de chaque client, chaque jour, sur chaque mission.</p>

                <!-- Liste de valeurs -->
                <div class="space-y-0">
                    <?php foreach ( $valeurs as $i => $valeur ) :
                        $is_last    = ( $i === count( $valeurs ) - 1 );
                        $row_border = $is_last ? '' : ' border-b border-gray-100';
                    ?>
                        <div class="value-row flex items-start gap-4 py-5<?php echo esc_attr( $row_border ); ?>">
                            <span class="material-symbols-outlined text-primary text-xl shrink-0 mt-0.5"><?php echo esc_html( $valeur['icon'] ); ?></span>
                            <div>
                                <h3 class="font-bold text-sm uppercase tracking-wider text-background-dark"><?php echo esc_html( $valeur['title'] ); ?></h3>
                                <p class="text-gray-500 text-xs leading-relaxed mt-1"><?php echo esc_html( $valeur['description'] ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 6 : #presence — Présence Régionale
     ============================================ -->
<section id="presence" class="py-24 bg-background-dark text-white relative overflow-hidden scroll-mt-24 reveal">
    <!-- Grand "15" decoratif -->
    <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none select-none">
        <span class="font-black text-[400px] leading-none text-white tracking-tighter">15</span>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12">
        <div class="font-black text-[80px] text-white/[0.04] leading-none select-none">04</div>
        <span class="eyebrow mb-4"><?php esc_html_e( 'Présence Régionale', 'rcg' ); ?></span>
        <h2 class="font-black text-3xl lg:text-5xl uppercase leading-tight tracking-tight mt-2">Ancrés en Afrique,<br>connectés au monde</h2>
        <div class="line-accent mt-4 mb-6"></div>
        <p class="text-white/60 text-sm leading-relaxed max-w-2xl mb-16">Deux bureaux permanents. Un réseau de correspondants dans 15 pays. Une capacité d'intervention panafricaine mobilisable en moins de 48 heures.</p>

        <div class="grid lg:grid-cols-2 gap-16 items-start">
            <!-- Bureaux -->
            <div class="space-y-6">
                <?php foreach ( $bureaux as $i => $bureau ) :
                    $dot_bg    = 'red' === $bureau['dot_color'] ? 'bg-primary' : 'bg-accent-green';
                    $dot_delay = $i > 0 ? ' style="animation-delay:1s"' : '';
                    $tags_arr  = array_map( 'trim', explode( ',', $bureau['tags'] ) );
                ?>
                    <div class="border border-white/10 p-8 hover:border-primary transition-colors">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="relative w-3 h-3">
                                <div class="w-3 h-3 rounded-full <?php echo esc_attr( $dot_bg ); ?>"></div>
                                <div class="dot-ping <?php echo esc_attr( $dot_bg ); ?>"<?php if ( $i > 0 ) : ?> style="animation-delay:1s"<?php endif; ?>></div>
                            </div>
                            <h3 class="font-bold text-lg uppercase tracking-tight"><?php echo esc_html( $bureau['city'] ); ?></h3>
                        </div>
                        <span class="text-[9px] uppercase tracking-widest text-white/40 block mb-3"><?php echo esc_html( $bureau['subtitle'] ); ?></span>
                        <p class="text-white/60 text-xs mb-2"><?php echo esc_html( $bureau['address'] ); ?></p>
                        <p class="text-white/50 text-xs leading-relaxed mb-4"><?php echo esc_html( $bureau['description'] ); ?></p>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ( $tags_arr as $tag ) : ?>
                                <span class="tag-pill text-primary/60 border-primary/20 text-[8px]"><?php echo esc_html( $tag ); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pays -->
            <div>
                <h3 class="text-[10px] font-bold uppercase tracking-widest text-white/40 mb-6"><?php esc_html_e( 'Réseau d\'intervention actif', 'rcg' ); ?></h3>
                <div class="grid grid-cols-3 gap-3">
                    <?php foreach ( $pays as $p ) :
                        $is_special = ! empty( $p['is_special'] );
                        if ( $is_special ) :
                    ?>
                        <div class="bg-primary/20 border border-primary/40 p-4 text-center">
                            <span class="text-primary font-bold text-xs"><?php echo esc_html( $p['name'] ); ?></span>
                        </div>
                    <?php else : ?>
                        <div class="bg-white/5 p-4 text-center hover:bg-primary/20 hover:text-primary transition-colors cursor-default">
                            <span class="text-white/60 text-xs font-medium"><?php echo esc_html( $p['name'] ); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 7 : #equipe — Les Hommes & Femmes RCG
     ============================================ -->
<section id="equipe" class="py-24 bg-[#f4f4f4] scroll-mt-24 reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <!-- En-tete -->
        <div class="grid lg:grid-cols-3 gap-12 mb-16">
            <div class="lg:col-span-2">
                <div class="font-black text-[80px] text-background-dark/[0.04] leading-none select-none">05</div>
                <span class="eyebrow mb-4"><?php esc_html_e( 'Les Hommes & Femmes RCG', 'rcg' ); ?></span>
                <h2 class="font-black text-3xl lg:text-4xl uppercase leading-tight tracking-tight mt-2">Une équipe d'élite<br>à votre service</h2>
                <div class="line-accent mt-4 mb-6"></div>
                <p class="text-gray-500 text-sm leading-relaxed max-w-xl">Des stratèges, des journalistes, des experts en relations publiques et des conseillers politiques — une équipe pluridisciplinaire soudée par une ambition commune : l'excellence de la communication institutionnelle africaine.</p>
            </div>

            <!-- Stats equipe -->
            <div class="grid grid-cols-2 gap-4">
                <?php foreach ( $eq_stats as $stat ) :
                    $colors = isset( $eq_color_map[ $stat['color'] ] ) ? $eq_color_map[ $stat['color'] ] : $eq_color_map['dark'];
                ?>
                    <div class="bg-white p-6 border-t-2 <?php echo esc_attr( $colors['border'] ); ?>">
                        <div class="font-black text-3xl <?php echo esc_attr( $colors['text'] ); ?>"><?php echo esc_html( $stat['value'] ); ?></div>
                        <div class="text-[9px] uppercase tracking-widest text-gray-400 mt-2"><?php echo esc_html( $stat['label'] ); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Grille photos poles -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
            <?php foreach ( $poles as $pole ) :
                $pole_img = null;
                if ( ! empty( $pole['image'] ) && is_array( $pole['image'] ) ) {
                    $pole_img = $pole['image']['url'];
                } elseif ( ! empty( $pole['fallback_img'] ) ) {
                    $pole_img = get_template_directory_uri() . '/assets/images/' . $pole['fallback_img'];
                }
            ?>
                <div class="group relative overflow-hidden">
                    <?php if ( $pole_img ) : ?>
                        <img src="<?php echo esc_url( $pole_img ); ?>" alt="<?php echo esc_attr( $pole['line1'] . ' ' . $pole['line2'] ); ?>" class="w-full h-64 object-cover object-top grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500">
                    <?php else : ?>
                        <div class="w-full h-64 bg-gray-300"></div>
                    <?php endif; ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-background-dark/80 to-transparent"></div>
                    <div class="absolute bottom-4 left-4">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-white/60 block"><?php echo esc_html( $pole['line1'] ); ?></span>
                        <span class="text-sm font-black uppercase tracking-tight text-white"><?php echo esc_html( $pole['line2'] ); ?></span>
                        <div class="h-0.5 bg-primary mt-2 origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- CTA Equipe -->
        <div class="text-center">
            <a href="<?php echo esc_url( $equipe_url ); ?>" class="inline-flex items-center gap-2 bg-background-dark text-white text-[11px] font-bold uppercase tracking-widest px-8 py-4 rounded-btn hover:bg-primary transition-colors">
                <?php esc_html_e( 'Découvrir toute l\'équipe', 'rcg' ); ?> <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 8 : CTA FINAL
     ============================================ -->
<section class="bg-primary py-20 reveal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col md:flex-row justify-between items-center gap-8">
        <div>
            <h2 class="font-black text-3xl lg:text-4xl uppercase tracking-tight text-white"><?php echo esc_html( $cta_title ); ?></h2>
            <p class="text-white/70 mt-2 text-lg"><?php echo esc_html( $cta_desc ); ?></p>
        </div>
        <a href="<?php echo esc_url( $contact_url ); ?>" class="shrink-0 bg-white text-primary font-bold text-xs uppercase tracking-widest px-10 py-5 rounded-btn hover:scale-105 transition-transform">
            <?php echo esc_html( $cta_btn ); ?>
        </a>
    </div>
</section>

<?php get_footer(); ?>
