<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Block keises
*/ 

$page_id = get_the_ID();
$keises_title = get_field('keises_title', $page_id);
$keises_visibility = get_field('keises_visibility', $page_id);
$args_keises= array(
    'posts_per_page' => 999,
    'post_type' => 'keises',
    'orderby'  => 'date',
    'order' => 'DESC',
);

$query_keises = new WP_Query( $args_keises);

if ( $query_keises->have_posts() && $keises_visibility !== 'скрыть') { ?>

    <section id="keises" class="about-block keises dark">
        <div class="container">
            <?php
            if( $keises_title ) { ?>
                <h2 class="about-block__title">
                    <?php echo $keises_title; ?>
                </h2>
            <?php } 

            if ($query_keises->have_posts()) :                    
            $i=0; while ($query_keises->have_posts()) :                
            $query_keises->the_post();
            $index = $i++; // Создаём счётчик            

                if( $index == 0 || ($index % 2) == 0 ) { // Если чётные индексы или первый - вёрстка "слева текст, справа - картинка"
                ?>            
                    <div class="about-block__box about-box d-flex">
                        <div class="about-box__text keises__text light first">
                            <h3 class="keis-title">
                                <?php the_title(); ?>
                            </h3>

                            <a href="<?php the_permalink(); ?>" class="button gold-btn">Читать кейс</a>
                        </div>

                        <figure class="about-box__image first col" style="background: #3A4054;">
                            <?php if( has_post_thumbnail() ) { 
                                the_post_thumbnail('large');
                            } ?>                
                        </figure>
                    </div>

                <?php } else { ?> 

                    <div class="about-block__box about-block__box_right about-box d-flex">
                        <figure class="about-box__image second col" style="background: #3A4054;">
                        <?php if( has_post_thumbnail() ) { 
                                the_post_thumbnail('large');
                            } ?>               
                        </figure>

                        <div class="about-box__text keises__text dark second">
                            <h3 class="keis-title">
                                <?php the_title(); ?>
                            </h3>                            

                            <a href="<?php the_permalink(); ?>" class="button dark-btn">Читать кейс</a>
                        </div>
                    </div>

                <?php } 

            endwhile; ?>
            <?php endif; 

            wp_reset_postdata();
            ?>           
            
        </div>
    </section>

<?php } ?>