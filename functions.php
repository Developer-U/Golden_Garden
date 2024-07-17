<?php

if (! defined('WP_DEBUG')) {
	die( 'Direct access forbidden.' );
}
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/style.css' );
});

function my_change_submit_label($defaults) {
    // Текст перед формой комментирования
    $defaults['title_reply'] = 'Оставить комментарий';
    // Текст кнопки в форме комментирования
    $defaults['label_submit'] = 'Отправить';
    return $defaults;
}
add_filter( 'comment_form_defaults', 'my_change_submit_label' );

/**
 * Woocommerce hoocks
 */
require get_stylesheet_directory() . '/includes/woocommerce-hooks.php';

/**
 * ACF Options
 */
require get_stylesheet_directory() . '/includes/acf-options.php';

/**
 * Navigations
 */
require get_stylesheet_directory() . '/includes/navigations.php';

/**
 * Styles and scripts
 */
require get_stylesheet_directory() . '/includes/enqueue-script-style.php';

/**
 * Post types
 */
require get_stylesheet_directory() . '/includes/post-types.php';

/**
 * Duplicate posts
 */
require get_stylesheet_directory() . '/includes/duplicate-types.php';

/**
 * Sidebars
 */
require get_stylesheet_directory() . '/includes/sidebars.php';

/**
 * Search
 */
require get_stylesheet_directory() . '/includes/get-search.php';


