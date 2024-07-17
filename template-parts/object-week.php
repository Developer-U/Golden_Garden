<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Object of week
*/

$page_id = get_the_ID();
$object_week_title = get_field( 'object_week_title', $page_id );

if( $object_week_title ) {
?>

    <section class="dark object_week">
        <?php  
        $object_week = ''; //Объект недели         
        

        if (isset($_REQUEST['object_week'])) {
            $object_week = $_REQUEST['object_week'];
        } 
        $attribute = 'object_week';
        $value = 'yes';   
        
        $args = array(
            'numberposts' => 1,
            'post_type' => 'product',              
            'tax_query' => array(
                array(
                    'taxonomy'      => 'pa_' . $attribute,
                    'terms'         => $value,
                    'field'         => 'slug',
                    'operator'      => 'IN'
                    )
                ),
            'posts_per_page' => 1,                
        );

        global $product;
        
        $prod_query = new WP_Query( $args );
        
            if ($prod_query->have_posts()) :                    
            while ($prod_query->have_posts()) :
            
            $prod_query->the_post();
            
            $product = get_product( $prod_query->post->ID );
            ?>  

                <figure class="object_week__image" style="background-color: #3A4054">
                    <?php
                    if( has_post_thumbnail() ) { // условие, если есть миниатюра
                        the_post_thumbnail('large'); // если параметры функции не указаны, то выводится миниатюра текущего поста, размер thumbnail
                    } ?>                 
                </figure>

                <div class="container object_week__wrapper">
                    <div class="object_week__gg"></div>

                    <div class="object_week__short">
                        <h2 class="line object_week__title">
                            <?php echo $object_week_title; ?>
                        </h2>

                        <h3 class="object_week__name">
                            <?php echo get_the_title(); ?>
                        </h3>                        

                        <?php the_excerpt(); ?>

                        <a href="<?php the_permalink(); ?>" class="button gold-btn object_week__button">
                            Получить персональное предложение
                        </a>
                    </div>                    
                </div>

            <?php endwhile; ?>
            <?php endif; ?>
        
        <?php wp_reset_query(); // Remember to reset
        ?>
    </section>

<?php } 