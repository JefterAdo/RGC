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
$title = rcg_get_field( 'pos_title', false, 'Acteur majeur de la communication institutionnelle' );
?>

<section class="bg-white py-24 relative overflow-hidden">
    <div class="absolute left-0 top-0 text-[30rem] font-black text-black/[0.03] leading-none select-none -translate-x-1/4 -translate-y-1/4">02</div>

    <div class="container mx-auto px-6 lg:px-12 grid lg:grid-cols-2 gap-16 relative z-10">
        <!-- Titre -->
        <div class="flex flex-col space-y-6">
            <span class="text-primary font-bold text-sm tracking-widest uppercase">&mdash; <?php echo esc_html( $label ); ?></span>
            <h2 class="text-background-dark text-4xl lg:text-5xl font-black leading-tight uppercase">
                <?php echo nl2br( esc_html( $title ) ); ?>
            </h2>
        </div>

        <!-- Cartes -->
        <div class="grid grid-cols-2 gap-8">
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
                    array( 'icon' => 'account_balance', 'title' => 'Institutions', 'desc' => "Accompagnement des ministeres et agences etatiques." ),
                    array( 'icon' => 'public', 'title' => 'Org. Internationales', 'desc' => "Deploiement de programmes de plaidoyer regionaux." ),
                    array( 'icon' => 'corporate_fare', 'title' => 'Entreprises', 'desc' => "Gestion de reputation et communication de marque." ),
                    array( 'icon' => 'rocket_launch', 'title' => 'Projets', 'desc' => "Lancement et pilotage d'initiatives strategiques." ),
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
