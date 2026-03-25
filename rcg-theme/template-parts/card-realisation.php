<?php
/**
 * Template Part : Carte Realisation individuelle
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$categories = get_the_terms( get_the_ID(), 'categorie_expertise' );
$cat_name   = $categories && ! is_wp_error( $categories ) ? $categories[0]->name : '';
?>

<a href="<?php the_permalink(); ?>" class="bg-surface-dark group block overflow-hidden">
    <div class="h-48 md:h-64 overflow-hidden">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'card-medium', array(
                'class'   => 'w-full h-full object-cover object-center grayscale group-hover:grayscale-0 transition-all duration-500',
                'loading' => 'lazy',
            ) ); ?>
        <?php endif; ?>
    </div>
    <div class="p-8 space-y-4">
        <?php if ( $cat_name ) : ?>
            <span class="text-primary text-xs font-bold uppercase tracking-widest"><?php echo esc_html( $cat_name ); ?></span>
        <?php endif; ?>
        <h3 class="text-white text-xl font-bold leading-snug"><?php echo esc_html( get_the_title() ); ?></h3>
    </div>
</a>
