<?php

    // Добавим фильтр чтобы переопределить текущий шаблон темы для поля поиска по сайту

    add_filter('get_search_form', 'ba_search_form');
    function ba_search_form($form) {
        $form = '
            <form role="search" method="get" id="searchform" class="search for-form__form row align-items-center justify-content-between woocommerce-product-search ct-search-form" action="' . esc_url( home_url( '/' ) ) . '">  
                <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Найти..." class="for-form__input search-input">
                
                <button class="search-to-button hero-sidebar__find wp-element-button" aria-label="Найти" type="submit">Показать                               
                </button>               

                <div class="result-search">
                    <div class="preloader"><img src="' . get_stylesheet_directory_uri() . '/assets/img/loader.gif" class="loader" /></div>
                    <div class="result-search-list"></div>
                </div>
            </form>
            
        ';
        return $form;
    }


    // Сам обработчик поиска на сайте

    function ba_ajax_search(){
        $args = array(
            's' => $_POST['term'], 
            'post_type' => array('product'), // Указываем, в каких постах искать
            'posts_per_page' => 6,            
            'search_columns' => [ 'post_title' ]  // !!! Ищем только по заголовкам
        );
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) {
            while ($the_query->have_posts()) {
                $the_query->the_post();
    ?>
                <div class="result_item clear">
                    <?php
                        if(has_post_thumbnail()) {
                            the_post_thumbnail(array('class'=>'post_thumbnail'));
                        } else {
                    ?>
                        <div></div>
                    <?php } ?>
        			<div class="result-item__right">
        				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>		
        				<?php the_excerpt();?>
        			</div>
            </div>
    <?php
            }
        } else {
    ?>
        <div class="result_item">
            <span class="not_found">Ничего не найдено, попробуйте другой запрос</span>
        </div>
    <?php
        }
        exit;
    }
    add_action('wp_ajax_nopriv_ba_ajax_search','ba_ajax_search');
    add_action('wp_ajax_ba_ajax_search','ba_ajax_search');


    // Вывод постов на странице результатов поиска
    add_action( 'pre_get_posts', 'get_posts_search_filter' );
    function get_posts_search_filter( $query ){

        if ( ! is_admin() && $query->is_main_query() && $query->is_search ) {            
            $query->set( 'post_type', ['product'] );
            $query->set( 'search_columns', [ 'post_title' ] );
        }
        
    }