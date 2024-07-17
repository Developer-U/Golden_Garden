<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * JS & CSS
*/

add_action( 'wp_enqueue_scripts', 'estore_styles' );
function estore_styles() {
	wp_enqueue_style( 'estore-swiper', get_stylesheet_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), null, 'all');
	wp_enqueue_style( 'estore-bootstrap-style', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), null, 'all');
	wp_enqueue_style( 'estore-bootstrap-grid-style', get_stylesheet_directory_uri() . '/assets/css/bootstrap-grid.min.css', array(), null, 'all');	
	wp_enqueue_style( 'quizle_css', get_stylesheet_directory_uri() . '/assets/css/quizle.css', array(), null, 'all');	
	wp_enqueue_style( 'captcha_css', get_stylesheet_directory_uri() . '/assets/css/captcha.css', array(), null, 'all');	
	wp_enqueue_style( 'ajax_search_css', get_stylesheet_directory_uri() . '/assets/css/ajax-search.css', array(), null, 'all');	

	// wp_enqueue_style( 'simplebar-style', get_template_directory_uri() . '/assets/css/simplebar.css', array(), null, 'all');

	// wp_enqueue_style( 'estore-style-main', get_template_directory_uri() . '/assets/css/style.css', array('estore-bootstrap-style'), true);

	// wp_enqueue_style( 'estore-ajax', get_template_directory_uri() . '/assets/css/ajax.css', array('estore-bootstrap-style'), true);	
}

add_action( 'wp_enqueue_scripts', 'estore_scripts' );
function estore_scripts() {
    // wp_enqueue_script( 'estore-jquery-js', get_stylesheet_directory_uri() . '/assets/js/jquery.min.js', array(), '20151215', true );

	wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), true );
	wp_enqueue_script( 'swiper-bundle-js', get_stylesheet_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'estore-bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array(), null, 'all');
	wp_enqueue_script( 'estore-bootstrap-grid-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), null, 'all');
	wp_enqueue_script( 'inputmask-js', get_stylesheet_directory_uri() . '/assets/js/inputmask.js', array(), 'all', true );	
	wp_enqueue_script( 'quizle_js', get_stylesheet_directory_uri() . '/assets/js/quizle.js', array(), 'all', true );

	// Подключаем скрипт формы поиска на сайте

	wp_enqueue_script( 'estore-search', get_stylesheet_directory_uri() . '/assets/js/ajax-search.js', array(), '20151215', true );

	// Перед скриптом добавляем данные

	wp_localize_script( 'estore-search', 'search_form', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce('search-nonce')
	) );
    
}