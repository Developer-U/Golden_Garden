<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function register_my_sidebars() {
 
	/* Сайдбар для постов новостей */
	register_sidebar(
		array(
			'id' => 'posts-sidebar', // уникальный id
			'name' => 'Сайдбар постов', // название сайдбара
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание			
		)
	);

}
 
add_action( 'widgets_init', 'register_my_sidebars' );