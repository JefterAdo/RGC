<?php
/**
 * Template : Article individuel (blog / insights)
 *
 * @package RCG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
    the_post();

    // ACF Insights fields
    $insight_type   = get_field( 'insight_type' ) ?: 'standard';
    $read_time      = get_field( 'insight_read_time' ) ?: 5;
    $author_init    = get_field( 'insight_author_initials' );
    $author_title   = get_field( 'insight_author_title' );
    $stat_value     = get_field( 'insight_stat_value' );
    $stat_label     = get_field( 'insight_stat_label' );
    $report_pages   = get_field( 'insight_report_pages' );
    $report_file    = get_field( 'insight_report_file' );

    // Thematique insight
    $thematiques = get_the_terms( get_the_ID(), 'thematique_insight' );
    $thematique  = ( $thematiques && ! is_wp_error( $thematiques ) ) ? $thematiques[0]->name : '';

    // Fallback to category
    if ( ! $thematique ) {
        $cats = get_the_category();
        $thematique = $cats ? $cats[0]->name : '';
    }
?>

<!-- Header article -->
<header class="bg-background-dark py-24 text-white">
    <div class="container mx-auto px-6 lg:px-12 max-w-4xl">
        <div class="flex items-center gap-3 text-[10px] uppercase tracking-widest text-white/40 mb-6">
            <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
            <?php if ( $thematique ) : ?>
                <span>&bull;</span>
                <span class="text-primary"><?php echo esc_html( $thematique ); ?></span>
            <?php endif; ?>
            <span>&bull;</span>
            <span><?php echo esc_html( $read_time ); ?> min</span>
        </div>
        <h1 class="text-4xl lg:text-5xl font-black leading-tight uppercase">
            <?php echo esc_html( get_the_title() ); ?>
        </h1>
        <?php if ( has_excerpt() ) : ?>
            <p class="text-white/60 text-lg font-light leading-relaxed mt-8 max-w-2xl">
                <?php echo esc_html( get_the_excerpt() ); ?>
            </p>
        <?php endif; ?>

        <!-- Auteur -->
        <?php if ( $author_init ) : ?>
            <div class="flex items-center gap-4 mt-10 pt-8 border-t border-white/10">
                <div class="w-10 h-10 bg-primary/20 flex items-center justify-center text-primary font-bold text-sm">
                    <?php echo esc_html( $author_init ); ?>
                </div>
                <div>
                    <div class="text-white font-bold text-sm"><?php the_author(); ?></div>
                    <?php if ( $author_title ) : ?>
                        <div class="text-white/40 text-xs"><?php echo esc_html( $author_title ); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</header>

<!-- Stat block for rapport type -->
<?php if ( 'rapport' === $insight_type && $stat_value ) : ?>
    <div class="bg-surface-dark py-12">
        <div class="container mx-auto px-6 lg:px-12 max-w-4xl flex flex-col md:flex-row items-center gap-8">
            <div class="text-center md:text-left">
                <div class="font-black text-5xl text-primary"><?php echo esc_html( $stat_value ); ?></div>
                <?php if ( $stat_label ) : ?>
                    <div class="text-white/50 text-sm mt-2"><?php echo esc_html( $stat_label ); ?></div>
                <?php endif; ?>
            </div>
            <?php if ( $report_pages || $report_file ) : ?>
                <div class="flex gap-6 md:ml-auto">
                    <?php if ( $report_pages ) : ?>
                        <div class="text-white/40 text-sm"><span class="material-symbols-outlined text-primary text-base align-middle mr-1">description</span> <?php echo esc_html( $report_pages ); ?></div>
                    <?php endif; ?>
                    <?php if ( $report_file ) : ?>
                        <a href="<?php echo esc_url( $report_file ); ?>" target="_blank" rel="noopener noreferrer" class="bg-primary text-white text-xs font-bold uppercase tracking-widest px-6 py-3 hover:bg-red-700 transition-colors">
                            Télécharger le PDF
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Image a la une -->
<?php if ( has_post_thumbnail() ) : ?>
    <div class="bg-surface-dark py-8">
        <div class="container mx-auto px-6 lg:px-12 max-w-4xl">
            <?php the_post_thumbnail( 'hero-large', array( 'class' => 'w-full h-auto max-h-[500px] object-cover' ) ); ?>
        </div>
    </div>
<?php endif; ?>

<!-- Contenu -->
<section class="bg-white py-24">
    <div class="container mx-auto px-6 lg:px-12 max-w-4xl">
        <div class="prose prose-lg max-w-none text-gray-600">
            <?php the_content(); ?>
        </div>

        <!-- Tags -->
        <?php
        $post_tags = get_the_tags();
        if ( $post_tags ) :
        ?>
            <div class="mt-12 pt-8 border-t border-gray-100 flex flex-wrap gap-2">
                <?php foreach ( $post_tags as $tag ) : ?>
                    <a href="<?php echo esc_url( get_tag_link( $tag ) ); ?>" class="tag-pill text-gray-400 border-gray-200 hover:text-primary hover:border-primary transition-colors">
                        <?php echo esc_html( $tag->name ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Navigation -->
        <div class="mt-12 pt-8 border-t border-gray-100 flex justify-between">
            <?php
            $prev = get_previous_post();
            $next = get_next_post();
            ?>
            <?php if ( $prev ) : ?>
                <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-primary transition-colors">
                    &laquo; <?php esc_html_e( 'Précédent', 'rcg' ); ?>
                </a>
            <?php else : ?>
                <span></span>
            <?php endif; ?>
            <?php if ( $next ) : ?>
                <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-primary transition-colors">
                    <?php esc_html_e( 'Suivant', 'rcg' ); ?> &raquo;
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<?php get_template_part( 'template-parts/cta-banner' ); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
