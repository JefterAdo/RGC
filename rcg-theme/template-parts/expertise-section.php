<?php
/**
 * Template part : Section d'expertise individuelle
 *
 * Variables attendues (definies par le parent) :
 *   $number, $anchor, $eyebrow, $bg, $layout, $list_type,
 *   $exp_title, $exp_desc, $quote, $image_url, $image_alt,
 *   $contact_url, $reals_url
 *   (mode statique) $static_items, $static_stats, $static_tags
 *   (mode dynamique) utilise les fonctions ACF have_rows / get_sub_field
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Classes de fond
$bg_classes = 'bg-white';
$text_dark  = true;
switch ( $bg ) {
    case 'gray':
        $bg_classes = 'bg-[#f4f4f4]';
        break;
    case 'surface-dark':
        $bg_classes = 'bg-surface-dark text-white';
        $text_dark  = false;
        break;
    case 'dark':
        $bg_classes = 'bg-background-dark text-white relative overflow-hidden';
        $text_dark  = false;
        break;
}

$number_color = $text_dark ? 'text-background-dark/[0.04]' : 'text-white/[0.04]';
$title_color  = $text_dark ? 'text-background-dark' : '';
$desc_color   = $text_dark ? 'text-gray-500' : 'text-white/60';
$show_image_first = ( 'text-right' === $layout );

// Items : statique ou dynamique
$is_static = isset( $static_items );
$items     = $is_static ? $static_items : array();
$stats     = ( $is_static && isset( $static_stats ) ) ? $static_stats : array();
$tags      = ( $is_static && isset( $static_tags ) ) ? $static_tags : array();

// Collecter les items dynamiques (ACF)
if ( ! $is_static && function_exists( 'have_rows' ) && have_rows( 'expertise_items' ) ) {
    while ( have_rows( 'expertise_items' ) ) {
        the_row();
        $items[] = array(
            'icon'  => get_sub_field( 'icon' ),
            'title' => get_sub_field( 'title' ),
            'desc'  => get_sub_field( 'description' ),
        );
    }
}
if ( ! $is_static && function_exists( 'have_rows' ) && have_rows( 'expertise_stats' ) ) {
    while ( have_rows( 'expertise_stats' ) ) {
        the_row();
        $stats[] = array( 'value' => get_sub_field( 'value' ), 'label' => get_sub_field( 'label' ) );
    }
}
if ( ! $is_static && function_exists( 'have_rows' ) && have_rows( 'expertise_tags' ) ) {
    while ( have_rows( 'expertise_tags' ) ) {
        the_row();
        $tags[] = get_sub_field( 'text' );
    }
}
?>

<section id="<?php echo esc_attr( $anchor ); ?>" class="py-24 <?php echo esc_attr( $bg_classes ); ?> scroll-mt-20">

    <?php if ( 'dark' === $bg ) : ?>
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-0 font-black text-[400px] leading-none text-white/10 tracking-tighter select-none">!</div>
    </div>
    <?php endif; ?>

    <?php if ( 'cards' === $list_type ) : ?>
    <!-- ===== LAYOUT CARDS (Branding) ===== -->
    <div class="container mx-auto px-6 lg:px-12 reveal visible">
        <div class="grid lg:grid-cols-3 gap-12 mb-16">
            <div class="lg:col-span-2">
                <span class="font-black text-[80px] <?php echo esc_attr( $number_color ); ?> leading-none block mb-2"><?php echo esc_html( $number ); ?></span>
                <?php if ( $eyebrow ) : ?>
                    <span class="eyebrow mb-6">&mdash; <?php echo esc_html( $eyebrow ); ?></span>
                <?php endif; ?>
                <h2 class="font-black text-4xl lg:text-5xl uppercase leading-tight tracking-tight <?php echo esc_attr( $title_color ); ?> mb-6 mt-4">
                    <?php echo esc_html( $exp_title ); ?>
                </h2>
                <div class="line-accent mb-6"></div>
                <p class="<?php echo esc_attr( $desc_color ); ?> leading-relaxed max-w-2xl">
                    <?php echo esc_html( $exp_desc ); ?>
                </p>
            </div>

            <?php if ( $quote ) : ?>
            <div class="bg-primary text-white p-8 flex flex-col justify-between">
                <p class="quote-bar text-xl leading-relaxed"><?php echo esc_html( $quote ); ?></p>
                <?php if ( ! empty( $stats ) ) : ?>
                    <div class="mt-6 pt-6 border-t border-white/20">
                        <div class="font-black text-3xl"><?php echo esc_html( $stats[0]['value'] ); ?></div>
                        <div class="text-[9px] uppercase tracking-widest text-white/60 mt-1"><?php echo esc_html( $stats[0]['label'] ); ?></div>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Grille de cartes -->
        <?php if ( ! empty( $items ) ) : ?>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <?php foreach ( $items as $item ) : ?>
                <div class="bg-[#f4f4f4] p-6 group hover:bg-primary transition-colors cursor-default">
                    <?php if ( ! empty( $item['icon'] ) ) : ?>
                        <span class="material-symbols-outlined text-primary group-hover:text-white text-3xl block mb-4 transition-colors"><?php echo esc_html( $item['icon'] ); ?></span>
                    <?php endif; ?>
                    <h4 class="font-bold text-sm uppercase tracking-tight group-hover:text-white transition-colors">
                        <?php echo esc_html( $item['title'] ); ?>
                    </h4>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <?php else : ?>
    <!-- ===== LAYOUT STANDARD (texte + image) ===== -->
    <div class="container mx-auto px-6 lg:px-12 grid lg:grid-cols-2 gap-0 reveal visible">

        <?php
        // --- IMAGE A GAUCHE ---
        if ( $show_image_first && $image_url ) :
        ?>
        <div class="exp-img-wrap relative h-[400px] lg:h-auto overflow-hidden group">
            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="w-full h-full object-cover object-center">
            <?php if ( 'gray' === $bg ) : ?>
                <div class="absolute inset-0 bg-gradient-to-r from-transparent to-[#f4f4f4]/60"></div>
            <?php else : ?>
                <div class="absolute inset-0 bg-gradient-to-t from-background-dark/90 via-background-dark/30 to-transparent"></div>
            <?php endif; ?>

            <?php if ( ! empty( $tags ) ) : ?>
                <div class="absolute top-6 left-6 flex flex-wrap gap-2">
                    <?php foreach ( $tags as $tag ) : ?>
                        <span class="tag-pill <?php echo $text_dark ? 'text-primary border-primary/40 bg-white/80 backdrop-blur-sm' : 'text-white border-white/30'; ?>">
                            <?php echo esc_html( $tag ); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ( $quote ) : ?>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <p class="quote-bar text-white text-xl leading-snug"><?php echo esc_html( $quote ); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- TEXTE -->
        <div class="<?php echo $show_image_first ? 'flex flex-col justify-center pl-0 lg:pl-16 py-8' : 'flex flex-col justify-center pr-0 lg:pr-16 py-8'; ?>">

            <?php if ( ! $show_image_first ) : ?>
                <div class="flex items-center gap-4 mb-4">
                    <span class="font-black text-[80px] <?php echo esc_attr( $number_color ); ?> leading-none"><?php echo esc_html( $number ); ?></span>
                </div>
            <?php else : ?>
                <span class="font-black text-[80px] <?php echo esc_attr( $number_color ); ?> leading-none mb-2"><?php echo esc_html( $number ); ?></span>
            <?php endif; ?>

            <?php if ( $eyebrow ) : ?>
                <span class="eyebrow mb-6">&mdash; <?php echo esc_html( $eyebrow ); ?></span>
            <?php endif; ?>

            <h2 class="font-black text-4xl lg:text-5xl uppercase leading-tight tracking-tight <?php echo esc_attr( $title_color ); ?> mb-6 mt-4">
                <?php echo esc_html( $exp_title ); ?>
            </h2>

            <div class="line-accent mb-8"></div>

            <p class="<?php echo esc_attr( $desc_color ); ?> leading-relaxed mb-8">
                <?php echo esc_html( $exp_desc ); ?>
            </p>

            <?php
            // === LISTE D'ITEMS ===
            if ( ! empty( $items ) ) :
                if ( 'steps' === $list_type ) :
            ?>
                <div class="space-y-0 mb-10">
                    <?php foreach ( $items as $item ) : ?>
                    <div class="process-step flex items-start gap-6 pb-8">
                        <div class="w-10 h-10 rounded-full border-2 border-primary flex items-center justify-center shrink-0 bg-white z-10">
                            <span class="font-black text-primary text-xs"><?php echo esc_html( $item['icon'] ); ?></span>
                        </div>
                        <div class="pt-1">
                            <h4 class="font-bold text-sm uppercase tracking-wider mb-1"><?php echo esc_html( $item['title'] ); ?></h4>
                            <p class="<?php echo $text_dark ? 'text-gray-400' : 'text-white/50'; ?> text-sm"><?php echo esc_html( $item['desc'] ); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            <?php elseif ( 'arrows' === $list_type ) : ?>
                <ul class="space-y-3 mb-10">
                    <?php foreach ( $items as $item ) : ?>
                    <li class="flex gap-4 items-start">
                        <span class="text-primary font-black text-lg leading-none mt-0.5">&rarr;</span>
                        <span class="<?php echo $text_dark ? 'text-gray-600' : 'text-white/70'; ?> text-sm leading-relaxed"><?php echo esc_html( $item['desc'] ); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>

            <?php elseif ( 'hover' === $list_type ) : ?>
                <div class="space-y-4 mb-10">
                    <?php foreach ( $items as $item ) : ?>
                    <div class="flex items-center justify-between py-4 border-b <?php echo $text_dark ? 'border-gray-100' : 'border-white/10'; ?> group cursor-default">
                        <span class="font-bold text-sm uppercase tracking-wider group-hover:text-primary transition-colors"><?php echo esc_html( $item['title'] ); ?></span>
                        <span class="material-symbols-outlined text-primary text-lg">north_east</span>
                    </div>
                    <?php endforeach; ?>
                </div>

            <?php elseif ( 'timeline' === $list_type ) : ?>
                <div class="space-y-4 mb-10">
                    <?php foreach ( $items as $item ) : ?>
                    <div class="flex gap-4 p-4 border border-white/10 hover:border-primary transition-colors">
                        <span class="font-black text-primary text-xl leading-none"><?php echo esc_html( $item['icon'] ); ?></span>
                        <div>
                            <div class="font-bold text-sm uppercase tracking-wider mb-1"><?php echo esc_html( $item['title'] ); ?></div>
                            <div class="<?php echo $text_dark ? 'text-gray-400' : 'text-white/50'; ?> text-xs"><?php echo esc_html( $item['desc'] ); ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php
                endif;
            endif;
            ?>

            <?php
            // === STATISTIQUES ===
            if ( ! empty( $stats ) ) :
            ?>
            <?php
            $cols_map = array( 1 => 'grid-cols-1', 2 => 'grid-cols-2', 3 => 'grid-cols-3', 4 => 'grid-cols-4' );
            $cols_class = isset( $cols_map[ count( $stats ) ] ) ? $cols_map[ count( $stats ) ] : 'grid-cols-3';
            ?>
            <div class="grid <?php echo esc_attr( $cols_class ); ?> gap-4 pt-8 border-t <?php echo $text_dark ? 'border-gray-200' : 'border-white/10'; ?>">
                <?php foreach ( $stats as $idx => $stat ) :
                    $border = ( $idx > 0 ) ? ( $text_dark ? 'border-x border-gray-200' : 'border-x border-white/10' ) : '';
                ?>
                <div class="text-center <?php echo esc_attr( $border ); ?>">
                    <div class="font-black text-3xl text-primary"><?php echo esc_html( $stat['value'] ); ?></div>
                    <div class="text-[9px] uppercase tracking-widest <?php echo $text_dark ? 'text-gray-400' : 'text-white/40'; ?> mt-1"><?php echo esc_html( $stat['label'] ); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- CTA -->
            <div class="flex items-center gap-4 mt-8">
                <a href="<?php echo esc_url( $contact_url ); ?>" class="bg-primary text-white font-bold text-[11px] uppercase tracking-widest px-6 py-3 inline-block hover:bg-red-700 transition-colors">
                    Discuter de votre projet
                </a>
                <a href="<?php echo esc_url( $reals_url ); ?>" class="<?php echo $text_dark ? 'text-gray-400' : 'text-white/50'; ?> font-semibold text-[11px] uppercase tracking-widest hover:text-primary transition-colors flex items-center gap-2">
                    Voir les cas <span class="material-symbols-outlined text-sm">north_east</span>
                </a>
            </div>
        </div>

        <?php
        // --- IMAGE A DROITE ---
        if ( ! $show_image_first && $image_url ) :
        ?>
        <div class="exp-img-wrap relative h-[500px] lg:h-auto overflow-hidden group">
            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-background-dark/90 via-background-dark/30 to-transparent"></div>

            <?php if ( ! empty( $tags ) ) : ?>
                <div class="absolute top-6 left-6 flex flex-wrap gap-2">
                    <?php foreach ( $tags as $tag ) : ?>
                        <span class="tag-pill text-white border-white/30"><?php echo esc_html( $tag ); ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ( $quote ) : ?>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <p class="quote-bar text-white text-xl leading-snug"><?php echo esc_html( $quote ); ?></p>
                </div>
            <?php endif; ?>

            <div class="absolute bottom-0 left-0 w-full h-1 bg-primary"></div>
        </div>
        <?php endif; ?>

    </div>
    <?php endif; ?>

</section>
