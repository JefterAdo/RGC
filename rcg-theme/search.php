<?php
/**
 * Template : Resultats de recherche
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="bg-background-dark py-24 text-white">
    <div class="container mx-auto px-6 lg:px-12">
        <span class="text-primary font-bold text-sm tracking-widest uppercase">&mdash; <?php esc_html_e( 'Recherche', 'rcg' ); ?></span>
        <h1 class="text-4xl lg:text-5xl font-black uppercase mt-6">
            <?php
            printf(
                /* translators: %s: search query */
                esc_html__( 'Resultats pour "%s"', 'rcg' ),
                esc_html( get_search_query() )
            );
            ?>
        </h1>
    </div>
</section>

<section class="bg-[#f4f4f4] py-24">
    <div class="container mx-auto px-6 lg:px-12">
        <?php if ( have_posts() ) : ?>
            <div class="space-y-6">
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="bg-white p-8 flex flex-col lg:flex-row gap-6 group hover:shadow-lg transition-shadow block">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="w-full lg:w-48 h-32 overflow-hidden flex-shrink-0">
                                <?php the_post_thumbnail( 'card-small', array(
                                    'class' => 'w-full h-full object-cover',
                                ) ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="flex-1">
                            <span class="text-[10px] uppercase tracking-widest text-gray-400"><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?></span>
                            <h3 class="text-xl font-bold mt-1 group-hover:text-primary transition-colors"><?php echo esc_html( get_the_title() ); ?></h3>
                            <p class="text-gray-500 text-sm leading-relaxed mt-2"><?php echo esc_html( rcg_truncate( get_the_excerpt(), 200 ) ); ?></p>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>

            <div class="mt-16 flex justify-center">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg mb-8"><?php esc_html_e( 'Aucun resultat trouve. Essayez avec d\'autres termes.', 'rcg' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block bg-primary text-white text-xs font-bold uppercase tracking-widest px-8 py-4 rounded-btn hover:scale-105 transition-transform">
                    <?php esc_html_e( 'Retour a l\'accueil', 'rcg' ); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
