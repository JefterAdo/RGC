<?php
/**
 * Footer du theme RCG
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$footer_desc = get_theme_mod( 'rcg_footer_description', 'Premiere agence africaine de communication institutionnelle, politique et sociale. Conseil strategique, relations publiques et branding au service des decideurs en Afrique de l\'Ouest.' );
$copyright   = get_theme_mod( 'rcg_footer_copyright', '&copy; ' . wp_date( 'Y' ) . ' RCG West Africa. Tous droits reserves.' );
$newsletter  = get_theme_mod( 'rcg_newsletter_text', 'Recevez nos analyses et insights sur la communication institutionnelle en Afrique.' );
?>

<footer class="bg-background-dark border-t-4 border-primary pt-20 pb-10 text-white">
    <div class="container mx-auto px-6 lg:px-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">

        <!-- Colonne 1 : Logo + Description + Reseaux sociaux -->
        <div class="space-y-6">
            <div class="flex items-center gap-3">
                <div class="grid grid-cols-2 gap-0.5 w-6 h-6">
                    <div class="bg-primary"></div>
                    <div class="bg-primary opacity-80"></div>
                    <div class="bg-primary opacity-60"></div>
                    <div class="bg-primary opacity-40"></div>
                </div>
                <span class="text-2xl font-black tracking-tighter"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
            </div>
            <p class="text-white/40 text-sm leading-relaxed max-w-xs">
                <?php echo esc_html( $footer_desc ); ?>
            </p>
            <?php rcg_social_links(); ?>
        </div>

        <!-- Colonne 2 : Plan du site -->
        <div>
            <h4 class="text-sm font-bold uppercase tracking-widest mb-6 border-b border-white/10 pb-2">
                <?php esc_html_e( 'Plan du site', 'rcg' ); ?>
            </h4>
            <?php
            if ( has_nav_menu( 'menu-footer' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'menu-footer',
                    'container'      => false,
                    'items_wrap'     => '<ul class="space-y-3 text-sm text-white/60">%3$s</ul>',
                    'walker'         => new RCG_Footer_Walker(),
                ) );
            }
            ?>
        </div>

        <!-- Colonne 3 : Adresses -->
        <div>
            <h4 class="text-sm font-bold uppercase tracking-widest mb-6 border-b border-white/10 pb-2">
                <?php esc_html_e( 'Nos Adresses', 'rcg' ); ?>
            </h4>
            <ul class="space-y-6 text-sm text-white/60">
                <?php
                if ( function_exists( 'have_rows' ) && have_rows( 'rcg_addresses', 'option' ) ) :
                    while ( have_rows( 'rcg_addresses', 'option' ) ) :
                        the_row();
                        ?>
                        <li>
                            <strong class="text-white block mb-1"><?php echo esc_html( get_sub_field( 'city' ) ); ?></strong>
                            <?php echo esc_html( get_sub_field( 'line1' ) ); ?>
                            <?php if ( get_sub_field( 'line2' ) ) : ?>
                                <br><?php echo esc_html( get_sub_field( 'line2' ) ); ?>
                            <?php endif; ?>
                        </li>
                        <?php
                    endwhile;
                else :
                    ?>
                    <li>
                        <strong class="text-white block mb-1">Abidjan, Cote d'Ivoire</strong>
                        Cocody 8e Tranche<br>
                        Abidjan, Cote d'Ivoire
                    </li>
                    <li class="pt-2">
                        <span class="text-white/60 text-xs block"><strong class="text-white">Tel :</strong> +225 25 22 00 46 71</span>
                        <span class="text-white/60 text-xs block mt-1"><strong class="text-white">Email :</strong> info@rcgwestafrica.com</span>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Colonne 4 : Newsletter -->
        <div>
            <h4 class="text-sm font-bold uppercase tracking-widest mb-6 border-b border-white/10 pb-2">
                <?php esc_html_e( 'Newsletter', 'rcg' ); ?>
            </h4>
            <p class="text-xs text-white/40 mb-4">
                <?php echo esc_html( $newsletter ); ?>
            </p>
            <?php if ( is_active_sidebar( 'footer-newsletter' ) ) : ?>
                <?php dynamic_sidebar( 'footer-newsletter' ); ?>
            <?php else : ?>
                <form class="flex flex-col gap-3" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                    <?php wp_nonce_field( 'rcg_newsletter', 'rcg_newsletter_nonce' ); ?>
                    <input type="hidden" name="action" value="rcg_newsletter_subscribe">
                    <input
                        name="email"
                        class="bg-surface-dark border border-white/10 text-white text-xs p-3 rounded-btn focus:ring-primary focus:border-primary"
                        placeholder="<?php esc_attr_e( 'Votre email', 'rcg' ); ?>"
                        type="email"
                        required
                    >
                    <button type="submit" class="bg-primary text-white text-[10px] font-bold uppercase tracking-widest py-3 rounded-btn hover:bg-red-700 transition-colors">
                        <?php esc_html_e( "S'abonner", 'rcg' ); ?>
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Copyright + Liens legaux -->
    <div class="container mx-auto px-6 lg:px-12 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] uppercase tracking-widest text-white/20">
        <p><?php echo wp_kses_post( $copyright ); ?></p>
        <div class="flex gap-6">
            <?php
            if ( has_nav_menu( 'menu-legal' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'menu-legal',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new RCG_Legal_Walker(),
                ) );
            }
            ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
