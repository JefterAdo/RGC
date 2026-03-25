<?php
/**
 * Template Name: Contact
 * Description: Page de contact RCG - Formulaire, infos, Google Maps
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// === Donnees ACF ===
$hero_eyebrow = get_field( 'ct_hero_eyebrow' ) ?: 'Contactez-nous';
$hero_title   = get_field( 'ct_hero_title' ) ?: 'Parlons de vos enjeux.';
$hero_desc    = get_field( 'ct_hero_desc' ) ?: 'Vous avez un enjeu de communication institutionnelle en Afrique de l\'Ouest ? Décrivez votre projet — notre équipe à Abidjan vous répond sous 24 heures ouvrables.';

$form_title     = get_field( 'ct_form_title' ) ?: 'Décrivez votre besoin en communication';
$form_shortcode = get_field( 'ct_form_shortcode' );

$tel     = get_field( 'ct_tel' ) ?: '+225 25 22 00 46 71';
$email   = get_field( 'ct_email' ) ?: 'info@rcgwestafrica.com';
$promise = get_field( 'ct_promise' ) ?: '"Notre engagement : vous répondre sous 24 heures ouvrables en toute confidentialité." — Ibrahim KOUROUMA, Fondateur & DG';

$bureaux = get_field( 'ct_bureaux' );
if ( ! $bureaux ) {
    $bureaux = array(
        array( 'label' => 'Siège — Abidjan', 'color' => 'primary', 'address' => 'Cocody 8e Tranche<br>Abidjan, Côte d\'Ivoire' ),
        array( 'label' => 'Zone d\'intervention',  'color' => 'blue',    'address' => 'Afrique de l\'Ouest<br>CEDEAO — 15 pays' ),
    );
}

$map_embed = get_field( 'ct_map_embed' );
?>

<!-- ============================================
     SECTION 1 : HERO (compact)
     ============================================ -->
<header class="bg-background-dark text-white h-[38vh] min-h-[300px] flex items-center pt-24 pb-20">
    <div class="container mx-auto px-6 lg:px-12">
        <span class="text-primary font-bold text-[10px] tracking-[3px] uppercase flex items-center gap-3 mb-6">
            <span class="w-8 h-[2px] bg-primary"></span> <?php echo esc_html( $hero_eyebrow ); ?>
        </span>
        <h1 class="font-black text-3xl md:text-5xl lg:text-[64px] uppercase leading-[1.1] mb-6">
            <?php echo esc_html( $hero_title ); ?>
        </h1>
        <p class="text-white/55 text-lg max-w-2xl"><?php echo esc_html( $hero_desc ); ?></p>
    </div>
</header>

<!-- ============================================
     SECTION 2 : FORMULAIRE + SIDEBAR INFO
     ============================================ -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 lg:px-12 grid lg:grid-cols-[58%_42%] gap-8 lg:gap-16">

        <!-- Colonne formulaire -->
        <div>
            <span class="text-primary font-bold text-[10px] tracking-[3px] uppercase flex items-center gap-3 mb-6">
                <span class="w-8 h-[2px] bg-primary"></span> Votre Demande
            </span>
            <h3 class="font-bold text-2xl uppercase text-background-dark mb-8"><?php echo esc_html( $form_title ); ?></h3>

            <?php if ( $form_shortcode ) : ?>
                <!-- Formulaire via plugin (CF7, WPForms, etc.) -->
                <div class="contact-form">
                    <?php echo do_shortcode( $form_shortcode ); ?>
                </div>
            <?php else : ?>
                <!-- Formulaire statique (fallback) -->
                <?php
                // Message de confirmation
                $contact_status = isset( $_GET['contact'] ) ? sanitize_key( wp_unslash( $_GET['contact'] ) ) : '';
                if ( $contact_status ) :
                    if ( 'success' === $contact_status ) : ?>
                        <div class="bg-green-50 border border-green-200 text-green-800 p-4 mb-6 text-sm">
                            <?php esc_html_e( 'Votre message a bien ete envoye. Nous vous recontacterons rapidement.', 'rcg' ); ?>
                        </div>
                    <?php elseif ( 'error' === $contact_status ) : ?>
                        <div class="bg-red-50 border border-red-200 text-red-800 p-4 mb-6 text-sm">
                            <?php esc_html_e( 'Veuillez remplir tous les champs obligatoires.', 'rcg' ); ?>
                        </div>
                    <?php endif;
                endif;
                ?>
                <form class="contact-form space-y-6 text-left" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <?php wp_nonce_field( 'rcg_contact_form', 'rcg_contact_nonce' ); ?>
                    <input type="hidden" name="action" value="rcg_contact_submit">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label><?php esc_html_e( 'Nom & Prénom *', 'rcg' ); ?></label>
                            <input type="text" name="rcg_name" placeholder="Ex: Jean Dupont" required>
                        </div>
                        <div class="flex flex-col">
                            <label><?php esc_html_e( 'Organisation / Institution *', 'rcg' ); ?></label>
                            <input type="text" name="rcg_org" placeholder="Ministère, Institution, Entreprise..." required>
                        </div>
                        <div class="flex flex-col">
                            <label><?php esc_html_e( 'Fonction / Titre *', 'rcg' ); ?></label>
                            <input type="text" name="rcg_function" placeholder="Directeur de la Communication" required>
                        </div>
                        <div class="flex flex-col">
                            <label><?php esc_html_e( 'Email Professionnel *', 'rcg' ); ?></label>
                            <input type="email" name="rcg_email" placeholder="email@organisation.com" required>
                        </div>
                        <div class="flex flex-col">
                            <label><?php esc_html_e( 'Téléphone', 'rcg' ); ?></label>
                            <input type="tel" name="rcg_tel" placeholder="+225 ...">
                        </div>
                        <div class="flex flex-col">
                            <label><?php esc_html_e( 'Pays', 'rcg' ); ?></label>
                            <input type="text" name="rcg_pays" placeholder="Côte d'Ivoire">
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label><?php esc_html_e( 'Type de besoin *', 'rcg' ); ?></label>
                        <select name="rcg_besoin" required>
                            <option value="" selected><?php esc_html_e( 'Sélectionnez une expertise', 'rcg' ); ?></option>
                            <option value="conseil"><?php esc_html_e( 'Conseil Stratégique en Communication', 'rcg' ); ?></option>
                            <option value="rp"><?php esc_html_e( 'Relations Publiques & Institutionnelles', 'rcg' ); ?></option>
                            <option value="presse"><?php esc_html_e( 'Relations Presse & Médias', 'rcg' ); ?></option>
                            <option value="contenus"><?php esc_html_e( 'Création de Contenus & Éditorial', 'rcg' ); ?></option>
                            <option value="crise"><?php esc_html_e( 'Communication de Crise', 'rcg' ); ?></option>
                            <option value="branding"><?php esc_html_e( 'Branding & Événementiel', 'rcg' ); ?></option>
                            <option value="autre"><?php esc_html_e( 'Autre demande', 'rcg' ); ?></option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label><?php esc_html_e( 'Message / Description du projet *', 'rcg' ); ?></label>
                        <textarea name="rcg_message" rows="6" placeholder="Décrivez vos enjeux de communication institutionnelle, vos objectifs et le contexte de votre demande..." required></textarea>
                    </div>

                    <button type="submit" class="w-full h-14 bg-primary text-white font-bold text-xs uppercase tracking-[2px] hover:bg-red-700 transition-colors mt-4">
                        <?php esc_html_e( 'Envoyer la demande →', 'rcg' ); ?>
                    </button>
                    <div class="text-[11px] text-gray-500 text-center mt-3">
                        * <?php esc_html_e( 'Champs obligatoires. Vos données restent strictement confidentielles.', 'rcg' ); ?>
                    </div>
                </form>
            <?php endif; ?>
        </div>

        <!-- Sidebar : infos de contact -->
        <div class="contact-info-card p-6 md:p-10 lg:p-12 text-white h-auto self-start mt-8 lg:mt-0">
            <div class="font-black text-2xl font-display mb-2">RCG West Africa</div>
            <div class="w-full h-[2px] bg-primary mb-10"></div>

            <?php foreach ( $bureaux as $i => $bureau ) :
                $color_class = ( $bureau['color'] === 'blue' ) ? 'text-[#13549e]' : 'text-primary';
                $mb_class    = ( $i < count( $bureaux ) - 1 ) ? 'mb-8' : 'mb-10';
            ?>
                <div class="<?php echo esc_attr( $mb_class ); ?>">
                    <div class="font-semibold text-[10px] uppercase tracking-[2px] <?php echo esc_attr( $color_class ); ?> mb-2">
                        <?php echo esc_html( $bureau['label'] ); ?>
                    </div>
                    <div class="text-sm text-white/65 leading-relaxed">
                        <?php echo wp_kses_post( $bureau['address'] ); ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="mt-10 pt-8 border-t border-white/10">
                <div class="text-[13px] text-white/65 mb-2 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[18px]">call</span>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $tel ) ); ?>" class="hover:text-white transition-colors">
                        <?php echo esc_html( $tel ); ?>
                    </a>
                </div>
                <div class="text-[13px] text-white/65 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[18px]">mail</span>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>" class="hover:text-white transition-colors">
                        <?php echo esc_html( $email ); ?>
                    </a>
                </div>
            </div>

            <div class="w-full h-[1px] bg-white/10 my-8"></div>
            <div class="italic text-white/50 text-sm leading-relaxed">
                <?php echo esc_html( $promise ); ?>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 3 : GOOGLE MAPS
     ============================================ -->
<?php if ( $map_embed ) : ?>
    <section class="h-[320px] w-full">
        <?php echo wp_kses( $map_embed, array(
            'iframe' => array(
                'src'             => true,
                'width'           => true,
                'height'          => true,
                'style'           => true,
                'class'           => true,
                'frameborder'     => true,
                'allowfullscreen' => true,
                'loading'         => true,
                'referrerpolicy'  => true,
            ),
        ) ); ?>
    </section>
<?php else : ?>
    <section class="map-placeholder w-full">
        <div class="font-semibold text-gray-400 uppercase tracking-[2px] text-[13px]">
            [ <?php esc_html_e( 'EMBED GOOGLE MAPS : ABIDJAN, COCODY', 'rcg' ); ?> ]
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
