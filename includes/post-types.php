<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/* Регистрируем новый тип записей - Отзывы
-----------------------------------------------*/
add_action('init', 'reviews');
function reviews()
{
  $labels = array(
    'name' => 'Отзывы',
    'singular_name' => 'Отзыв',
    'add_new' => 'Добавить Отзыв',
    'add_new_item' => 'Добавить новый Отзыв',
    'edit_item' => 'Редактировать Отзыв',
    'new_item' => 'Новый Отзыв',
    'view_item' => 'Посмотреть Отзывы',
    'search_items' => 'Найти Отзывы',
    'not_found' =>  'Отзывы не найдено',
    'not_found_in_trash' => 'В корзине Отзывы не найдено',
    'parent_item_colon' => '',
    'menu_name' => 'Отзывы'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_icon' => 'dashicons-star-filled',
    'menu_position' => 5,
    'supports' => array('title','editor','thumbnail', 'excerpt'),	
  );
  register_post_type('reviews',$args);  
}


/* Регистрируем новый тип записей - Кейсы
-----------------------------------------------*/
add_action('init', 'keises');
function keises()
{
  $labels = array(
    'name' => 'Кейсы',
    'singular_name' => 'Кейс',
    'add_new' => 'Добавить Кейс',
    'add_new_item' => 'Добавить новый Кейс',
    'edit_item' => 'Редактировать Кейс',
    'new_item' => 'Новый Кейс',
    'view_item' => 'Посмотреть Кейсы',
    'search_items' => 'Найти Кейсы',
    'not_found' =>  'Кейсов не найдено',
    'not_found_in_trash' => 'В корзине Кейсов не найдено',
    'parent_item_colon' => '',
    'menu_name' => 'Кейсы'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_icon' => 'dashicons-buddicons-buddypress-logo',
    'menu_position' => 6,
    'supports' => array('title','editor','thumbnail', 'excerpt', 'custom-fields'),	
  );
  register_post_type('keises',$args);  
}


/* Регистрируем новый тип записей - Команда
-----------------------------------------------*/
add_action('init', 'team');
function team()
{
  $labels = array(
    'name' => 'Команда',
    'singular_name' => 'Сотрудник в команде',
    'add_new' => 'Добавить сотрудника',
    'add_new_item' => 'Добавить нового сотрудника',
    'edit_item' => 'Редактировать данные сотрудника',
    'new_item' => 'Новый сотрудник',
    'view_item' => 'Посмотреть данные сотрудника',
    'search_items' => 'Найти сотрудника',
    'not_found' =>  'Сотрудников не найдено',
    'not_found_in_trash' => 'В корзине данных не найдено',
    'parent_item_colon' => '',
    'menu_name' => 'Команда'
  );

  $args_team = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_icon' => 'dashicons-groups',
    'menu_position' => 7,
    'supports' => array('title', 'excerpt', 'thumbnail', 'custom-fields'),	
  );
  register_post_type('team',$args_team);  
}