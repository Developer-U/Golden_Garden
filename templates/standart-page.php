<?php
/*
Template Name: Standart page
*/

get_header();
?>

    <section class="about-block ct-container standart">
        <div class="container">
            <h1 class="standart__title">
                <?php the_title(); ?>
            </h1>

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

            <div class="standart__wrapper">
                <?php the_content(); ?>
            </div>            
        </div>
    </section>  

<?php get_footer(); ?>