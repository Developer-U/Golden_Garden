<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( is_singular('post') ): ?>
    <h3 class="mb-3 sidebar__title">
        Читайте также:
    </h3>

    <ul class="sidebar-posts">
        <?php
        $arg_job =  array(
            'orderby'      => 'rand',
            'order'        => 'DESC',
            'posts_per_page' => 4,
            'post_type' => 'post',
            'post_status' => 'publish', 
            'exclude'   => array(get_the_id()),  
          );
        $job_query = new WP_Query($arg_job); 
        
        if ($job_query->have_posts() ) ?>
        <?php while ( $job_query->have_posts() ) : $job_query->the_post();             
        ?> 

            <li class="sidebar-job__other d-grid">
                <a href="<?php the_permalink(); ?>" class="sidebar-posts__image">
                    <?php if( has_post_thumbnail() ) {
                        the_post_thumbnail('large');
                    } ?>                    
                </a>
                
                <a class="sidebar-posts__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 

                <div class="blog-top__box blog-top__box_sidebar d-flex align-items-center justify-content-between gap-3">
                    <span class="col-auto"><?php echo get_the_date(); ?></span>

                    <button class="button blog-btn col-auto"><?php the_category(', '); ?></button>
                </div>
            </li>
        <?php endwhile; wp_reset_postdata();?> 
    </ul>

    <div class="sidebar-block">
        <h3 class="mb-3 sidebar__title">
            Рубрики:
        </h3>
       
        <?php
        $cat_args = [
            'orderby' => 'name',
            'order'   => 'rand',
            'hide_empty' => 1,
            'title_li'   => __( '' ),
        ];

        wp_list_categories( $cat_args );
        ?>
        
    </div>

<?php endif; ?>
