<?php
/**
 * ItsMeDuncan Theme Functions
 *
 * @package ItsMeDuncan
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ------------------------------------------
   THEME SETUP
   ------------------------------------------ */
function itsmeduncan_setup() {
    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Featured images
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 800, 450, true );
    add_image_size( 'featured-card', 600, 340, true );

    // Custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 200,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // HTML5 support
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ) );

    // Block editor
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );

    // Register nav menus
    register_nav_menus( array(
        'primary'   => __( 'Primary Navigation', 'itsmeduncan' ),
        'footer'    => __( 'Footer Navigation', 'itsmeduncan' ),
        'social'    => __( 'Social Links', 'itsmeduncan' ),
    ) );
}
add_action( 'after_setup_theme', 'itsmeduncan_setup' );

/* ------------------------------------------
   ENQUEUE STYLES & SCRIPTS
   ------------------------------------------ */
function itsmeduncan_scripts() {
    // Google Fonts: DM Sans + IBM Plex Sans
    wp_enqueue_style(
        'itsmeduncan-fonts',
        'https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,400&family=IBM+Plex+Sans:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // Theme stylesheet
    wp_enqueue_style(
        'itsmeduncan-style',
        get_stylesheet_uri(),
        array( 'itsmeduncan-fonts' ),
        wp_get_theme()->get( 'Version' )
    );

    // Mobile nav JS
    wp_enqueue_script(
        'itsmeduncan-nav',
        get_template_directory_uri() . '/assets/js/navigation.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'itsmeduncan_scripts' );

/* ------------------------------------------
   CONTENT WIDTH
   ------------------------------------------ */
function itsmeduncan_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'itsmeduncan_content_width', 720 );
}
add_action( 'after_setup_theme', 'itsmeduncan_content_width', 0 );

/* ------------------------------------------
   WIDGETS
   ------------------------------------------ */
function itsmeduncan_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', 'itsmeduncan' ),
        'id'            => 'footer-widget',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'itsmeduncan_widgets_init' );

/* ------------------------------------------
   CUSTOMIZER SETTINGS
   ------------------------------------------ */
function itsmeduncan_customize_register( $wp_customize ) {

    // --- Hero Section ---
    $wp_customize->add_section( 'itsmeduncan_hero', array(
        'title'    => __( 'Homepage Hero', 'itsmeduncan' ),
        'priority' => 30,
    ) );

    // Hero badge text
    $wp_customize->add_setting( 'hero_badge', array(
        'default'           => 'Chief AI Officer · BuildOps',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_badge', array(
        'label'   => __( 'Hero Badge Text', 'itsmeduncan' ),
        'section' => 'itsmeduncan_hero',
        'type'    => 'text',
    ) );

    // Hero headline
    $wp_customize->add_setting( 'hero_headline', array(
        'default'           => 'Building AI-powered teams that scale.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_headline', array(
        'label'   => __( 'Hero Headline', 'itsmeduncan' ),
        'section' => 'itsmeduncan_hero',
        'type'    => 'text',
    ) );

    // Hero description
    $wp_customize->add_setting( 'hero_description', array(
        'default'           => 'Former CTO at Weedmaps (scaled 30→300+ engineers through IPO) and ShopKeep ($550M exit). Writing weekly about AI implementation, engineering leadership, and what it takes to build at scale.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'hero_description', array(
        'label'   => __( 'Hero Description', 'itsmeduncan' ),
        'section' => 'itsmeduncan_hero',
        'type'    => 'textarea',
    ) );

    // Hero photo
    $wp_customize->add_setting( 'hero_photo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_photo', array(
        'label'   => __( 'Hero Photo', 'itsmeduncan' ),
        'section' => 'itsmeduncan_hero',
    ) ) );

    // --- Email Capture ---
    $wp_customize->add_section( 'itsmeduncan_email', array(
        'title'    => __( 'Email Capture', 'itsmeduncan' ),
        'priority' => 35,
    ) );

    // Email CTA text
    $wp_customize->add_setting( 'email_cta_text', array(
        'default'           => 'Weekly insights on AI leadership — no spam, just the ideas I\'m working through.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'email_cta_text', array(
        'label'   => __( 'Email CTA Text', 'itsmeduncan' ),
        'section' => 'itsmeduncan_email',
        'type'    => 'text',
    ) );

    // Email form action URL (Beehiiv, ConvertKit, etc.)
    $wp_customize->add_setting( 'email_form_action', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'email_form_action', array(
        'label'       => __( 'Email Form Action URL', 'itsmeduncan' ),
        'description' => __( 'Paste your Beehiiv/ConvertKit/Substack embed form action URL here.', 'itsmeduncan' ),
        'section'     => 'itsmeduncan_email',
        'type'        => 'url',
    ) );

    // Custom email embed HTML (overrides form if set)
    $wp_customize->add_setting( 'email_embed_html', array(
        'default'           => '',
        'sanitize_callback' => 'itsmeduncan_sanitize_html',
    ) );
    $wp_customize->add_control( 'email_embed_html', array(
        'label'       => __( 'Email Embed HTML (optional)', 'itsmeduncan' ),
        'description' => __( 'Paste your full email provider embed code here. This overrides the built-in form.', 'itsmeduncan' ),
        'section'     => 'itsmeduncan_email',
        'type'        => 'textarea',
    ) );

    // --- Social Links ---
    $wp_customize->add_section( 'itsmeduncan_social', array(
        'title'    => __( 'Social Links', 'itsmeduncan' ),
        'priority' => 40,
    ) );

    $social_links = array( 'linkedin' => 'LinkedIn URL', 'github' => 'GitHub URL', 'twitter' => 'Twitter/X URL' );

    foreach ( $social_links as $key => $label ) {
        $wp_customize->add_setting( "social_{$key}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "social_{$key}", array(
            'label'   => __( $label, 'itsmeduncan' ),
            'section' => 'itsmeduncan_social',
            'type'    => 'url',
        ) );
    }

    // --- Featured Posts ---
    $wp_customize->add_section( 'itsmeduncan_featured', array(
        'title'       => __( 'Featured Posts', 'itsmeduncan' ),
        'description' => __( 'Enter comma-separated post IDs to feature on the homepage. Leave blank to auto-select sticky posts or most recent.', 'itsmeduncan' ),
        'priority'    => 36,
    ) );

    $wp_customize->add_setting( 'featured_post_ids', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'featured_post_ids', array(
        'label'   => __( 'Featured Post IDs', 'itsmeduncan' ),
        'section' => 'itsmeduncan_featured',
        'type'    => 'text',
    ) );

    // --- Author Card ---
    $wp_customize->add_section( 'itsmeduncan_author', array(
        'title'    => __( 'Author Bio Card', 'itsmeduncan' ),
        'priority' => 37,
    ) );

    $wp_customize->add_setting( 'author_bio_short', array(
        'default'           => 'Chief AI Officer at BuildOps ($1B unicorn). Scaled Weedmaps 30→300+ engineers through IPO. Writes weekly about AI & leadership.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'author_bio_short', array(
        'label'   => __( 'Short Author Bio', 'itsmeduncan' ),
        'section' => 'itsmeduncan_author',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'author_photo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'author_photo', array(
        'label'   => __( 'Author Photo', 'itsmeduncan' ),
        'section' => 'itsmeduncan_author',
    ) ) );
}
add_action( 'customize_register', 'itsmeduncan_customize_register' );

// Allow basic HTML in email embed
function itsmeduncan_sanitize_html( $input ) {
    return wp_kses( $input, array(
        'form'   => array( 'action' => array(), 'method' => array(), 'class' => array(), 'id' => array(), 'target' => array() ),
        'input'  => array( 'type' => array(), 'name' => array(), 'value' => array(), 'placeholder' => array(), 'class' => array(), 'id' => array(), 'required' => array() ),
        'button' => array( 'type' => array(), 'class' => array(), 'id' => array() ),
        'div'    => array( 'class' => array(), 'id' => array(), 'style' => array() ),
        'label'  => array( 'for' => array(), 'class' => array() ),
        'span'   => array( 'class' => array() ),
        'p'      => array( 'class' => array() ),
        'iframe' => array( 'src' => array(), 'width' => array(), 'height' => array(), 'style' => array(), 'frameborder' => array() ),
        'script' => array( 'src' => array(), 'async' => array(), 'defer' => array() ),
    ) );
}

/* ------------------------------------------
   HELPER: READING TIME
   ------------------------------------------ */
function itsmeduncan_reading_time( $post_id = null ) {
    if ( ! $post_id ) $post_id = get_the_ID();
    $content    = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( strip_tags( $content ) );
    $minutes    = max( 1, ceil( $word_count / 250 ) );
    return $minutes . ' min read';
}

/* ------------------------------------------
   HELPER: EMAIL CAPTURE FORM
   ------------------------------------------ */
function itsmeduncan_email_form( $variant = 'dark', $show_label = true ) {
    $embed_html  = get_theme_mod( 'email_embed_html', '' );
    $cta_text    = get_theme_mod( 'email_cta_text', 'Weekly insights on AI leadership — no spam, just the ideas I\'m working through.' );
    $form_action = get_theme_mod( 'email_form_action', '' );

    $class = ( $variant === 'light' ) ? 'email-capture email-capture--light' : 'email-capture';

    echo '<div class="' . esc_attr( $class ) . '">';

    if ( $show_label && $cta_text ) {
        echo '<p class="email-capture-label">' . esc_html( $cta_text ) . '</p>';
    }

    if ( $embed_html ) {
        echo $embed_html; // Already sanitized by customizer
    } elseif ( $form_action ) {
        $form_id = 'ck-' . wp_unique_id();
        $iframe_id = $form_id . '-frame';
        echo '<iframe name="' . esc_attr( $iframe_id ) . '" style="display:none"></iframe>';
        echo '<form class="email-capture-form" id="' . esc_attr( $form_id ) . '" action="' . esc_url( $form_action ) . '" method="post" target="' . esc_attr( $iframe_id ) . '">';
        echo '<input type="email" name="email_address" placeholder="you@company.com" required>';
        echo '<button type="submit" class="btn-subscribe">' . esc_html__( 'Subscribe', 'itsmeduncan' ) . '</button>';
        echo '</form>';
        echo '<script>'
            . 'document.getElementById("' . esc_js( $form_id ) . '").addEventListener("submit",function(){'
            . 'var f=this,b=f.querySelector(".btn-subscribe");'
            . 'b.textContent="Sending…";b.disabled=true;'
            . 'setTimeout(function(){'
            . 'f.innerHTML="<p class=\"email-capture-label\" style=\"margin:0;color:var(--accent);font-weight:600\">You\'re in! Check your email to confirm.</p>";'
            . '},1500);'
            . '});</script>';
    } else {
        // Use Jetpack subscription form if available
        if ( shortcode_exists( 'jetpack_subscription_form' ) ) {
            echo '<div class="jetpack-subscribe-wrap">';
            echo do_shortcode( '[jetpack_subscription_form show_subscribers_total="false" button_on_newline="false" submit_button_text="Subscribe" show_only_email_and_button="true" custom_font_size="14px"]' );
            echo '</div>';
        } else {
            echo '<form class="email-capture-form" action="#" method="post">';
            echo '<input type="email" name="email" placeholder="you@company.com" required>';
            echo '<button type="submit" class="btn-subscribe">' . esc_html__( 'Subscribe', 'itsmeduncan' ) . '</button>';
            echo '</form>';
        }
    }

    echo '</div>';
}

/* ------------------------------------------
   HELPER: CATEGORY BADGE
   ------------------------------------------ */
function itsmeduncan_category_badge( $post_id = null, $linked = true ) {
    if ( ! $post_id ) $post_id = get_the_ID();
    $categories = get_the_category( $post_id );
    if ( empty( $categories ) ) return;

    // When a post has multiple categories, prefer the most specific one
    // (skip AI & Implementation if there's a more specific category)
    $cat = $categories[0];
    if ( count( $categories ) > 1 ) {
        foreach ( $categories as $c ) {
            if ( $c->slug !== 'ai-and-implementation' ) {
                $cat = $c;
                break;
            }
        }
    }
    $slug = $cat->slug;
    $class = 'category-badge';

    // Map categories to color variants
    if ( strpos( $slug, 'leadership' ) !== false ) {
        $class .= ' category-badge--leadership';
    } elseif ( strpos( $slug, 'software-craft' ) !== false ) {
        $class .= ' category-badge--insights';
    } elseif ( strpos( $slug, 'building-in-public' ) !== false ) {
        $class .= ' category-badge--founder';
    }

    if ( $linked ) {
        echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="' . esc_attr( $class ) . '">';
        echo esc_html( $cat->name );
        echo '</a>';
    } else {
        echo '<span class="' . esc_attr( $class ) . '">' . esc_html( $cat->name ) . '</span>';
    }
}

/* ------------------------------------------
   HELPER: GET FEATURED POSTS
   ------------------------------------------ */
function itsmeduncan_get_featured_posts( $count = 4 ) {
    $ids_string = get_theme_mod( 'featured_post_ids', '' );

    if ( $ids_string ) {
        $ids = array_map( 'absint', array_filter( explode( ',', $ids_string ) ) );
        if ( ! empty( $ids ) ) {
            return new WP_Query( array(
                'post__in'       => $ids,
                'orderby'        => 'post__in',
                'posts_per_page' => $count,
                'post_type'      => 'post',
            ) );
        }
    }

    // Fallback: sticky posts, then most recent
    $sticky = get_option( 'sticky_posts' );
    if ( ! empty( $sticky ) ) {
        return new WP_Query( array(
            'post__in'       => array_slice( $sticky, 0, $count ),
            'posts_per_page' => $count,
            'post_type'      => 'post',
        ) );
    }

    return new WP_Query( array(
        'posts_per_page' => $count,
        'post_type'      => 'post',
    ) );
}

/* ------------------------------------------
   REDIRECTS
   ------------------------------------------ */
function itsmeduncan_redirects() {
    $path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );

    // /page/N/ → /blog/ (old homepage pagination)
    if ( preg_match( '#^page/\d+/?$#', $path ) ) {
        wp_redirect( home_url( '/blog/' ), 301 );
        exit;
    }

    // Old /contact/ → About page
    if ( preg_match( '#^contact/?$#i', $path ) ) {
        wp_redirect( home_url( '/about-duncan-grazier/' ), 301 );
        exit;
    }

    // Old /category/leadership/ → /category/engineering-leadership/
    if ( is_category( 'leadership' ) ) {
        wp_redirect( home_url( '/category/engineering-leadership/' ), 301 );
        exit;
    }
}
add_action( 'template_redirect', 'itsmeduncan_redirects' );

/* ------------------------------------------
   EXCERPT LENGTH
   ------------------------------------------ */
function itsmeduncan_excerpt_length( $length ) {
    return 28;
}
add_filter( 'excerpt_length', 'itsmeduncan_excerpt_length' );

function itsmeduncan_excerpt_more( $more ) {
    return '…';
}
add_filter( 'excerpt_more', 'itsmeduncan_excerpt_more' );

/* ------------------------------------------
   DISABLE DEFAULT WORDPRESS EMOJI
   ------------------------------------------ */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/* ------------------------------------------
   FALLBACK MENUS
   ------------------------------------------ */
function itsmeduncan_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url( home_url( '/about-duncan-grazier/' ) ) . '">' . esc_html__( 'About', 'itsmeduncan' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/category/ai-and-implementation/' ) ) . '">' . esc_html__( 'AI & Implementation', 'itsmeduncan' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/category/engineering-leadership/' ) ) . '">' . esc_html__( 'Leadership', 'itsmeduncan' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/speaking-media/' ) ) . '">' . esc_html__( 'Speaking & Media', 'itsmeduncan' ) . '</a></li>';
    echo '<li class="menu-item-has-children"><a href="#">' . esc_html__( 'Projects', 'itsmeduncan' ) . '</a>';
    echo '<ul class="sub-menu">';
    echo '<li><a href="' . esc_url( home_url( '/slowdown/' ) ) . '">' . esc_html__( 'Slow Them Down', 'itsmeduncan' ) . '</a></li>';
    echo '</ul></li>';
    echo '</ul>';
}

function itsmeduncan_footer_fallback() {
    echo '<ul>';
    echo '<li><a href="' . esc_url( home_url( '/about-duncan-grazier/' ) ) . '">' . esc_html__( 'About', 'itsmeduncan' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/category/ai-and-implementation/' ) ) . '">' . esc_html__( 'AI & Implementation', 'itsmeduncan' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/category/engineering-leadership/' ) ) . '">' . esc_html__( 'Leadership', 'itsmeduncan' ) . '</a></li>';
    wp_list_pages( array( 'title_li' => '', 'depth' => 1 ) );
    echo '</ul>';
}

/* ------------------------------------------
   CONTENT FILTER: ADD IDs TO H2 TAGS
   ------------------------------------------ */
function itsmeduncan_add_heading_ids( $content ) {
    if ( ! is_singular( 'post' ) ) {
        return $content;
    }
    $content = preg_replace_callback( '/<h2([^>]*)>(.*?)<\/h2>/is', function( $matches ) {
        $attrs = $matches[1];
        $text  = $matches[2];
        $id    = sanitize_title( wp_strip_all_tags( $text ) );
        if ( strpos( $attrs, 'id=' ) !== false ) {
            return $matches[0];
        }
        return '<h2' . $attrs . ' id="' . esc_attr( $id ) . '">' . $text . '</h2>';
    }, $content );
    return $content;
}
add_filter( 'the_content', 'itsmeduncan_add_heading_ids', 5 );

/* ------------------------------------------
   CONTENT FILTER: MID-POST EMAIL CTA
   Injects email CTA after the 3rd <h2> tag
   ------------------------------------------ */
function itsmeduncan_inject_midpost_cta( $content ) {
    if ( ! is_singular( 'post' ) || is_admin() ) {
        return $content;
    }

    $h2_count = 0;
    $cta_inserted = false;

    ob_start();
    itsmeduncan_email_form( 'light', false );
    $form_html = ob_get_clean();

    $cta_html = '<div class="midpost-cta">'
        . '<p>' . esc_html__( 'Enjoying this? I write about AI implementation and engineering leadership every week.', 'itsmeduncan' ) . '</p>'
        . $form_html
        . '</div>';

    $content = preg_replace_callback( '/<h2/i', function( $matches ) use ( &$h2_count, &$cta_inserted, $cta_html ) {
        $h2_count++;
        if ( $h2_count === 3 && ! $cta_inserted ) {
            $cta_inserted = true;
            return $cta_html . $matches[0];
        }
        return $matches[0];
    }, $content );

    return $content;
}
add_filter( 'the_content', 'itsmeduncan_inject_midpost_cta', 10 );

/* ------------------------------------------
   HELPER: TABLE OF CONTENTS
   Generates a TOC from H2 headings
   ------------------------------------------ */
function itsmeduncan_table_of_contents( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    $content = get_post_field( 'post_content', $post_id );

    preg_match_all( '/<h2[^>]*>(.*?)<\/h2>/is', $content, $matches );

    if ( empty( $matches[0] ) || count( $matches[0] ) < 2 ) {
        return '';
    }

    $output = '<details class="post-toc" open>';
    $output .= '<summary class="post-toc-title">' . esc_html__( 'Table of Contents', 'itsmeduncan' ) . '</summary>';
    $output .= '<ol class="post-toc-list">';

    foreach ( $matches[1] as $raw_text ) {
        $text = wp_strip_all_tags( $raw_text );
        $id   = sanitize_title( $text );
        $output .= '<li><a href="#' . esc_attr( $id ) . '">' . esc_html( $text ) . '</a></li>';
    }

    $output .= '</ol></details>';
    return $output;
}

/* ------------------------------------------
   HELPER: RELATED POSTS
   ------------------------------------------ */
function itsmeduncan_related_posts( $post_id = null, $count = 3 ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    $categories = get_the_category( $post_id );
    if ( empty( $categories ) ) {
        return null;
    }

    return new WP_Query( array(
        'posts_per_page' => $count,
        'post_type'      => 'post',
        'post__not_in'   => array( $post_id ),
        'cat'            => $categories[0]->term_id,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
}

/* ------------------------------------------
   HELPER: SOCIAL SHARE BUTTONS
   ------------------------------------------ */
function itsmeduncan_share_buttons() {
    $url   = rawurlencode( get_permalink() );
    $title = rawurlencode( get_the_title() );

    $linkedin_svg = '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>';
    $twitter_svg = '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>';
    $copy_svg = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>';

    echo '<div class="share-bar">';
    echo '<a href="https://www.linkedin.com/sharing/share-offsite/?url=' . esc_attr( $url ) . '" target="_blank" rel="noopener" class="share-btn share-btn--linkedin" aria-label="' . esc_attr__( 'Share on LinkedIn', 'itsmeduncan' ) . '">' . $linkedin_svg . '</a>';
    echo '<a href="https://twitter.com/intent/tweet?url=' . esc_attr( $url ) . '&text=' . esc_attr( $title ) . '" target="_blank" rel="noopener" class="share-btn share-btn--twitter" aria-label="' . esc_attr__( 'Share on Twitter', 'itsmeduncan' ) . '">' . $twitter_svg . '</a>';
    echo '<button class="share-btn share-btn--copy" onclick="navigator.clipboard.writeText(\'' . esc_js( get_permalink() ) . '\').then(function(){this.classList.add(\'copied\')}.bind(this))" aria-label="' . esc_attr__( 'Copy link', 'itsmeduncan' ) . '">' . $copy_svg . '</button>';
    echo '</div>';
}

/* ------------------------------------------
   XML SITEMAP PING ON PUBLISH
   ------------------------------------------ */
function itsmeduncan_ping_sitemap( $post_id ) {
    if ( wp_is_post_revision( $post_id ) || defined( 'DOING_AUTOSAVE' ) ) {
        return;
    }

    $sitemap_url = rawurlencode( home_url( '/sitemap.xml' ) );

    wp_remote_get( 'https://www.google.com/ping?sitemap=' . $sitemap_url, array( 'blocking' => false ) );
    wp_remote_get( 'https://www.bing.com/ping?sitemap=' . $sitemap_url, array( 'blocking' => false ) );
}
add_action( 'publish_post', 'itsmeduncan_ping_sitemap' );
