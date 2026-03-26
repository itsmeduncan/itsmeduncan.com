    <!-- Bottom CTA -->
    <section class="section-bottom-cta">
        <div class="content-width">
            <h2>Don't miss the next one.</h2>
            <p>I publish every Tuesday — AI implementation, engineering leadership, and lessons from building at scale. Join the weekly email.</p>
            <?php itsmeduncan_email_form( 'light' ); ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="site-footer" role="contentinfo">
        <div class="footer-inner footer-inner--expanded">
            <div class="footer-brand">
                <div class="footer-brand-name"><?php bloginfo( 'name' ); ?></div>
                <p><?php echo esc_html( get_theme_mod( 'author_bio_short', 'Chief AI Officer at BuildOps. Writing about AI implementation, engineering leadership, and building at scale. Views are my own.' ) ); ?></p>
            </div>

            <div class="footer-nav">
                <div class="footer-nav-group">
                    <h4><?php esc_html_e( 'Pages', 'itsmeduncan' ); ?></h4>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => 'itsmeduncan_footer_fallback',
                    ) );
                    ?>
                </div>

                <div class="footer-nav-group">
                    <h4><?php esc_html_e( 'Categories', 'itsmeduncan' ); ?></h4>
                    <ul>
                        <?php
                        $categories = get_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => true ) );
                        foreach ( $categories as $cat ) :
                        ?>
                            <li><a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="footer-nav-group">
                    <h4><?php esc_html_e( 'Tags', 'itsmeduncan' ); ?></h4>
                    <ul>
                        <?php
                        $tags = get_tags( array( 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => true, 'number' => 10 ) );
                        foreach ( $tags as $tag ) :
                        ?>
                            <li><a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="footer-nav-group">
                    <h4><?php esc_html_e( 'Connect', 'itsmeduncan' ); ?></h4>
                    <ul>
                        <?php if ( $linkedin = get_theme_mod( 'social_linkedin' ) ) : ?>
                            <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener">LinkedIn</a></li>
                        <?php endif; ?>
                        <?php if ( $github = get_theme_mod( 'social_github' ) ) : ?>
                            <li><a href="<?php echo esc_url( $github ); ?>" target="_blank" rel="noopener">GitHub</a></li>
                        <?php endif; ?>
                        <?php if ( $twitter = get_theme_mod( 'social_twitter' ) ) : ?>
                            <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener">Twitter/X</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-inner">
                <span>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</span>
                <span class="footer-bottom-links">
                    <a href="<?php echo esc_url( home_url( '/sitemap.xml' ) ); ?>">Sitemap</a>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>">All Posts</a>
                </span>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
