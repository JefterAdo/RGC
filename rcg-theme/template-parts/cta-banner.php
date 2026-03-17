<?php
/**
 * Template Part : Bandeau CTA rouge reutilisable
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$contact_url = get_permalink( get_page_by_path( 'contact' ) ) ?: '#';
?>

<section class="bg-primary py-16">
    <div class="container mx-auto px-6 lg:px-12 flex flex-col md:flex-row justify-between items-center gap-8">
        <div>
            <h2 class="font-black text-3xl lg:text-4xl uppercase tracking-tight text-white">
                <?php esc_html_e( 'Travaillons ensemble.', 'rcg' ); ?>
            </h2>
            <p class="text-white/70 mt-2">
                <?php esc_html_e( 'Notre équipe est prête à relever vos défis les plus complexes.', 'rcg' ); ?>
            </p>
        </div>
        <a href="<?php echo esc_url( $contact_url ); ?>" class="bg-white text-primary text-xs font-bold uppercase tracking-widest px-10 py-5 hover:scale-105 transition-transform inline-block whitespace-nowrap">
            <?php esc_html_e( 'Démarrer un projet', 'rcg' ); ?>
        </a>
    </div>
</section>
