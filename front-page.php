<?php
/**
 * Front Page Template
 * Displays: Hero → Featured Posts → Recent Posts
 *
 * @package ItsMeDuncan
 */
get_header();
?>

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-inner">
        <div class="hero-content">
            <?php if ( $badge = get_theme_mod( 'hero_badge', 'Chief AI Officer · BuildOps' ) ) : ?>
                <div class="hero-badge"><?php echo esc_html( $badge ); ?></div>
            <?php endif; ?>

            <h1><?php echo esc_html( get_theme_mod( 'hero_headline', 'Building AI-powered teams that scale.' ) ); ?></h1>

            <p class="hero-description">
                <?php echo esc_html( get_theme_mod( 'hero_description', 'Former CTO at Weedmaps (scaled 30→300+ engineers through IPO) and ShopKeep ($550M exit). Writing weekly about AI implementation, engineering leadership, and what it takes to build at scale.' ) ); ?>
            </p>

            <?php itsmeduncan_email_form( 'dark' ); ?>

            <div class="hero-links">
                <?php if ( $linkedin = get_theme_mod( 'social_linkedin' ) ) : ?>
                    <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener">LinkedIn →</a>
                <?php endif; ?>
                <?php if ( $github = get_theme_mod( 'social_github' ) ) : ?>
                    <a href="<?php echo esc_url( $github ); ?>" target="_blank" rel="noopener">GitHub →</a>
                <?php endif; ?>
            </div>
        </div>

        <?php if ( $photo = get_theme_mod( 'hero_photo' ) ) : ?>
            <div class="hero-photo">
                <img src="<?php echo esc_url( $photo ); ?>" alt="<?php bloginfo( 'name' ); ?>">
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- FEATURED POSTS -->
<?php
$featured = itsmeduncan_get_featured_posts( 4 );
if ( $featured->have_posts() ) :
?>
<section class="section-featured">
    <div class="container">
        <div class="section-header">
            <h2><?php esc_html_e( 'Start Here', 'itsmeduncan' ); ?></h2>
            <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>">
                <?php esc_html_e( 'View all posts →', 'itsmeduncan' ); ?>
            </a>
        </div>

        <div class="featured-grid">
            <?php while ( $featured->have_posts() ) : $featured->the_post(); ?>
                <article class="featured-card">
                    <a href="<?php the_permalink(); ?>">
                        <div class="featured-card-meta">
                            <?php itsmeduncan_category_badge( null, false ); ?>
                            <span class="read-time"><?php echo esc_html( itsmeduncan_reading_time() ); ?></span>
                        </div>
                        <h3><?php the_title(); ?></h3>
                        <p class="excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                        <div class="post-date">
                            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?>
                            </time>
                        </div>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php wp_reset_postdata(); endif; ?>

<!-- RECENT POSTS -->
<?php
$recent = new WP_Query( array(
    'posts_per_page' => 6,
    'post_type'      => 'post',
    'post__not_in'   => get_option( 'sticky_posts' ),
) );

if ( $recent->have_posts() ) :
?>
<section class="section-recent">
    <div class="container">
        <h2><?php esc_html_e( 'Recent Writing', 'itsmeduncan' ); ?></h2>

        <ul class="recent-list">
            <?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
                <li class="recent-item">
                    <div class="recent-item-left">
                        <span class="recent-dot"></span>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    </div>
                    <div class="recent-item-right">
                        <?php itsmeduncan_category_badge(); ?>
                        <span class="post-date">
                            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?>
                            </time>
                        </span>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</section>
<?php wp_reset_postdata(); endif; ?>

<?php get_footer(); ?>
