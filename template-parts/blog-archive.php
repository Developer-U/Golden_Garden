<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Archive blog page
*/ 
?>

<section class="about-block ct-container">
    <div class="container">
        <div class="blog-type">
            <ul class="blog-type__list blog-type-list d-none d-md-flex justify-content-end">
                <li class="blog-type-list__item active col-auto d-grid align-items-center" data-path="0">
                    <span>плиткой</span>

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H6V6H0V0ZM9 0H15V6H9V0ZM24 0H18V6H24V0ZM9 9H15V15H9V9ZM6 9H0V15H6V9ZM18 9H24V15H18V9ZM15 18H9V24H15V18ZM0 18H6V24H0V18ZM24 18H18V24H24V18Z" fill="#1C2540"/>
                    </svg>
                </li>

                <li class="blog-type-list__item col-auto d-grid align-items-center" data-path="1">
                    <span>списком</span>

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H24V6H0V0ZM0 9H24V15H0V9ZM24 18H0V24H24V18Z" fill="#1C2540"/>
                    </svg>
                </li>
            </ul>            

            <?php           
            $arg_cat = array(                
                'orderby'      => 'name', // сортировка по названию
                'order'        => 'ASC', // сортировка от меньшего к большему
                'hide_empty'   => 1, // скрыть пустые рубрики
                'exclude'      => '', // id рубрики, которые надо исключить
                'include'      => '', // id рубрики, из которых надо выводить
                'taxonomy'     => 'category', // название таксономии
            );
            $categories = get_categories(  $arg_cat );

            if( $categories ){ ?>
                <ul class="blog__tabs blog-tabs row">
                    <li class="blog-tabs__item col-auto"><a class="active" href="/blog">Все</a></li>
                <?php
                foreach( $categories as $category ) {
                    
                    echo '<li class="blog-tabs__item col-auto"><a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a></li>';
                }
                echo '</ul>';

                $current = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
                $args= array(
                    'posts_per_page' => 4,
                    'post_type' => 'post',
                    'orderby'  => 'date',
                    'order' => 'DESC',
                    'paged' => $current,
                );
                
                $query = new WP_Query( $args);
                
                if ($query->have_posts() ) { ?>
               
                    <div class="blogtype js-plitka active" data-target="0">
                        <ul data-products="type-1" class="products columns-3 blog">
            
                            <?php
                            if ($query->have_posts() ) ?>
                            <?php while ( $query->have_posts() ) : $query->the_post();                                    
                            
                            get_template_part( 'template-parts/item-content' );
                            
                            endwhile; wp_reset_postdata()?>                    

                        </ul>
                    </div>

                    <div class="blogtype js-spisok" data-target="1">
                        <ul data-products="type-1" class="blog__spisok blogtype js-spisok" data-target="1">

                            <?php
                            if ($query->have_posts() ) ?>
                            <?php while ( $query->have_posts() ) : $query->the_post();                                    
                            
                            get_template_part( 'template-parts/item-spisok' );
                            
                            endwhile; wp_reset_postdata()?>  

                        </ul>
                    </div>

                <?php }
            }
            ?>
            
        </div>

        <?php
        echo paginate_links(
            array(
                'prev_next' => true, 
                'prev_text' => __( '&#8592;' ),
                'next_text' => __( '&#8594;' ),
                'end_size' => 2,
                'mid_size' => 2,
                'type' => 'list', 
                'base' => site_url() . '/blog/%_%',                                 
                'total' => $query->max_num_pages,
                'current' => $current
            )
        ); ?>
    </div>
</section>

<script>
    // Открытие табов с разделами и подразделами
    var pathNums = document.querySelectorAll('.blog-type-list__item'); // все кнопки
    
    var targetBlocks = document.querySelectorAll('.blogtype'); // все табы   
 

    pathNums.forEach(function(pathBtn){ // Итерируем все кнопки
        pathBtn.addEventListener('click', function(event){  
            event.preventDefault();

            var path = event.currentTarget.dataset.path; 

            pathNums.forEach(function(eachBtn){                           
                eachBtn.classList.remove('active'); // деактивировали каждый
            });

            var currentTypeBtn = document.querySelector(`[data-path="${path}"]`); 

            currentTypeBtn.classList.add('active');

            // Закинем в переменную текущий Таб с соответствующим атрибутом data-target       
            var currentTypeTab = document.querySelector(`[data-target="${path}"]`); 

            // Итерируем все Подразделы в контенте и все деактивируем                 
            targetBlocks.forEach(function(eachContent){                           
                eachContent.classList.remove('active'); // деактивировали каждый
            });

            currentTypeTab.classList.add('active');

                
        });
    }); 


  
</script>