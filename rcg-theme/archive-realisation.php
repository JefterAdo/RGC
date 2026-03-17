<?php
/**
 * Template : Archive des Realisations
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
        <span class="text-primary font-bold text-sm tracking-widest uppercase">&mdash; <?php esc_html_e( 'Realisations', 'rcg' ); ?></span>
        <h1 class="text-5xl lg:text-[76px] font-black leading-[1.05] uppercase mt-6">
            <?php esc_html_e( 'Etudes de cas', 'rcg' ); ?>
        </h1>
    </div>
</section>

<section class="bg-[#f4f4f4] py-24">
    <div class="container mx-auto px-6 lg:px-12">
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/card-realisation' );
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                <?php
                the_posts_pagination( array(
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                    'class'     => 'flex gap-2',
                ) );
                ?>
            </div>
        <?php else : ?>
            <p class="text-gray-500 text-center text-lg"><?php esc_html_e( 'Aucune realisation pour le moment.', 'rcg' ); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
