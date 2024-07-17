<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Block about
*/ 

$page_id = get_the_ID();
$about_title = get_field('about_title', $page_id);

if( !is_page('o-nas') ) : // Если это не страница О нас
    
    $about_block_one = get_field('about_block_one', $page_id);
    $about_block_two = get_field('about_block_two', $page_id);
    $about_block_three = get_field('about_block_three', $page_id);
    ?>

    <?php
    if( $about_block_one['text'] || $about_block_two['text'] || $about_block_three['text'] ) { ?>

        <section class="about-block ct-container">
            <div class="container">
                <?php
                if( $about_title ) { ?>
                    <h2 class="about-block__title">
                        <?php echo $about_title; ?>
                    </h2>
                <?php } 

                if( $about_block_one['text'] ) {
                ?>            
                    <div class="about-block__box about-box d-flex">
                        <div class="about-box__text post light first">
                            <?php echo $about_block_one['text']; ?>
                        </div>

                        <figure class="about-box__image first col" style="background: #3A4054;">
                            <?php if( $about_block_one['image'] ) { ?>
                                <img src="<?php echo $about_block_one['image']['url']; ?>" alt="<?php echo $about_block_one['image']['alt']; ?>">
                            <?php } ?>                
                        </figure>
                    </div>

                <?php } 

                if( $about_block_two['text'] ) {
                ?> 

                    <div class="about-block__box about-block__box_right about-box d-flex">
                        <figure class="about-box__image second col" style="background: #3A4054;">
                            <?php if( $about_block_two['image'] ) { ?>
                                <img src="<?php echo $about_block_two['image']['url']; ?>" alt="<?php echo $about_block_two['image']['alt']; ?>">
                            <?php } ?>                
                        </figure>

                        <div class="about-box__text post dark second">
                            <?php echo $about_block_two['text']; ?>
                        </div>
                    </div>

                <?php } 
                
                if( $about_block_three['text'] ) {
                ?>            
                    <div class="about-block__box about-box d-flex">
                        <div class="about-box__text post light first">
                            <?php echo $about_block_three['text']; ?>
                        </div>
    
                        <figure class="about-box__image first col" style="background: #3A4054;">
                            <?php if( $about_block_three['image'] ) { ?>
                                <img src="<?php echo $about_block_three['image']['url']; ?>" alt="<?php echo $about_block_three['image']['alt']; ?>">
                            <?php } ?>                
                        </figure>
                    </div>
    
                <?php } 
                ?>
            </div>
        </section>

    <?php } ?>

<?php else : // Для страницы "О нас" ?>

    <section class="about-block ct-container">
        <div class="container">
            <?php            
            if( have_rows('about_block_add') ): ?>
            <?php $i = 0; while( have_rows('about_block_add') ): the_row();
            $about_block_title = get_sub_field('about_block_title' );
            $about_block_image = get_sub_field('about_block_image' );    
            $about_block_text = get_sub_field('about_block_text' );  
            $index = $i++; // Создаём счётчик    
            
            if( $index == 0 || ($index % 2) == 0 ) { // Если чётные индексы или первый - вёрстка "слева картинка, справа - текст"?>
            
                <div class="about-page__block about-page__block_page">
                    <?php
                    if( $about_block_title ) { ?>
                        <h2 class="about-block__title">
                            <?php echo $about_block_title; ?>
                        </h2>
                    <?php }
                    ?>
                    <div class="about-page__box about-page d-flex">
                        <div class="about-box__text post first light">
                            <?php echo $about_block_text; ?>
                        </div>

                        <figure class="about-box__image col" style="background: #3A4054;">
                            <?php if( $about_block_image ) { ?>
                                <img src="<?php echo $about_block_image['url']; ?>" alt="<?php echo $about_block_image['alt']; ?>">
                            <?php } ?>                
                        </figure>
                    </div>
                </div>
                

            <?php } else { ?>

                <div class="about-page__block about-page__block_page">
                    <?php
                    if( $about_block_title ) { ?>
                        <h2 class="about-block__title">
                            <?php echo $about_block_title; ?>
                        </h2>
                    <?php }
                    ?>

                    <div class="about-page__box about-page d-flex">
                        <figure class="about-box__image col" style="background: #3A4054;">
                            <?php if( $about_block_image ) { ?>
                                <img src="<?php echo $about_block_image['url']; ?>" alt="<?php echo $about_block_image['alt']; ?>">
                            <?php } ?>                
                        </figure> 

                        <div class="about-box__text post dark second">
                            <?php echo $about_block_text; ?>
                        </div>                                 
                    </div>
                </div>

            <?php } ?>

            
            <?php endwhile; ?>
            <?php endif; ?>

        </div>
    </section>


<?php endif; ?>

