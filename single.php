<?php
/**
 * Single Post Template
 * @package ItsMeDuncan
 */
get_header();

while ( have_posts() ) : the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <!-- Post Header -->
    <header class="post-header">
        <?php itsmeduncan_category_badge(); ?>
        <h1><?php the_title(); ?></h1>
        <div class="post-meta">
            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
            </time>
            <span class="separator"></span>
            <span><?php echo esc_html( itsmeduncan_reading_time() ); ?></span>
        </div>
    </header>

    <!-- Featured Image -->
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-featured-image">
            <?php the_post_thumbnail( 'large' ); ?>
        </div>
    <?php endif; ?>

    <!-- Table of Contents -->
    <?php
    $toc = itsmeduncan_table_of_contents();
    if ( $toc ) :
    ?>
        <div class="content-width" style="padding: 0 24px;">
            <?php echo $toc; ?>
        </div>
    <?php endif; ?>

    <!-- Social Share Bar (desktop only) -->
    <?php itsmeduncan_share_buttons(); ?>

    <!-- Post Content -->
    <div class="post-content">
        <?php the_content(); ?>
    </div>

    <!-- Tags -->
    <?php
    $tags = get_the_tags();
    if ( $tags ) :
    ?>
        <div class="post-tags">
            <?php foreach ( $tags as $tag ) : ?>
                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>">
                    <?php echo esc_html( $tag->name ); ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Related Posts -->
    <?php
    $related = itsmeduncan_related_posts( get_the_ID(), 3 );
    if ( $related && $related->have_posts() ) :
    ?>
        <div class="related-posts container">
            <h2 class="related-posts-title"><?php esc_html_e( 'You might also like', 'itsmeduncan' ); ?></h2>
            <div class="related-posts-grid">
                <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                    <article class="related-card">
                        <a href="<?php the_permalink(); ?>">
                            <div class="featured-card-meta">
                                <?php itsmeduncan_category_badge( null, false ); ?>
                                <span class="read-time"><?php echo esc_html( itsmeduncan_reading_time() ); ?></span>
                            </div>
                            <h3><?php the_title(); ?></h3>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
    <?php wp_reset_postdata(); endif; ?>

    <!-- Author Bio Card -->
    <div class="author-card">
        <?php if ( $photo = get_theme_mod( 'author_photo' ) ) : ?>
            <div class="author-card-photo">
                <img src="<?php echo esc_url( $photo ); ?>" alt="<?php the_author(); ?>">
            </div>
        <?php endif; ?>
        <div>
            <div class="author-card-name"><?php the_author(); ?></div>
            <div class="author-card-bio">
                <?php echo esc_html( get_theme_mod( 'author_bio_short', 'Chief AI Officer at BuildOps ($1B unicorn). Scaled Weedmaps 30→300+ engineers through IPO. Writes weekly about AI & leadership.' ) ); ?>
            </div>
            <div class="author-card-links">
                <?php if ( $linkedin = get_theme_mod( 'social_linkedin' ) ) : ?>
                    <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener">LinkedIn &rarr;</a>
                <?php endif; ?>
                <a href="<?php echo esc_url( home_url( '/about-duncan-grazier/' ) ); ?>">About &rarr;</a>
            </div>
        </div>
    </div>

</article>

<?php
endwhile;
get_footer();
?>
