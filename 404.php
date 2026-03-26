<?php
/**
 * 404 Template
 * @package ItsMeDuncan
 */
get_header();
?>

<div class="error-404">
    <h1>404</h1>
    <p><?php esc_html_e( 'This page doesn\'t exist. Maybe the post you\'re looking for has moved.', 'itsmeduncan' ); ?></p>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( '← Back to homepage', 'itsmeduncan' ); ?></a>
</div>

<?php get_footer(); ?>
