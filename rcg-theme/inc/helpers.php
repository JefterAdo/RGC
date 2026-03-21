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
    $linkedin  = rcg_get_option( 'rcg_linkedin_url', 'https://www.linkedin.com/company/rcgwestafrica' );
    $twitter   = rcg_get_option( 'rcg_twitter_url', '#' );
    $facebook  = rcg_get_option( 'rcg_facebook_url', 'https://www.facebook.com/RCGWestAfricaa' );
    $instagram = rcg_get_option( 'rcg_instagram_url', 'https://www.instagram.com/rcgwestafrica_/' );
    ?>
    <div class="flex gap-4">
        <?php if ( $linkedin ) : ?>
        <a class="<?php echo esc_attr( $class ); ?> transition-colors" href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
            </svg>
        </a>
        <?php endif; ?>
        <?php if ( $facebook && '#' !== $facebook ) : ?>
        <a class="<?php echo esc_attr( $class ); ?> transition-colors" href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385h-3.047v-3.47h3.047v-2.642c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953h-1.514c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385c5.737-.9 10.125-5.864 10.125-11.854z"/>
            </svg>
        </a>
        <?php endif; ?>
        <?php if ( $instagram && '#' !== $instagram ) : ?>
        <a class="<?php echo esc_attr( $class ); ?> transition-colors" href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
            </svg>
        </a>
        <?php endif; ?>
        <?php if ( $twitter && '#' !== $twitter ) : ?>
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
    if ( mb_strlen( $text, 'UTF-8' ) <= $length ) {
        return $text;
    }
    return rtrim( mb_substr( $text, 0, $length, 'UTF-8' ) ) . "\xE2\x80\xA6";
}
