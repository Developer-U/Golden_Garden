<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Displaying content of One item By List: Blog item etc.
*/ 
?>

    <li class="blog-item blog-item__wrapper spisok-item">
        <div class="spisok-item__top d-flex gap-3 justify-content-between">
            <h3 class="blog-top__title blog-top__title_spisok col">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3> 

            <div class="spisok-item__right col-auto">
                <span><?php echo get_the_date(); ?></span>

                <button class="button blog-btn col-auto"><?php the_category(', '); ?></button>
            </div>
        </div>

        <div class="spisok-wrapper d-grid">
            <div class="spisok-wrapper__left d-flex flex-column justify-content-between">
                <?php
                $thecontent = get_the_content(); 
                    echo wp_trim_words( $thecontent, 30);    
                ?>  
                
                <a href="<?php the_permalink(); ?>" class="button gold-btn">Подробнее</a> 
            </div>   

            <figure class="spisok-wrapper__image">
                <?php if( has_post_thumbnail()) {
                    the_post_thumbnail('large'); 
                } ?>                            
            </figure>
        </div>                               
    </li>