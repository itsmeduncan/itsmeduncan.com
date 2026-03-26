<?php
/**
 * Search Results Template
 * @package ItsMeDuncan
 */
get_header();
?>

<header class="archive-header">
    <h1><?php printf( esc_html__( 'Search results for: "%s"', 'itsmeduncan' ), get_search_query() ); ?></h1>
</header>

<?php if ( have_posts() ) : ?>
    <div class="archive-grid">
        <?php while ( have_posts() ) : the_post(); ?>
            <article class="archive-card">
                <a href="<?php the_permalink(); ?>" class="archive-card-image<?php if ( ! has_post_thumbnail() ) echo ' archive-card-image--no-thumb'; ?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'featured-card' ); ?>
                    <?php endif; ?>
                    <div class="archive-card-overlay<?php if ( ! has_post_thumbnail() ) echo ' archive-card-overlay--full'; ?>">
                        <?php if ( ! has_post_thumbnail() ) : ?>
                            <span class="archive-card-category"><?php
                                $cats = get_the_category();
                                if ( ! empty( $cats ) ) echo esc_html( $cats[0]->name );
                            ?></span>
                        <?php endif; ?>
                        <h3><?php the_title(); ?></h3>
                    </div>
                </a>
                <div class="archive-card-body">
                    <div class="featured-card-meta">
                        <?php itsmeduncan_category_badge(); ?>
                        <span class="read-time"><?php echo esc_html( itsmeduncan_reading_time() ); ?></span>
                    </div>
                    <p class="excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                </div>
            </article>
        <?php endwhile; ?>
    </div>

    <nav class="pagination">
        <?php the_posts_pagination( array( 'mid_size' => 2, 'prev_text' => '← Previous', 'next_text' => 'Next →' ) ); ?>
    </nav>
<?php else : ?>
    <div class="content-width" style="padding: 64px 24px; text-align: center;">
        <p><?php esc_html_e( 'No results found. Try a different search term.', 'itsmeduncan' ); ?></p>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
