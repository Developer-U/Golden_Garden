<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Navigations
*/

register_nav_menus( array(
    'primary' => 'Основное',   
));

function mytheme_primary_menu() {
    wp_nav_menu( [
        'theme_location'  => 'primary',
        'menu_id'         => 'primary-menu',
        'menu_class'      => 'popup-menu__menu'  
    ] );
}