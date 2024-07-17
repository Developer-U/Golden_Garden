<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Top objects
*/

$page_id = get_the_ID();
$products_title = get_field( 'products_title', $page_id );
?>

<section class="decor products">
    <div class="ct-container">
        <h2 class="decor__title">
            <?php echo $products_title; ?>
        </h2>       

        <ul data-products="type-1" class="products  columns-4">
            <?php  
            $bestsellers = ''; //Топовые объекты          
            
        
            if (isset($_REQUEST['bestsellers'])) {
                $bestsellers = $_REQUEST['bestsellers'];
            } 
            $attribute = 'bestsellers';
            $value = 'yes';   
            
            $args = array(
                'numberposts' => 4,
                'post_type' => 'product',              
                'tax_query' => array(
                    array(
                        'taxonomy'      => 'pa_' . $attribute,
                        'terms'         => $value,
                        'field'         => 'slug',
                        'operator'      => 'IN'
                        )
                    ),
                'posts_per_page' => 4,                
            );

            global $product;
            
            $prod_query = new WP_Query( $args );
            
                if ($prod_query->have_posts()) :                    
                while ($prod_query->have_posts()) :
                
                $prod_query->the_post();
                
                $product = get_product( $prod_query->post->ID );  
            
                    wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; ?>
                <?php endif; ?>
            
            <?php wp_reset_query(); // Remember to reset
            ?>
        <ul>
    </div>
</section>