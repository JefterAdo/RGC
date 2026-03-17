<?php
/**
 * Template : Archives (blog / insights)
 *
 * @package RCG
 */

get_header();

// Get thematique_insight terms for filter
$thematiques = get_terms( array(
    'taxonomy'   => 'thematique_insight',
    'hide_empty' => true,
) );
?>

<header class="bg-background-dark py-24 text-white">
    <div class="container mx-auto px-6 lg:px-12">
        <span class="eyebrow mb-6">— Insights</span>
        <h1 class="text-5xl lg:text-[76px] font-black leading-[1.05] uppercase mt-4">
            <?php
            if ( is_category() ) {
                single_cat_title();
            } elseif ( is_tag() ) {
                single_tag_title();
            } elseif ( is_tax( 'thematique_insight' ) ) {
                single_term_title();
            } elseif ( is_author() ) {
                the_author();
            } else {
                esc_html_e( 'Insights', 'rcg' );
            }
            ?>
        </h1>
        <?php if ( is_tax( 'thematique_insight' ) || is_category() ) : ?>
            <p class="text-white/55 text-lg mt-4"><?php echo esc_html( term_description() ); ?></p>
        <?php endif; ?>
    </div>
</header>

<!-- Filter bar -->
<?php if ( $thematiques && ! is_wp_error( $thematiques ) && ! is_tax( 'thematique_insight' ) ) : ?>
    <div class="bg-white border-b border-gray-100 sticky top-[72px] z-30">
        <div class="container mx-auto px-6 lg:px-12 flex items-center gap-0 overflow-x-auto">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="filter-tab <?php echo ! is_category() && ! is_tax() ? 'active' : ''; ?>">
                <?php esc_html_e( 'Tous', 'rcg' ); ?>
            </a>
            <?php foreach ( $thematiques as $term ) : ?>
                <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="filter-tab <?php echo is_tax( 'thematique_insight', $term->term_id ) ? 'active' : ''; ?>">
                    <?php echo esc_html( $term->name ); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<section class="bg-[#f4f4f4] py-24">
    <div class="container mx-auto px-6 lg:px-12">
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $count = 0;
                while ( have_posts() ) :
                    the_post();
                    $count++;
                    $read_time  = get_field( 'insight_read_time' ) ?: 5;
                    $post_thems = get_the_terms( get_the_ID(), 'thematique_insight' );
                    $them_name  = ( $post_thems && ! is_wp_error( $post_thems ) ) ? $post_thems[0]->name : '';
                    if ( ! $them_name ) {
                        $cats = get_the_category();
                        $them_name = $cats ? $cats[0]->name : '';
                    }
                    $col_span = ( 1 === $count ) ? ' lg:col-span-2' : '';
                ?>
                    <a href="<?php the_permalink(); ?>" class="article-card bg-white group flex flex-col transition-all hover:shadow-lg<?php echo esc_attr( $col_span ); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="h-56<?php echo $col_span ? ' lg:h-72' : ''; ?> overflow-hidden">
                                <?php the_post_thumbnail( 'card-medium', array(
                                    'class'   => 'w-full h-full object-cover',
                                    'loading' => 'lazy',
                                ) ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="p-8 flex flex-col flex-1 space-y-4">
                            <div class="flex items-center gap-3 text-[10px] uppercase tracking-widest text-gray-400">
                                <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                                <?php if ( $them_name ) : ?>
                                    <span>&bull;</span>
                                    <span class="text-primary"><?php echo esc_html( $them_name ); ?></span>
                                <?php endif; ?>
                                <span>&bull;</span>
                                <span><?php echo esc_html( $read_time ); ?> min</span>
                            </div>
                            <h3 class="text-xl font-bold leading-snug group-hover:text-primary transition-colors"><?php the_title(); ?></h3>
                            <p class="text-gray-500 text-sm leading-relaxed flex-1"><?php echo esc_html( rcg_truncate( get_the_excerpt(), 120 ) ); ?></p>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>

            <div class="mt-16 flex justify-center">
                <?php the_posts_pagination( array(
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ) ); ?>
            </div>
        <?php else : ?>
            <p class="text-gray-500 text-center text-lg"><?php esc_html_e( 'Aucun article pour le moment.', 'rcg' ); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
