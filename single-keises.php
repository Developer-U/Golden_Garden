<?php
/*
Template Name: Страница Кейсы
Template Post Type: keises
*/
get_header();

if (have_posts()) {
	the_post();
}

if (
	function_exists('blc_get_content_block_that_matches')
	&&
	blc_get_content_block_that_matches([
		'template_type' => 'single',
		'template_subtype' => 'canvas'
	])
) {
	echo blc_render_content_block(
		blc_get_content_block_that_matches([
			'template_type' => 'single',
			'template_subtype' => 'canvas'
		])
	);
	have_posts();
	wp_reset_query();
	return;
}
$post_id = get_the_ID();
$keis_image = get_field('keis_image', $post_id);
?>

    <section class="about-block keises ct-container dark">
        <div class="container">
            <div class="keises__links keises-links d-flex align-iyems-center justify-content-between mb-4 mb-lg-5">
                <a href="/#keises" class="keises-links__link">Назад к кейсам</a>

                <a href="/" class="keises-links__link text-right">На главную</a>
            </div>
            <div class="single-page d-flex gap-3 mb-5 flex-column flex-lg-row">
                <div class="sibgle-page__text col">
                    <h1 class="single-page__title col">
                        <?php the_title(); ?>
                    </h1>

                    <div class="single-page__excerpt">
                        <?php the_excerpt(); ?>
                    </div>                    
                </div>
                
                <?php
                if( $keis_image ) { ?>
                    <figure class="single-page__image" style="background: #3A4054;">
                        <img src="<?php echo $keis_image['url']; ?>" alt="<?php echo $keis_image['alt']; ?>">               
                    </figure>
                <?php } ?>
            </div>

            <div class="single-page__content">
                <?php the_content(); ?>
            </div>
            
            <div class="post-nav">
                <?php
                the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle prev">' . esc_html__( '←', 'estore' ) . '</span> <span class="nav-title"></span>',
						'next_text' => '<span class="nav-title"></span> <span class="nav-subtitle next">' . esc_html__( '→', 'estore' ) . '</span>',
					)
				);
                ?>
            </div>            
        </div>
    </section>

<?php
have_posts();
wp_reset_query();

get_footer('light');