<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blocksy
 */

 get_header();

$prefix = blocksy_manager()->screen->get_prefix();

$maybe_custom_output = apply_filters(
	'blocksy:posts-listing:canvas:custom-output',
	null
);

if ($maybe_custom_output) {
	echo $maybe_custom_output;
	return;
}

$blog_post_structure = blocksy_listing_page_structure([
	'prefix' => $prefix
]);

$container_class = 'ct-container';

if ($blog_post_structure === 'gutenberg') {
	$container_class = 'ct-container-narrow';
}


/**
 * Note to code reviewers: This line doesn't need to be escaped.
 * Function blocksy_output_hero_section() used here escapes the value properly.
 */
echo blocksy_output_hero_section([
	'type' => 'type-2'
]);

$section_class = '';

if (! have_posts()) {
	$section_class = 'class="ct-no-results"';
}

$category_id = get_query_var( 'cat' ); 
$args= array(
	'posts_per_page' => 99,
	'post_type' => 'post',
	'orderby'  => 'date',
	'order' => 'DESC',
	'cat' => $category_id,
);

query_posts( $args );
?>

	<header class="archive">
		<div class="container">
			<h1 class="archive-title">
				<?php single_cat_title(  ); ?>
			</h1>

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
                    <li class="blog-tabs__item active col-auto"><a class="blog-type-list__item" href="/blog">Все</a></li>
                <?php
                foreach( $categories as $category ) {
                    
                    echo '<li class="blog-tabs__item col-auto "><a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a></li>';
                }
                echo '</ul>';
			} ?>
		</div>
	</header>

	<div class="about-block archive-main ct-container">
    	<div class="container">					
			

			<div class="blogtype js-plitka active" data-target="0">
				<ul data-products="type-1" class="products columns-3 blog">
	
					<?php
					if (have_posts() ) ?>
					<?php while ( have_posts() ) : the_post();                                    
					
					get_template_part( 'template-parts/item-content' );
					
					endwhile; wp_reset_query(); ?>                    

				</ul>
			</div>

			<div class="blogtype js-spisok" data-target="1">
				<ul data-products="type-1" class="blog__spisok blogtype js-spisok" data-target="1">

					<?php
					if (have_posts() ) ?>
					<?php while ( have_posts() ) : the_post();                                    
					
					get_template_part( 'template-parts/item-spisok' );
					
					endwhile; wp_reset_query(); ?>  

				</ul>
			</div>
		</div>
	</div>	

	<script>
		// Открытие табов с разделами и подразделами
		var pathNums = document.querySelectorAll('.blog-tabs__item a'); // все кнопки	

		var currentTitle = document.querySelector('.archive-title').innerText;

		console.log(currentTitle.toLowerCase());

		pathNums.forEach(function(pathBtn){ // Итерируем все кнопки
			console.log(pathBtn.innerHTML.toLowerCase());

			pathBtn.classList.remove('active');

			if( pathBtn.innerText.toLowerCase() == currentTitle.toLowerCase() ) {
				pathBtn.classList.add('active');
			} else {
				console.log('не совпало')
			}
		}); 
	
	</script>
		
<?php get_footer(); ?>
