<?php
/**
 * Template : Page par defaut
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
        <h1 class="text-5xl lg:text-[76px] font-black leading-[1.05] uppercase">
            <?php echo esc_html( get_the_title() ); ?>
        </h1>
    </div>
</section>

<section class="bg-white py-24">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="prose prose-lg max-w-4xl mx-auto text-gray-600">
            <?php
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
