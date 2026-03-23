<?php
/**
 * Template : Page 404
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="bg-background-dark min-h-[70vh] flex items-center justify-center text-white">
    <div class="container mx-auto px-6 lg:px-12 text-center">
        <span class="text-primary font-black text-[80px] md:text-[150px] lg:text-[300px] leading-none opacity-20 select-none block">404</span>
        <h1 class="text-3xl lg:text-5xl font-black uppercase -mt-10 lg:-mt-16 relative z-10">
            <?php esc_html_e( 'Page introuvable', 'rcg' ); ?>
        </h1>
        <p class="text-white/60 text-lg mt-6 max-w-md mx-auto">
            <?php esc_html_e( 'La page que vous recherchez n\'existe pas ou a été déplacée.', 'rcg' ); ?>
        </p>

        <!-- Barre de recherche -->
        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mt-10 max-w-md mx-auto flex">
            <input type="search" name="s" placeholder="<?php esc_attr_e( 'Rechercher sur le site...', 'rcg' ); ?>" class="flex-1 bg-surface-dark border border-white/10 text-white text-sm p-4 outline-none focus:border-primary transition-colors placeholder:text-white/30">
            <button type="submit" class="bg-primary text-white px-6 hover:bg-red-700 transition-colors">
                <span class="material-symbols-outlined text-xl">search</span>
            </button>
        </form>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block mt-8 bg-primary text-white text-xs font-bold uppercase tracking-widest px-8 py-4 hover:scale-105 transition-transform">
            <?php esc_html_e( 'Retour à l\'accueil', 'rcg' ); ?>
        </a>
    </div>
</section>

<?php get_footer(); ?>
