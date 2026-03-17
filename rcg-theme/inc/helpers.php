<?php
/**
 * Fonctions utilitaires du theme
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Recuperer un champ ACF avec fallback
 */
function rcg_get_field( $field_name, $post_id = false, $default = '' ) {
    if ( ! function_exists( 'get_field' ) ) {
        return $default;
    }
    $value = get_field( $field_name, $post_id );
    return $value ? $value : $default;
}

/**
 * Recuperer un champ ACF d'options
 */
function rcg_get_option( $field_name, $default = '' ) {
    return rcg_get_field( $field_name, 'option', $default );
}

/**
 * Afficher le logo RCG (SVG inline ou custom logo)
 */
function rcg_logo( $variant = 'light' ) {
    $text_color = ( 'dark' === $variant ) ? 'text-background-dark' : 'text-white';
    $sub_color  = ( 'dark' === $variant ) ? 'text-gray-500' : 'text-white/40';

    if ( has_custom_logo() ) {
        the_custom_logo();
        return;
    }
    ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3">
        <div class="grid grid-cols-2 gap-0.5 w-8 h-8">
            <div class="bg-primary"></div>
            <div class="bg-primary opacity-80"></div>
            <div class="bg-primary opacity-60"></div>
            <div class="bg-primary opacity-40"></div>
        </div>
        <div class="flex flex-col leading-none">
            <span class="text-xl font-black <?php echo esc_attr( $text_color ); ?> tracking-tighter"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
            <span class="text-[8px] uppercase font-medium tracking-widest <?php echo esc_attr( $sub_color ); ?>"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></span>
        </div>
    </a>
    <?php
}

/**
 * Afficher les icones des reseaux sociaux
 */
function rcg_social_links( $class = 'text-white/40 hover:text-white' ) {
    $linkedin = rcg_get_option( 'rcg_linkedin_url', '#' );
    $twitter  = rcg_get_option( 'rcg_twitter_url', '#' );
    ?>
    <div class="flex gap-4">
        <?php if ( $linkedin ) : ?>
        <a class="<?php echo esc_attr( $class ); ?> transition-colors" href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
            </svg>
        </a>
        <?php endif; ?>
        <?php if ( $twitter ) : ?>
        <a class="<?php echo esc_attr( $class ); ?> transition-colors" href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
            </svg>
        </a>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Tronquer un texte avec ellipsis
 */
function rcg_truncate( $text, $length = 150 ) {
    if ( strlen( $text ) <= $length ) {
        return $text;
    }
    return rtrim( substr( $text, 0, $length ) ) . "\xE2\x80\xA6";
}
