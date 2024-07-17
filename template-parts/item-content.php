<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Displaying content of One item: Blog item etc.
*/ 
?>

    <li class="woo blog__item blog-item">
        <figure class="team-item__image">
            <?php if( has_post_thumbnail()) {
                the_post_thumbnail('large'); 
            } ?>                            
        </figure>

        <div class="blog-item__wrapper">
            <div class="blog-item__top blog-top">
                <div class="blog-top__box d-flex align-items-center justify-content-between gap-3">
                    <span class="col-auto"><?php echo get_the_date(); ?></span>

                    <button class="button blog-btn col-auto"><?php the_category(', '); ?></button>
                </div>

                <h3 class="blog-top__title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>  

                <div>
                    <?php
                    $thecontent = get_the_content(); 
                        echo wp_trim_words( $thecontent, 20);    
                    ?>                    
                </div>               
                
            </div>
            
            <a href="<?php the_permalink(); ?>"class="button gold-btn">Подробнее</a>                                    
        </div>                           
    </li>