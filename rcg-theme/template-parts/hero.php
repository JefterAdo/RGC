<?php
/**
 * Template Part : Section Hero (page d'accueil)
 *
 * @package RCG
 */

$label       = rcg_get_field( 'hero_label', false, 'Communication Strategique' );
$title       = rcg_get_field( 'hero_title', false, "L'intelligence au service de votre communication" );
$description = rcg_get_field( 'hero_description', false, "Accompagner les decideurs, les institutions et les organisations dans leurs enjeux de reputation, d'influence et de visibilite en Afrique de l'Ouest." );
$image       = rcg_get_field( 'hero_image' );
$cta1_text   = rcg_get_field( 'hero_cta1_text', false, 'Decouvrir nos expertises' );
$cta1_url    = rcg_get_field( 'hero_cta1_url', false, '#' );
$cta2_text   = rcg_get_field( 'hero_cta2_text', false, 'Voir nos realisations' );
$cta2_url    = rcg_get_field( 'hero_cta2_url', false, '#' );
?>

<section class="relative min-h-[95vh] bg-background-dark flex flex-col justify-center overflow-hidden">
    <div class="container mx-auto px-6 lg:px-12 grid lg:grid-cols-2 gap-12 items-center py-20">

        <!-- Contenu texte -->
        <div class="z-10 flex flex-col items-start space-y-8">
            <div class="flex items-center gap-4">
                <span class="text-primary font-bold text-sm tracking-widest uppercase">&mdash; <?php echo esc_html( $label ); ?></span>
            </div>

            <h1 class="text-white text-5xl lg:text-[76px] font-black leading-[1.05] uppercase">
                <?php echo nl2br( esc_html( $title ) ); ?>
            </h1>

            <p class="text-white/60 text-lg max-w-xl font-light leading-relaxed">
                <?php echo esc_html( $description ); ?>
            </p>

            <div class="flex flex-wrap gap-4 pt-4">
                <?php if ( $cta1_text ) : ?>
                    <a href="<?php echo esc_url( $cta1_url ); ?>" class="bg-primary text-white text-xs font-bold uppercase tracking-widest px-8 py-4 rounded-btn hover:scale-105 transition-transform inline-block">
                        <?php echo esc_html( $cta1_text ); ?>
                    </a>
                <?php endif; ?>
                <?php if ( $cta2_text ) : ?>
                    <a href="<?php echo esc_url( $cta2_url ); ?>" class="border border-white text-white text-xs font-bold uppercase tracking-widest px-8 py-4 rounded-btn hover:bg-white hover:text-background-dark transition-all inline-block">
                        <?php echo esc_html( $cta2_text ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Image Hero -->
        <div class="relative h-[500px] lg:h-[700px] grayscale hover:grayscale-0 transition-all duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent z-10"></div>
            <?php if ( $image ) : ?>
                <img
                    src="<?php echo esc_url( $image['url'] ); ?>"
                    alt="<?php echo esc_attr( $image['alt'] ); ?>"
                    class="w-full h-full object-cover"
                    loading="eager"
                >
            <?php elseif ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'hero-large', array( 'class' => 'w-full h-full object-cover' ) ); ?>
            <?php else : ?>
                <img
                    src="<?php echo esc_url( RCG_URI . '/assets/images/hero-professionnel.png' ); ?>"
                    alt="<?php esc_attr_e( 'RCG Communication', 'rcg' ); ?>"
                    class="w-full h-full object-cover"
                    loading="eager"
                >
            <?php endif; ?>
        </div>
    </div>

    <!-- Compteurs -->
    <div class="absolute bottom-0 w-full bg-surface-dark border-t border-white/5 py-8">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                <?php
                if ( function_exists( 'have_rows' ) && have_rows( 'hero_counters' ) ) :
                    $i = 0;
                    while ( have_rows( 'hero_counters' ) ) :
                        the_row();
                        $border_class = ( $i > 0 ) ? 'border-white/10 md:border-l md:pl-8' : '';
                        ?>
                        <div class="flex flex-col <?php echo esc_attr( $border_class ); ?>">
                            <span class="text-white text-3xl font-bold"><?php echo esc_html( get_sub_field( 'value' ) ); ?></span>
                            <span class="text-white/40 text-[10px] uppercase tracking-widest mt-1"><?php echo esc_html( get_sub_field( 'label' ) ); ?></span>
                        </div>
                        <?php
                        $i++;
                    endwhile;
                else :
                    // Fallback statique
                    $counters = array(
                        array( 'value' => '10+ ans', 'label' => "D'excellence operationnelle" ),
                        array( 'value' => '50+ clients', 'label' => 'Institutions & Entreprises' ),
                        array( 'value' => 'West Africa', 'label' => 'Presence & Portee regionale' ),
                    );
                    foreach ( $counters as $i => $counter ) :
                        $border_class = ( $i > 0 ) ? 'border-white/10 md:border-l md:pl-8' : '';
                        ?>
                        <div class="flex flex-col <?php echo esc_attr( $border_class ); ?>">
                            <span class="text-white text-3xl font-bold"><?php echo esc_html( $counter['value'] ); ?></span>
                            <span class="text-white/40 text-[10px] uppercase tracking-widest mt-1"><?php echo esc_html( $counter['label'] ); ?></span>
                        </div>
                    <?php endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
