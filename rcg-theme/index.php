<?php
/**
 * Template principal (fallback)
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="bg-[#f4f4f4] py-24">
    <div class="container mx-auto px-6 lg:px-12">
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="bg-white group flex flex-col transition-all hover:shadow-lg">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="h-56 overflow-hidden">
                                <?php the_post_thumbnail( 'card-medium', array(
                                    'class'   => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500',
                                    'loading' => 'lazy',
                                ) ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="p-8 space-y-4">
                            <h3 class="text-xl font-bold leading-snug group-hover:text-primary transition-colors"><?php echo esc_html( get_the_title() ); ?></h3>
                            <p class="text-gray-500 text-sm leading-relaxed"><?php echo esc_html( rcg_truncate( get_the_excerpt(), 120 ) ); ?></p>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>
            <div class="mt-16 flex justify-center">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <p class="text-gray-500 text-center text-lg"><?php esc_html_e( 'Aucun contenu trouve.', 'rcg' ); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
