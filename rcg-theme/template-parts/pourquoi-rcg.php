<?php
/**
 * Template Part : Section Pourquoi RCG + Bandeau CTA (page d'accueil)
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$label = rcg_get_field( 'why_label', false, 'Pourquoi choisir RCG ?' );
$title = rcg_get_field( 'why_title', false, "L'excellence operationnelle au service des decideurs africains" );

$cta_text       = get_theme_mod( 'rcg_cta_text', 'Travaillons ensemble sur vos enjeux.' );
$cta_button     = get_theme_mod( 'rcg_cta_button_text', 'Demarrer un projet' );
$cta_default    = get_permalink( get_page_by_path( 'contact' ) ) ?: home_url( '/contact/' );
$cta_url        = get_theme_mod( 'rcg_cta_button_url', $cta_default );
?>

<section class="bg-surface-dark py-24 text-white">
    <div class="container mx-auto px-6 lg:px-12 grid lg:grid-cols-2 gap-8 lg:gap-16 items-center">
        <!-- Titre -->
        <div>
            <span class="text-primary font-bold text-sm tracking-widest uppercase">&mdash; <?php echo esc_html( $label ); ?></span>
            <h2 class="text-4xl lg:text-5xl font-black uppercase mt-6 leading-tight">
                <?php echo nl2br( esc_html( $title ) ); ?>
            </h2>
        </div>

        <!-- Valeurs -->
        <div class="space-y-8">
            <?php
            if ( function_exists( 'have_rows' ) && have_rows( 'why_values' ) ) :
                while ( have_rows( 'why_values' ) ) :
                    the_row();
                    ?>
                    <div class="flex items-center justify-between border-b border-white/10 pb-6 group cursor-default">
                        <span class="text-lg font-bold uppercase tracking-widest group-hover:text-primary transition-colors"><?php echo esc_html( get_sub_field( 'name' ) ); ?></span>
                        <span class="material-symbols-outlined text-primary group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform">north_east</span>
                    </div>
                    <?php
                endwhile;
            else :
                // Fallback statique
                $values = array( 'Reactivite & Disponibilite', 'Intelligence Strategique', 'Ancrage Terrain en Afrique de l\'Ouest', 'Excellence d\'Execution' );
                foreach ( $values as $value ) :
                    ?>
                    <div class="flex items-center justify-between border-b border-white/10 pb-6 group cursor-default">
                        <span class="text-lg font-bold uppercase tracking-widest group-hover:text-primary transition-colors"><?php echo esc_html( $value ); ?></span>
                        <span class="material-symbols-outlined text-primary group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform">north_east</span>
                    </div>
                <?php endforeach;
            endif;
            ?>
        </div>
    </div>

    <!-- Bandeau CTA -->
    <div class="mt-24 bg-primary py-12">
        <div class="container mx-auto px-6 lg:px-12 flex flex-col md:flex-row justify-between items-center gap-8">
            <h3 class="text-xl md:text-3xl font-black uppercase tracking-tight text-center md:text-left"><?php echo esc_html( $cta_text ); ?></h3>
            <a href="<?php echo esc_url( $cta_url ); ?>" class="bg-white text-primary text-xs font-bold uppercase tracking-widest px-10 py-5 rounded-btn hover:scale-105 transition-transform inline-block">
                <?php echo esc_html( $cta_button ); ?>
            </a>
        </div>
    </div>
</section>
