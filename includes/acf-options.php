<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * ACF Options
*/

// Добавим Страницу опций на ACF PRO options_theme

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Основная информация',
		'menu_title'	=> 'Основная информация',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Идентичные блоки',
		'menu_title'	=> 'Идентичные блоки',
		'icon_url' => 'dashicons-table-col-after',
		'menu_slug'	=> 'theme-general-blocks',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}