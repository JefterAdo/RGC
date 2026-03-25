<?php
/**
 * Template Part : Section Realisations (page d'accueil)
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$realisations_query = new WP_Query( array(
    'post_type'      => 'realisation',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

$reals_page = get_page_by_path( 'realisations' );
$archive_link = $reals_page ? get_permalink( $reals_page ) : home_url( '/realisations/' );
?>

<section class="bg-white py-24">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="flex justify-between items-end mb-16">
            <div>
                <span class="text-primary font-bold text-sm tracking-widest uppercase">&mdash; <?php esc_html_e( 'Realisations', 'rcg' ); ?></span>
                <h2 class="text-background-dark text-4xl font-black uppercase mt-4"><?php esc_html_e( 'Etudes de cas', 'rcg' ); ?></h2>
            </div>
            <a class="text-xs font-bold uppercase tracking-widest border-b border-background-dark pb-1" href="<?php echo esc_url( $archive_link ); ?>">
                <?php esc_html_e( 'Voir tout', 'rcg' ); ?>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            if ( $realisations_query->have_posts() ) :
                while ( $realisations_query->have_posts() ) :
                    $realisations_query->the_post();
                    get_template_part( 'template-parts/card-realisation' );
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback statique
                $static_reals = array(
                    array(
                        'title' => "Repositionnement strategique d'une agence gouvernementale",
                        'cat'   => 'Strategie',
                        'img'   => RCG_URI . '/assets/images/realisation-immeuble.png',
                        'alt'   => 'Immeuble institutionnel moderne',
                    ),
                    array(
                        'title' => "Sommet International sur l'Innovation a Abidjan",
                        'cat'   => 'Evenementiel',
                        'img'   => RCG_URI . '/assets/images/realisation-conference.png',
                        'alt'   => 'Conference de presse internationale',
                    ),
                    array(
                        'title' => 'Programme de leadership pour Dirigeants de PME',
                        'cat'   => 'Image',
                        'img'   => RCG_URI . '/assets/images/realisation-crise.png',
                        'alt'   => 'Gestion de crise digitale',
                    ),
                );
                foreach ( $static_reals as $real ) :
                    ?>
                    <div class="bg-surface-dark group overflow-hidden">
                        <div class="h-48 md:h-64 lg:h-72 overflow-hidden">
                            <img
                                src="<?php echo esc_url( $real['img'] ); ?>"
                                alt="<?php echo esc_attr( $real['alt'] ); ?>"
                                class="w-full h-full object-cover object-center grayscale group-hover:grayscale-0 transition-all duration-500"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                        <div class="p-8 space-y-4">
                            <span class="text-primary text-xs font-bold uppercase tracking-widest"><?php echo esc_html( $real['cat'] ); ?></span>
                            <h3 class="text-white text-xl font-bold leading-snug"><?php echo esc_html( $real['title'] ); ?></h3>
                        </div>
                    </div>
                <?php endforeach;
            endif;
            ?>
        </div>
    </div>
</section>
