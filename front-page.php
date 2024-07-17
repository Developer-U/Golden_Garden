<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Front-page
*/

get_header();

$tel = get_field('phone_link', 'options');
$phone_num = get_field('phone_num', 'options');
$address = get_field('address', 'options');
?>

<section class="main-hero">
    <div class="ct-container hero-slider__top">
        <?php
        if( $tel && $phone_num ): ?>			
            <a href="tel:+7<?php echo $tel; ?>" class="hero-slider__tel">
                <?php echo $phone_num; ?>
            </a>		
        <?php endif; 
        
        if($address) { ?>
            <a class="header-central__address d-lg-none" href="#" data-popup-open="map_popup">
                <?php echo $address; ?>
            </a>
        <?php } ?>

        <a href="#footer" class="button transparent-btn hero-slider__button1">
            Быстрый подбор объекта
        </a>
    </div>  

    <div class="swiper main-hero__slider hero-slider">
        <div class="swiper-wrapper">

            <?php if( have_rows('new_hero_slide') ): ?>
            <?php while( have_rows('new_hero_slide') ): the_row();
            $hero_slide_title = get_sub_field('hero_slide_title');     
            $hero_slide_image = get_sub_field('hero_slide_image');                                                    
            ?>

                <article class="swiper-slide hero-slider__slide"  style="<?php if( $hero_slide_image ): ?>background-image: url(<?php echo $hero_slide_image['url']; ?> ) <?php else: ?>background: #1C2540;<?php endif; ?>">
                    <div class="ct-container">
                        <div class="hero-slider__box hero-box">                           
                            <a class="button gold-btn" href="/quizle/podobrat-nedvizhimost/">
                                Подобрать недвижимость
                            </a>

                            <h2 class="hero-box__title">
                                <?php
                                if( $hero_slide_title ):		
                                    echo $hero_slide_title;	
                                endif; ?>
                            </h2>
                        </div>
                    </div>
                    
                </article>

            <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

<?php get_template_part( 'template-parts/about' ); ?>  

<?php get_template_part( 'template-parts/owner', 'speach' ); ?> 

<?php get_template_part( 'template-parts/top', 'objects' ); ?> 

<?php get_template_part( 'template-parts/object', 'week' ); ?> 

<?php get_template_part( 'template-parts/reviews', 'block' ); ?> 

<?php get_template_part( 'template-parts/keises', 'block' ); ?> 

<?php get_template_part( 'template-parts/work', 'levels' ); ?> 

<?php get_template_part( 'template-parts/map', 'block' ); ?> 

<?php
get_footer(); ?>
