<?php
/**
 * Template : Realisation individuelle (etude de cas)
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
    the_post();

    $client      = get_field( 'realisation_client' );
    $year        = get_field( 'realisation_year' );
    $short       = get_field( 'realisation_short_desc' );
    $badge_color = get_field( 'realisation_badge_color' ) ?: 'red';
    $is_crisis   = get_field( 'realisation_is_crisis' );
    $kpis        = get_field( 'realisation_kpis' );
    $tags_list   = get_field( 'realisation_tags' );

    $categories = get_the_terms( get_the_ID(), 'categorie_expertise' );
    $cat_name   = ( $categories && ! is_wp_error( $categories ) ) ? $categories[0]->name : '';

    // Badge color classes
    $color_map = array(
        'red'   => 'text-primary border-primary/50',
        'green' => 'text-accent-green border-accent-green/50',
        'blue'  => 'text-accent-blue border-accent-blue/50',
        'amber' => 'text-amber-500 border-amber-500/50',
    );
    $badge_classes = isset( $color_map[ $badge_color ] ) ? $color_map[ $badge_color ] : $color_map['red'];
?>

<!-- Header -->
<header class="bg-background-dark py-24 text-white">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-6">
                <?php if ( $cat_name ) : ?>
                    <span class="tag-pill <?php echo esc_attr( $badge_classes ); ?>"><?php echo esc_html( $cat_name ); ?></span>
                <?php endif; ?>
                <?php if ( $is_crisis ) : ?>
                    <span class="crisis-dot"></span>
                    <span class="text-primary text-[10px] uppercase tracking-widest font-bold">Crise</span>
                <?php endif; ?>
            </div>
            <h1 class="text-4xl lg:text-5xl font-black leading-tight uppercase">
                <?php echo esc_html( get_the_title() ); ?>
            </h1>
            <?php if ( $short ) : ?>
                <p class="text-white/60 text-lg font-light leading-relaxed mt-8">
                    <?php echo esc_html( $short ); ?>
                </p>
            <?php endif; ?>

            <!-- Metadata -->
            <div class="flex flex-wrap gap-8 mt-8 pt-8 border-t border-white/10">
                <?php if ( $client ) : ?>
                    <div>
                        <span class="text-white/40 text-[10px] uppercase tracking-widest block"><?php esc_html_e( 'Client', 'rcg' ); ?></span>
                        <span class="text-white font-bold mt-1 block"><?php echo esc_html( $client ); ?></span>
                    </div>
                <?php endif; ?>
                <?php if ( $year ) : ?>
                    <div>
                        <span class="text-white/40 text-[10px] uppercase tracking-widest block"><?php esc_html_e( 'Année', 'rcg' ); ?></span>
                        <span class="text-white font-bold mt-1 block"><?php echo esc_html( $year ); ?></span>
                    </div>
                <?php endif; ?>
                <?php if ( $cat_name ) : ?>
                    <div>
                        <span class="text-white/40 text-[10px] uppercase tracking-widest block"><?php esc_html_e( 'Expertise', 'rcg' ); ?></span>
                        <span class="text-white font-bold mt-1 block"><?php echo esc_html( $cat_name ); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<!-- Image a la une -->
<?php if ( has_post_thumbnail() ) : ?>
<section class="bg-surface-dark">
    <div class="container mx-auto px-6 lg:px-12 py-12">
        <div class="max-h-[600px] overflow-hidden">
            <?php the_post_thumbnail( 'hero-large', array( 'class' => 'w-full h-full object-cover' ) ); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Contenu -->
<section class="bg-white py-24">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="grid lg:grid-cols-3 gap-16">
            <!-- Contenu principal -->
            <div class="lg:col-span-2 prose prose-lg max-w-none text-gray-600">
                <?php the_content(); ?>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- KPIs -->
                <?php if ( $kpis ) : ?>
                    <div class="bg-surface-dark text-white p-8">
                        <h3 class="text-sm font-bold uppercase tracking-widest mb-6 pb-4 border-b border-white/10">
                            <?php esc_html_e( 'Résultats clés', 'rcg' ); ?>
                        </h3>
                        <ul class="space-y-4">
                            <?php foreach ( $kpis as $kpi ) : ?>
                                <li class="flex items-start gap-3 pb-4 border-b border-white/10 last:border-0 last:pb-0">
                                    <span class="material-symbols-outlined text-primary text-lg mt-0.5">check_circle</span>
                                    <span class="text-white/70 text-sm"><?php echo esc_html( $kpi['text'] ); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php elseif ( function_exists( 'have_rows' ) && have_rows( 'realisation_results' ) ) : ?>
                    <div class="bg-surface-dark text-white p-8">
                        <h3 class="text-sm font-bold uppercase tracking-widest mb-6 pb-4 border-b border-white/10">
                            <?php esc_html_e( 'Résultats clés', 'rcg' ); ?>
                        </h3>
                        <ul class="space-y-4">
                            <?php while ( have_rows( 'realisation_results' ) ) : the_row(); ?>
                                <li class="flex items-start gap-3 pb-4 border-b border-white/10 last:border-0 last:pb-0">
                                    <span class="material-symbols-outlined text-primary text-lg mt-0.5">check_circle</span>
                                    <span class="text-white/70 text-sm"><?php echo esc_html( get_sub_field( 'text' ) ); ?></span>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Tags -->
                <?php if ( $tags_list ) : ?>
                    <div class="p-8 bg-[#f4f4f4]">
                        <h3 class="text-sm font-bold uppercase tracking-widest mb-4"><?php esc_html_e( 'Tags', 'rcg' ); ?></h3>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ( $tags_list as $tag ) : ?>
                                <span class="tag-pill text-gray-400 border-gray-200"><?php echo esc_html( $tag['label'] ); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Navigation entre realisations -->
        <div class="mt-16 pt-8 border-t border-gray-100 flex justify-between">
            <?php
            $prev = get_previous_post();
            $next = get_next_post();
            ?>
            <?php if ( $prev ) : ?>
                <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-primary transition-colors">
                    &laquo; <?php echo esc_html( get_the_title( $prev ) ); ?>
                </a>
            <?php else : ?>
                <span></span>
            <?php endif; ?>
            <?php if ( $next ) : ?>
                <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-primary transition-colors">
                    <?php echo esc_html( get_the_title( $next ) ); ?> &raquo;
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<?php get_template_part( 'template-parts/cta-banner' ); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
