<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Displaying Hero block for all pages
*/ 
$page_id = get_the_ID();

?>


    <section class="pages-hero pages-single position-relative" style="background-image:url( <?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?> );">
        <div class="pages-single__overlay"></div>
        <div class="ct-container hero-slider__top">
        
            <div class="pages-hero__single">
                <span><?php echo get_the_date(); ?></span>

                <button class="button blog-btn col-auto"><?php the_category(', '); ?></button>
            </div>  
        </div>  

        <div class="pages-hero__block position-relative ct-container d-flex flex-column justify-content-end">
            <div class="pages-hero__wrapper pages-wrapper d-flex align-items-start justify-content-between gap-lg-3">
                <div class="pages-wrapper__left">
                    <h1><?php the_title(); ?></h1>

                    <!-- breadcrumbs -->
                    <div class="breadcrumbs">
                        <div class="breadcrumbs__container">
                            <?php
                                if ( function_exists('yoast_breadcrumb') ) {
                                yoast_breadcrumb( '<div class="breadcrumbs__list">','</div>' );
                                }
                            ?>
                        </div>
                    </div>
                    <!-- breadcrumbs end -->
                </div>

            </div>
        </div>
    </section>
    