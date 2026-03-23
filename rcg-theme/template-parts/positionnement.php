<?php
/**
 * Template Part : Section Positionnement (page d'accueil)
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$label = rcg_get_field( 'pos_label', false, 'Notre Positionnement' );
$title = rcg_get_field( 'pos_title', false, 'Premiere agence africaine de conseil en communication institutionnelle' );
?>

<section class="bg-white py-24 relative overflow-hidden">
    <div class="absolute left-0 top-0 text-[10rem] lg:text-[30rem] font-black text-black/[0.03] leading-none select-none -translate-x-1/4 -translate-y-1/4">02</div>

    <div class="container mx-auto px-6 lg:px-12 grid lg:grid-cols-2 gap-8 lg:gap-16 relative z-10">
        <!-- Titre -->
        <div class="flex flex-col space-y-6">
            <span class="text-primary font-bold text-sm tracking-widest uppercase">&mdash; <?php echo esc_html( $label ); ?></span>
            <h2 class="text-background-dark text-4xl lg:text-5xl font-black leading-tight uppercase">
                <?php echo nl2br( esc_html( $title ) ); ?>
            </h2>
        </div>

        <!-- Cartes -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            <?php
            if ( function_exists( 'have_rows' ) && have_rows( 'pos_cards' ) ) :
                while ( have_rows( 'pos_cards' ) ) :
                    the_row();
                    ?>
                    <div class="space-y-4">
                        <span class="material-symbols-outlined text-primary text-4xl"><?php echo esc_html( get_sub_field( 'icon' ) ); ?></span>
                        <h3 class="font-bold text-sm uppercase tracking-wider"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
                        <p class="text-gray-500 text-sm leading-relaxed"><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
                    </div>
                    <?php
                endwhile;
            else :
                // Fallback statique
                $cards = array(
                    array( 'icon' => 'account_balance', 'title' => 'Institutions & Gouvernements', 'desc' => "Conseil strategique pour ministeres, agences etatiques et collectivites en Afrique de l'Ouest." ),
                    array( 'icon' => 'public', 'title' => 'Organisations Internationales', 'desc' => "Programmes de plaidoyer et communication pour la CEDEAO, BAD, et organismes regionaux." ),
                    array( 'icon' => 'corporate_fare', 'title' => 'Entreprises & Secteur Prive', 'desc' => "Branding institutionnel, gestion de reputation et relations publiques pour les leaders economiques." ),
                    array( 'icon' => 'rocket_launch', 'title' => 'Evenements & Sommets', 'desc' => "Conception et pilotage d'evenements institutionnels, sommets et conferences de haut niveau." ),
                );
                foreach ( $cards as $card ) :
                    ?>
                    <div class="space-y-4">
                        <span class="material-symbols-outlined text-primary text-4xl"><?php echo esc_html( $card['icon'] ); ?></span>
                        <h3 class="font-bold text-sm uppercase tracking-wider"><?php echo esc_html( $card['title'] ); ?></h3>
                        <p class="text-gray-500 text-sm leading-relaxed"><?php echo esc_html( $card['desc'] ); ?></p>
                    </div>
                <?php endforeach;
            endif;
            ?>
        </div>
    </div>
</section>
