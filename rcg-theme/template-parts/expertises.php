<?php
/**
 * Template Part : Section Expertises (page d'accueil)
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Query les CPT Expertise
$expertises_query = new WP_Query( array(
    'post_type'      => 'expertise',
    'posts_per_page' => 6,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );
?>

<section class="bg-[#f4f4f4] py-24">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="mb-16">
            <span class="text-primary font-bold text-sm tracking-widest uppercase">&mdash; <?php esc_html_e( 'Expertises', 'rcg' ); ?></span>
            <h2 class="text-background-dark text-4xl font-black uppercase mt-4"><?php esc_html_e( "Nos domaines d'intervention", 'rcg' ); ?></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            if ( $expertises_query->have_posts() ) :
                while ( $expertises_query->have_posts() ) :
                    $expertises_query->the_post();
                    $number = rcg_get_field( 'expertise_number' );
                    $anchor = rcg_get_field( 'expertise_anchor' );
                    $link   = get_permalink();
                    if ( $anchor ) {
                        $expertises_page = get_page_by_path( 'expertises' );
                        if ( $expertises_page ) {
                            $link = get_permalink( $expertises_page ) . '#' . $anchor;
                        }
                    }
                    ?>
                    <a href="<?php echo esc_url( $link ); ?>" class="group bg-white p-6 md:p-8 lg:p-10 flex flex-col space-y-6 transition-all border-b-[3px] border-transparent hover:border-primary">
                        <span class="text-primary font-bold text-lg"><?php echo esc_html( $number ); ?></span>
                        <h3 class="text-2xl font-bold uppercase tracking-tight"><?php echo esc_html( get_the_title() ); ?></h3>
                        <p class="text-gray-500 text-sm leading-relaxed"><?php echo esc_html( get_the_excerpt() ); ?></p>
                    </a>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback statique si aucune expertise n'est publiee
                $static_expertises = array(
                    array( 'num' => '01', 'title' => 'Strategie', 'desc' => "Conseil strategique, audit de positionnement et feuille de route de communication." ),
                    array( 'num' => '02', 'title' => 'Image', 'desc' => "Personal branding de dirigeants et gestion de reputation corporate." ),
                    array( 'num' => '03', 'title' => 'Medias', 'desc' => "Relations presse, media training et strategies de visibilite mediatique." ),
                    array( 'num' => '04', 'title' => 'Editorial', 'desc' => "Conception de contenus premium, rapports annuels et publications institutionnelles." ),
                    array( 'num' => '05', 'title' => 'Crise', 'desc' => "Veille d'opinion, gestion de crise et communication sensible." ),
                    array( 'num' => '06', 'title' => 'Branding', 'desc' => "Identite visuelle, charte graphique et ecosysteme de marque." ),
                );
                foreach ( $static_expertises as $exp ) :
                    ?>
                    <a href="#" class="group bg-white p-6 md:p-8 lg:p-10 flex flex-col space-y-6 transition-all border-b-[3px] border-transparent hover:border-primary">
                        <span class="text-primary font-bold text-lg"><?php echo esc_html( $exp['num'] ); ?></span>
                        <h3 class="text-2xl font-bold uppercase tracking-tight"><?php echo esc_html( $exp['title'] ); ?></h3>
                        <p class="text-gray-500 text-sm leading-relaxed"><?php echo esc_html( $exp['desc'] ); ?></p>
                    </a>
                <?php endforeach;
            endif;
            ?>
        </div>
    </div>
</section>
