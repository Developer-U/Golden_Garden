<?php
/*
Estore Template Search
*/
get_header();

if ( have_posts() ) : ?>

    <!-- page-search -->
    <section class="search decor">                   
        <div class="ct-container">
            <div class="hero-section" >
                <header class="entry-header">
                    <h1 class="product_title" itemprop="headline">
                        <?php echo $wp_query->found_posts; ?> 
                        <?php _e( 'результатов найдено для', 'locale' ); ?>: "<?php the_search_query(); ?>"
                    </h1>
                </header>
            </div>                                      
            
            <ul class="products columns-4" data-products="type-1">                        
                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();

                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                

                    wc_get_template_part( 'content', 'product' );                                      

                endwhile;

                the_posts_navigation();                                
                ?>
            </ul>
        </div>
    </section>

<?php else: ?>

    <section class="search decor">
        <div class="ct-container">
            <div class="hero-section" >
                <header class="entry-header">
                    <h1 class="product_title" itemprop="headline">
                        <?php _e( 'Ничего не найдено по запросу', 'locale' ); ?>: "<?php the_search_query(); ?>"
                    </h1>
                </header>
            </div> 
        </div>   
    </section>                

<?php endif; 

get_footer(); ?>