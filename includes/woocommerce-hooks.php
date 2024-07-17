<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Woocommerce hoocks
 */

/* ------------Archive product----------------*/

// Поиск по объектам для страниц категорий 
add_action('woocommerce_before_shop_loop', 'add_search_product_form', 5);
function add_search_product_form()
{
    if (!is_shop()) {
        get_search_form();
    }
}

// Удаляем со страницы каталога дефолтный вывод категорий
add_action('woocommerce_before_shop_loop', 'delete_shop_categories_start', 5);

function delete_shop_categories_start()
{
    if (is_shop()) {
        echo '<div style="display: none">';
    }
}

add_action('woocommerce_after_shop_loop', 'delete_shop_categories_end', 20);

function delete_shop_categories_end()
{
    if (is_shop()) {
        echo '</div>';
    }
}

function add_cat_list()
{
    $taxonomy = 'product_cat';
    $empty = 0;
    $args = array(
        'taxonomy' => $taxonomy,
        'hide_empty' => $empty,
        'limit' => 99,
    );
    $all_categories = get_categories($args); ?>

    <ul data-products="type-1" class="products columns-2 cat-list">

        <?php
        foreach ($all_categories as $cat) {
            $category_id = $cat->term_id;
            $thumbnail_id = get_woocommerce_term_meta($category_id, 'thumbnail_id', true);
            $cat_image = wp_get_attachment_url($thumbnail_id);
            ?>

            <li class="woo cat_item">
                <figure>
                    <a class="ct-media-container cat_item__image" href="<?php echo get_term_link($cat); ?>"
                        aria-label="<?php echo $cat->name; ?>">
                        <img src="<?php echo $cat_image; ?>" />
                    </a>
                </figure>
                <div class="product-card__wrapper cat_item__wrapper">
                    <div class="cat-item__top">
                        <h2 class="woocommerce-loop-product__title cat_item__title">
                            <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link"
                                href="<?php echo get_term_link($cat); ?>">
                                <?php echo $cat->name; ?>
                            </a>
                        </h2>

                        <div class="cat_item__description post"><?php echo $cat->description; ?></div>
                    </div>

                    <a href="<?php echo get_term_link($cat); ?>" class="button transparent-btn cat_item__button">
                        Смотреть объекты
                    </a>
                </div>
            </li>

        <?php } ?>
    </ul>
<?php }

//Добавляем кастомный вывод категорий на странице каталога
add_action('woocommerce_before_shop_loop', 'add_new_categories_list', 2);

function add_new_categories_list()
{
    if (is_shop()) {
        // echo do_shortcode('[product_categories columns="2" parent="0"]');
        echo add_cat_list();
    }
}

// Добавим обёртку в карточку товара в листинге после заголовка
add_action('woocommerce_before_shop_loop_item_title', 'start_div_before_title', 5);

function start_div_before_title()
{
    echo '<div class="product-card__wrapper">';
}

add_action('woocommerce_after_shop_loop_item', 'end_div_before_title', 20);

function end_div_before_title()
{
    echo '</div>';
}

// Добавим в карточку в листинге краткие характеристики - поля ACF
add_action('woocommerce_after_shop_loop_item_title', 'add_excerpt_product', 5);

function add_excerpt_product()
{
    if (have_rows('add_param_block')):
        ?>
        <table>

            <?php
            if (have_rows('add_param_block')):
                while (have_rows('add_param_block')):
                    the_row();
                    $param_block_key = get_sub_field('param_block_key');
                    $param_block_value = get_sub_field('param_block_value');
                    ?>

                    <tr>
                        <td><?php echo $param_block_key; ?></td>
                        <td><?php echo $param_block_value; ?></td>
                    </tr>

                <?php endwhile; ?>
            <?php endif; ?>

        </table>
    <?php endif;
}

// Добавим в карточку в листинге подробное описание объекта
add_action('woocommerce_after_shop_loop_item_title', 'add_content_product', 10);

function add_content_product()
{
    if (get_the_content()):
        ?>
        <div class="product-content-hidden">
            <?php
            $content = get_the_content(); // Изначальный текст   
            $new_content = wp_trim_words($content, 50);
            echo $new_content;
            ?>

            <a href="<?php the_permalink(); ?>" class="button">Узнать больше</a>

            <?php if (!is_woocommerce()): ?>
                <!-- <a href="#" download class="button transparent-btn hero-slider__button1">
                    Скачать презентацию
                </a> -->
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php }

add_action('woocommerce_after_main_content', 'add_catalog_options_block', 20);

function add_catalog_options_block()
{
    if (is_shop() || is_product()) {
        get_template_part('template-parts/how', 'see');
    }
}

/**
 * Вывод в листинге ярлычка "ТОП", если задан атрибут "ТОПовый товар" в админке
 * 
 */

add_action('woocommerce_before_shop_loop_item', 'add_attribute_top', 10);
function add_attribute_top()
{
    // global $product;
    // if( $product->get_attribute('bestsellers') === 'да') {
    //     echo '<div class="product-top__wrapper"><p class="product-top__title">';
    //     echo 'ТОП';
    //     echo '</p></div>'; 
    // }
    $top_attr = get_field('top_attr');
    if ($top_attr === 'да') {
        echo '<div class="product-top__wrapper"><p class="product-top__title">';
        echo 'ТОП';
        echo '</p></div>';
    }
}

/**
 * Функция удаления некоторых параметров сортировки
 */

add_filter('woocommerce_catalog_orderby', 'in_woocommerce_catalog_orderby');

function in_woocommerce_catalog_orderby($args)
{
    unset($args['popularity']); // Удаляем сортировку по Популярности
    unset($args['rating']); // Удаляем сортировку по Рейтингу
    return $args;
}

/*
 * Функция добавления сортировки по алфавиту а также сортировки по кастомному ACF полю (ТОПовый объект)
 */

add_filter('woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_name_args');

function custom_woocommerce_get_catalog_ordering_name_args($args)
{
    $orderby_value = isset($_GET['orderby']) ? wc_clean($_GET['orderby']) : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));
    if ('name_list' == $orderby_value) {
        $args['orderby'] = 'title';
        $args['order'] = 'ASC';
        $args['meta_key'] = '';
    }

    if ('attr_list' == $orderby_value) {
        $args['orderby'] = 'meta_value';
        $args['order'] = 'ASC';
        $args['meta_key'] = 'top_attr';
    }

    return $args;

}
;

// Применяем новую сортировку
add_filter('woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_name_orderby');
add_filter('woocommerce_catalog_orderby', 'custom_woocommerce_catalog_name_orderby', 1);

function custom_woocommerce_catalog_name_orderby($sortby)
{
    $sortby['name_list'] = 'По названию от А до Я';
    $sortby['attr_list'] = 'Сначала ТОП';
    return $sortby;
}
;


/* ------------Archive product end----------------*/


/* ------------Single product----------------*/

/**
 * Хуки удаления в карточке товара формы добавить в корзину
 */
add_action('woocommerce_before_add_to_cart_form', 'delete_cart_form_start', 5);
function delete_cart_form_start()
{
    echo '<div style="display:none">';
}

add_action('woocommerce_after_add_to_cart_form', 'delete_cart_form_end', 30);
function delete_cart_form_end()
{
    echo '</div>';
}

// Выведем цену объекта только для объекта вторички
add_action('woocommerce_single_product_summary', 'add_object_price', 5);

function add_object_price()
{
    $object_price = get_field('object_price');
    if ($object_price) {
        echo '<h2 class="object-price">' . $object_price . '&nbsp;₽</h2>';
    }
}


//Удалим вкладку "Описание", так как мы вывели описание в правой части карточки
//Удалим вкладку "Отзывы"
add_filter('woocommerce_product_tabs', 'my_remove_product_tabs', 99);
function my_remove_product_tabs($tabs)
{
    unset($tabs['description']); // Удаление вкладки Описание
    unset($tabs['reviews']); // Удаление вкладки Отзывы

    if (has_term('secondary_housing', 'product_cat')) { // Если это товар категории "Готовое жильё" - удалим вкладку Описание
        unset($tabs['additional_information']);
    }
    return $tabs;

}

// Переименуем вкладки
add_filter('woocommerce_product_tabs', 'my_rename_tabs', 98);
function my_rename_tabs($tabs)
{
    if (has_term('new_buildings', 'product_cat')) {
        $tabs['additional_information']['title'] = 'Преимущества объекта'; // Переименование вкладки Детали
    }
    return $tabs;
}

// Функция добавления вкладок в карточке товара
function add_tab_configurations($tabs_objects)
{
    if (has_term('secondary_housing', 'product_cat')) { // Только для категории "Готовое жильё"
        $tabs_objects['tab_object_params'] = array(
            'title' => 'Характеристики объекта',
            'priority' => 5,
            'callback' => 'child_new_tab_configurations'
        );
    }

    if (has_term('secondary_housing', 'product_cat')) { // Только для категории "Готовое жильё"
        $tabs_objects['tab_object_gallery'] = array(
            'title' => 'Фотогалерея',
            'priority' => 10,
            'callback' => 'child_new_tab_configurations'
        );
    }

    if (get_field('product_video') || get_field('product_video_link')) {  // Видео
        $tabs_objects['tab_video'] = array(
            'title' => 'Видео',
            'priority' => 40,
            'callback' => 'child_new_tab_configurations'
        );
    }
    if (has_term('new_buildings', 'product_cat') && (have_rows('add_tab_presentations') || have_rows('add_tab_video_presentations'))) {  // Презентации
        $tabs_objects['presentations'] = array(
            'title' => 'Презентации',
            'priority' => 45,
            'callback' => 'child_new_tab_configurations'
        );
    }
    if (has_term('new_buildings', 'product_cat') && have_rows('add_tab_documents')) { // Документы
        $tabs_objects['documents'] = array(
            'title' => 'Документы',
            'priority' => 50,
            'callback' => 'child_new_tab_configurations'
        );
    }
    if (have_rows('add_tab_configurations')) {  // Планировки        
        $tabs_objects['configurations'] = array(
            'title' => 'Планировки',
            'priority' => 55,
            'callback' => 'child_new_tab_configurations'
        );
    }
    if (has_term('new_buildings', 'product_cat') && have_rows('add_tab_floor_plans')) {  // Поэтажные планы        
        $tabs_objects['floor_plans'] = array(
            'title' => 'Поэтажные планы',
            'priority' => 60,
            'callback' => 'child_new_tab_configurations'
        );
    }
    if (has_term('new_buildings', 'product_cat') && have_rows('add_tab_enter_group')) {  // Входная группа       
        $tabs_objects['enter_group'] = array(
            'title' => 'Входная группа',
            'priority' => 65,
            'callback' => 'child_new_tab_configurations'
        );
    }
    if (have_rows('add_tab_fasad')) {  // Фасад       
        $tabs_objects['fasad'] = array(
            'title' => 'Фасад',
            'priority' => 67,
            'callback' => 'child_new_tab_configurations'
        );
    }
    if (has_term('new_buildings', 'product_cat') && (have_rows('add_tab_blago') || have_rows('add_tab_video_blago'))) {  // Благоустройство       
        $tabs_objects['blago'] = array(
            'title' => 'Благоустройство',
            'priority' => 69,
            'callback' => 'child_new_tab_configurations'
        );
    }
    if (has_term('new_buildings', 'product_cat') && have_rows('add_tab_interior')) {  // Интерьер     
        $tabs_objects['interior'] = array(
            'title' => 'Интерьер',
            'priority' => 70,
            'callback' => 'child_new_tab_configurations'
        );
    }
    if (has_term('new_buildings', 'product_cat') && have_rows('add_tab_apparts')) {  // Аппартаменты    
        $tabs_objects['apparts'] = array(
            'title' => 'Аппартаменты',
            'priority' => 72,
            'callback' => 'child_new_tab_configurations'
        );
    }
    if (has_term('new_buildings', 'product_cat') && have_rows('add_tab_commercia')) {  // Коммерция     
        $tabs_objects['commercia'] = array(
            'title' => 'Коммерция',
            'priority' => 73,
            'callback' => 'child_new_tab_configurations'
        );
    }
    if (has_term('new_buildings', 'product_cat') && have_rows('add_tab_restraunt')) {  // Ресторан     
        $tabs_objects['restraunt'] = array(
            'title' => 'Ресторан',
            'priority' => 75,
            'callback' => 'child_new_tab_configurations'
        );
    }
    return $tabs_objects;

}

add_filter('woocommerce_product_tabs', 'add_tab_configurations', 40);

function addDocuments($tab_fields_postfix)
{
    ?>
    <ul class="product-tab__configurations tab-document-list d-grid gap-1 gap-sm-3">
        <?php
        if (have_rows('add_tab_' . $tab_fields_postfix)) {
            while (have_rows('add_tab_' . $tab_fields_postfix)) {
                the_row();

                $tab_image = get_sub_field('tab_' . $tab_fields_postfix . '_image');
                $tab_title = get_sub_field('tab_' . $tab_fields_postfix . '_title');
                $tab_file = get_sub_field('tab_' . $tab_fields_postfix . '_file');

                $tab_item_class = ($tab_image && $tab_image['type'] == 'image') ? 'tab-document-list__item tab-document-list__item_image' : 'tab-document-list__item';

                if ($tab_fields_postfix == 'configurations' || $tab_fields_postfix == 'enter_group' || $tab_fields_postfix == 'interior' || $tab_fields_postfix == 'restraunt' || $tab_fields_postfix == 'presentations' || $tab_fields_postfix == 'fasad' || $tab_fields_postfix == 'commercia' || $tab_fields_postfix == 'blago' || $tab_fields_postfix == 'apparts') {
                    ?>

                    <li class="<?php echo $tab_item_class ?>">
                        <?php


                        if ($tab_image['type'] === 'application') { ?>
                            <a class="tabs-document-list__link" href="<?php echo $tab_image['url']; ?>" target="_blank">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/file.svg" />
                            </a>
                        <?php } else { ?>
                            <a class="tabs-document-list__link tabs-document-list__link_image" href="<?php echo $tab_image['url']; ?>"
                                data-fancybox="<?php echo $tab_fields_postfix; ?>">
                                <img src="<?php echo $tab_image['url']; ?>" />
                            </a>
                        <?php } ?>

                        <h4 class="tabs-document-list__title tabs-document-list__title_configurations">
                            <?php echo $tab_title; ?>
                        </h4>
                    </li>

                <?php } elseif ($tab_fields_postfix == 'floor_plans' || $tab_fields_postfix == 'documents') {
                    ?>

                    <li class="tab-document-list__item">
                        <a class="tabs-document-list__link" href="<?php echo $tab_file; ?>" target="_blank">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/file.svg" />
                        </a>

                        <h4 class="tabs-document-list__title">
                            <?php echo $tab_title; ?>
                        </h4>
                    </li>

                <?php }
            }
        }
        ?>
    </ul>
    <?php
}

/**
 * Функция -колбэк для содержимого вкладок с идентичной вёрсткой
 */
function child_new_tab_configurations($tab_fields_postfix)
{
    ?>
    <div class="product-tab__content">
        <?php
        // Вёрстка таба "Характеристики объекта" только для категории "Готовое жильё"
        if ($tab_fields_postfix == 'tab_object_params' && has_term('secondary_housing', 'product_cat')) {
            $object_params = get_field('object_params');
            $building_params = get_field('building_params');
            ?>

            <article class="product-tab__block">
                <span class="product-tab__title">
                    <h3>Об объекте</h3>
                </span>

                <div class="object-params d-grid gap-2">
                    <table class="object-params__table object-params-table">
                        <tr>
                            <td class="object-params-table__key">Тип объекта</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($object_params['type']) {
                                    echo $object_params['type'];
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="object-params-table__key">Количество комнат</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($object_params['rooms_length']) {
                                    echo $object_params['rooms_length'] . '&nbsp;ком.';
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="object-params-table__key">Этаж</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($object_params['level_from'] && $object_params['level_to']) {
                                    echo $object_params['level_from'] . '&nbsp;из&nbsp;' . $object_params['level_to'];
                                } elseif ($object_params['level_from']) {
                                    echo $object_params['level_from'];
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="object-params-table__key">Отопление</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($object_params['heating']) {
                                    echo $object_params['heating'];
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="object-params-table__key">Балкон/лоджия</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($object_params['balcony']) {
                                    echo $object_params['balcony'];
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td class="object-params-table__key">Площадь общая</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($object_params['total_area']) {
                                    echo $object_params['total_area'] . '&nbsp;м²';
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="object-params-table__key">Площадь жилая</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($object_params['living_area']) {
                                    echo $object_params['living_area'] . '&nbsp;м²';
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="object-params-table__key">Высота потолков</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($object_params['ceiling_height']) {
                                    echo $object_params['ceiling_height'] . '&nbsp;м';
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="object-params-table__key">Санузел</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($object_params['bathroom']) {
                                    echo $object_params['bathroom'];
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td class="object-params-table__key">Планировка</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($object_params['configuration']) {
                                    echo $object_params['configuration'];
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="object-params-table__key">Вид из окон</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($object_params['view']) {
                                    echo $object_params['view'];
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="object-params-table__key">Ремонт</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($object_params['repair']) {
                                    echo $object_params['repair'];
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="object-params-table__key">Газ</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($object_params['gas']) {
                                    echo $object_params['gas'];
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </article>

            <article class="product-tab__block">
                <span class="product-tab__title">
                    <h3>О здании</h3>
                </span>

                <div class="object-params d-grid gap-2">
                    <table class="object-params__table object-params-table">
                        <tr>
                            <td class="object-params-table__key">Тип дома</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($building_params['type']) {
                                    echo $building_params['type'];
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="object-params-table__key">Лифт</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($building_params['elevator']) {
                                    echo $building_params['elevator'];
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="object-params-table__key">Год постройки</td>
                            <td class="object-params-table__value">
                                <?php
                                if ($building_params['build_year']) {
                                    echo $building_params['build_year'];
                                } else {
                                    echo '—';
                                } ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </article>
        <?php }

        // Вёрстка таба "Фотогалерея" только для категории "Готовое жильё"
        if ($tab_fields_postfix == 'tab_object_gallery' && has_term('secondary_housing', 'product_cat')) {
            ?>

            <ul class="product-tab__configurations tab-document-list d-grid gap-1 gap-sm-3">
                <?php
                if (have_rows('add_' . $tab_fields_postfix)) {
                    while (have_rows('add_' . $tab_fields_postfix)) {
                        the_row();
                        $tab_image = get_sub_field($tab_fields_postfix . '_image');
                        $tab_title = get_sub_field($tab_fields_postfix . '_title');
                        ?>

                        <li class="tab-document-list__item tab-document-list__item_image">
                            <a class="tabs-document-list__link tabs-document-list__link_image" href="<?php echo $tab_image['url']; ?>"
                                data-fancybox="<?php echo $tab_fields_postfix; ?>">
                                <img src="<?php echo $tab_image['url']; ?>" />
                            </a>
                            <h4 class="tabs-document-list__title">
                                <?php echo $tab_title; ?>
                            </h4>
                        </li>

                    <?php }
                } ?>
            </ul>
        <?php }

        if ($tab_fields_postfix == 'presentations' || $tab_fields_postfix == 'blago') { // Дополнительная проверка - если этот таб - презентации или благоустройство, то добавляем возможность подключать или видео или файлы
            $tab_content_type = get_field('tab_' . $tab_fields_postfix . '_content_type');

            if ($tab_content_type === 'видео') { ?>
                <div class="product-tab__videos tab-videos d-grid gap-3">
                    <?php
                    if (have_rows('add_tab_video_' . $tab_fields_postfix)) {
                        while (have_rows('add_tab_video_' . $tab_fields_postfix)) {
                            the_row();
                            $tab_video_link = get_sub_field('tab_' . $tab_fields_postfix . '_id'); ?>
                            <div class="youtube-player" data-id="<?php echo $tab_video_link; ?>"></div>
                            <?php

                        }
                    } ?>
                </div>
            <?php } else {
                addDocuments($tab_fields_postfix);
            }

        } else {
            addDocuments($tab_fields_postfix);
        }
        ?>
    </div>
    <?php

    if ($tab_fields_postfix == 'tab_video') {
        $product_video_type = get_field('product_video_type');
        $product_video = get_field('product_video');
        $product_video_link = get_field('product_video_link');
        ?>

        <div class="product-tab__content product-tab__video">
            <?php
            if ($product_video_type == 'файл' && $product_video) { ?>
                <video controls class="centered product-tab__file">
                    <source src="<?php echo esc_url($product_video['url']); ?>" type="video/webm" />

                    <source src="<?php echo esc_url($product_video['url']); ?>" type="video/mp4" />
                </video>

            <?php } else if ($product_video_type == 'ссылка' && $product_video_link) { ?>
                    <div class="youtube-player" data-id="<?php echo $product_video_link; ?>"></div>
            <?php } ?>
        </div>

    <?php }

}


/**
 * Подключаем блок с экпертом-куратором в карточку объекта после вкладок
 */
// add_action('woocommerce_after_single_product', 'add_expert_section', 10);
function add_expert_section()
{
    echo get_template_part('template-parts/expert', 'section');
}







