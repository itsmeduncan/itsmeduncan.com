/**
 * ItsMeDuncan - Navigation
 * Mobile menu toggle
 */
document.addEventListener( 'DOMContentLoaded', function() {
    var toggle = document.querySelector( '.nav-toggle' );
    var menu   = document.querySelector( '.nav-menu' );

    if ( ! toggle || ! menu ) return;

    toggle.addEventListener( 'click', function() {
        var expanded = toggle.getAttribute( 'aria-expanded' ) === 'true';
        toggle.setAttribute( 'aria-expanded', ! expanded );
        menu.classList.toggle( 'active' );
    });

    // Close menu when clicking a link (mobile)
    var links = menu.querySelectorAll( 'a' );
    links.forEach( function( link ) {
        link.addEventListener( 'click', function() {
            menu.classList.remove( 'active' );
            toggle.setAttribute( 'aria-expanded', 'false' );
        });
    });

    // Close menu on outside click
    document.addEventListener( 'click', function( e ) {
        if ( ! toggle.contains( e.target ) && ! menu.contains( e.target ) ) {
            menu.classList.remove( 'active' );
            toggle.setAttribute( 'aria-expanded', 'false' );
        }
    });
});
