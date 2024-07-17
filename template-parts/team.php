<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Displaying Our team block for any pages
*/ 
$page_id = get_the_ID();
$team_title = get_field( 'team_title', $page_id );
$args_team= array(
    'posts_per_page' => 99,
    'post_type' => 'team',
    'orderby'  => 'date',
    'order' => 'ASC',
);

$query_team = new WP_Query( $args_team);

if ( $query_team->have_posts() ) { ?>

    <section class="decor products">
        <div class="ct-container">
            <?php if( is_page('nashi-eksperty') ) { ?>
                <div class="container experts">
                    <?php the_content(); ?>
                </div>
            <?php } else { ?>
                <h2 class="decor__title">
                    <?php echo $team_title; ?>
                </h2> 
            <?php } ?>

            <ul data-products="type-1" class="products  columns-4 team">

                <?php
                if ($query_team->have_posts()) :                    
                while ($query_team->have_posts()) : 
                global $post;
                $post_id = get_the_ID();            
                $query_team->the_post();  
                $staff_post = get_field('staff_post');
                ?>
                
                    <li class="woo team__item team-item">
                        <figure class="team-item__image" style="background-color: #fff">
                            <?php if( has_post_thumbnail()) {
                                the_post_thumbnail('large'); 
                            } else { ?>
                                <img class="no-image" src="/wp-content/themes/blocksy-child/assets/img/no-image.jpg" alt="фото сотрудника">
                            <?php }
                            ?>                            
                        </figure>

                        <div class="product-card__wrapper">
                            <h2 class="woocommerce-loop-product__title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>    

                            <?php if($staff_post) { ?>
                                <div class="team-item__post">
                                    <?php echo $staff_post; ?>
                                </div>
                            <?php } ?>                           
                        </div>                           
                    </li>
                
                <?php endwhile; ?>
                <?php endif; 

                wp_reset_postdata();
                ?>   

            </ul>            
        </div>
    </section>



<?php } ?>