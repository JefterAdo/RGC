<?php
/**
 * Template : Page d'accueil
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Section Hero
get_template_part( 'template-parts/hero' );

// Section Positionnement
get_template_part( 'template-parts/positionnement' );

// Section Expertises
get_template_part( 'template-parts/expertises' );

// Section Realisations
get_template_part( 'template-parts/realisations' );

// Section Pourquoi RCG + CTA Banner
get_template_part( 'template-parts/pourquoi-rcg' );

get_footer();
