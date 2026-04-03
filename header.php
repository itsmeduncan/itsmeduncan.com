<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    // Open Graph meta tags
    if ( is_singular( 'post' ) ) {
        $og_title       = get_the_title();
        $og_description = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_excerpt(), 30, '…' );
        $og_url         = get_permalink();
        $og_type        = 'article';
        $og_image       = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    } else {
        $og_title       = get_bloginfo( 'name' );
        $og_description = get_bloginfo( 'description' );
        $og_url         = home_url( '/' );
        $og_type        = 'website';
        $og_image       = '';
    }
    ?>
    <meta property="og:title" content="<?php echo esc_attr( $og_title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $og_description ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $og_url ); ?>">
    <meta property="og:type" content="<?php echo esc_attr( $og_type ); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
    <?php if ( $og_image ) : ?>
        <meta property="og:image" content="<?php echo esc_url( $og_image ); ?>">
    <?php endif; ?>

    <!-- Twitter Card -->
    <meta name="twitter:card" content="<?php echo $og_image ? 'summary_large_image' : 'summary'; ?>">
    <meta name="twitter:site" content="@itsmeduncan">
    <meta name="twitter:title" content="<?php echo esc_attr( $og_title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $og_description ); ?>">
    <?php if ( $og_image ) : ?>
        <meta name="twitter:image" content="<?php echo esc_url( $og_image ); ?>">
    <?php endif; ?>

    <?php
    // JSON-LD Schema Markup
    if ( is_front_page() ) :
        $website_schema = array(
            '@context' => 'https://schema.org',
            '@type'    => 'WebSite',
            'name'     => get_bloginfo( 'name' ),
            'url'      => home_url( '/' ),
            'description' => get_bloginfo( 'description' ),
        );
    ?>
    <script type="application/ld+json"><?php echo wp_json_encode( $website_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?></script>
    <?php
    elseif ( is_singular( 'post' ) ) :
        $article_schema = array(
            '@context'      => 'https://schema.org',
            '@type'         => 'Article',
            'headline'      => get_the_title(),
            'datePublished' => get_the_date( 'c' ),
            'dateModified'  => get_the_modified_date( 'c' ),
            'url'           => get_permalink(),
            'author'        => array(
                '@type' => 'Person',
                'name'  => get_the_author(),
                'url'   => home_url( '/about-duncan-grazier/' ),
            ),
            'publisher'     => array(
                '@type' => 'Person',
                'name'  => get_bloginfo( 'name' ),
                'url'   => home_url( '/' ),
            ),
        );
        $thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        if ( $thumb ) {
            $article_schema['image'] = $thumb;
        }
    ?>
    <script type="application/ld+json"><?php echo wp_json_encode( $article_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?></script>
    <?php
    elseif ( is_page( 'about-duncan-grazier' ) ) :
        $person_schema = array(
            '@context'  => 'https://schema.org',
            '@type'     => 'Person',
            'name'      => 'Duncan Grazier',
            'jobTitle'  => 'Chief AI Officer',
            'worksFor'  => array(
                '@type' => 'Organization',
                'name'  => 'BuildOps',
            ),
            'url'       => 'https://itsmeduncan.com',
            'sameAs'    => array(
                'https://linkedin.com/in/itsmeduncan',
                'https://github.com/itsmeduncan',
            ),
        );
    ?>
    <script type="application/ld+json"><?php echo wp_json_encode( $person_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?></script>
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav class="site-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'itsmeduncan' ); ?>">
    <div class="container">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-brand">
            <span class="nav-brand-icon">
                <?php if ( has_custom_logo() ) :
                    $logo_id  = get_theme_mod( 'custom_logo' );
                    $logo_url = wp_get_attachment_image_url( $logo_id, 'thumbnail' );
                ?>
                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                <?php else : ?>
                    D
                <?php endif; ?>
            </span>
            <span class="nav-brand-name"><?php bloginfo( 'name' ); ?></span>
        </a>

        <button class="nav-toggle" aria-label="<?php esc_attr_e( 'Toggle menu', 'itsmeduncan' ); ?>" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>

        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'nav-menu',
            'depth'          => 2,
            'fallback_cb'    => 'itsmeduncan_fallback_menu',
        ) );
        ?>
    </div>
</nav>
