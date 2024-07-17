<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** How too see an Object
*/

$page_id = get_the_ID();
$how_see_title = get_field( 'how_see_title', 'options' );
$how_see_block_one = get_field( 'how_see_block_one', 'options' );
$how_see_block_two = get_field( 'how_see_block_two', 'options' );
$how_see_list = get_field( 'how_see_list', 'options' );
$whatsapp = get_field('whatsapp_link', 'options');
$telegram = get_field('telegram_link', 'options');
$vk = get_field('vk_link', 'options');

if( $how_see_title ) {
?>

    <section class="dark object_week how-see">
        <div class="object_week__image how-see__right d-flex flex-column">
            <div class="how-see__block see-block">
                <a class="button gold-btn see-block__btn mb-4" href="/quizle/zakazat-prezentaciyu-offlajn/" target="_blank">
                    Заказать презентацию оффлайн (очно)
                </a>  
                
                <?php if( $how_see_block_one ) { ?>
                    <p class="see-block__text">
                        <?php echo $how_see_block_one; ?>
                    </p>
                <?php } ?>  
            </div>
                  
            <div class="how-see__block see-block">
                <a class="button gold-btn see-block__btn mb-4" href="/quizle/zakazat-prezentaciyu-onlajn/" target="_blank">
                    Заказать презентацию онлайн
                </a>
                
                <?php if( $how_see_block_two ) { ?>
                    <p class="see-block__text">
                        <?php echo $how_see_block_two; ?>
                    </p>
                <?php } ?>  
            </div>
        </div>

        <div class="container object_week__wrapper">
            <div class="object_week__gg"></div>

            <div class="object_week__short">
                <h2 class="line object_week__title">
                    <?php echo $how_see_title; ?>
                </h2>

                <?php if( $how_see_list['one'] || $how_see_list['two'] ) { ?>
                    <ul class="see-block__list see-list">
                        <?php if( $how_see_list['one'] ) { ?>
                            <li class="see-list__item">
                                <?php echo $how_see_list['one']; ?>
                            </li>
                        <?php } 
                        if( $how_see_list['two'] ) { ?>
                            <li class="see-list__item">
                                <?php echo $how_see_list['two']; ?>
                            </li>
                        <?php } ?> 
                    </ul>
                <?php } ?>

                <div class="see-block__box d-flex gap-3 align-items-start">
                    <p class="see-block__desc see-block__desc_first">
                        Подберите удобный формат и нажмите кнопку
                    </p>

                    <div class="see-block__icon" ></div>
                </div>

                <div class="see-block__box d-flex gap-2 align-items-center justify-content-xxl-between last">
                    <p class="see-block__desc see-block__desc_second">
                        Подберите удобный формат и нажмите кнопку
                    </p>
                    
                    <ul class="header-wrapper__social header-social d-none d-sm-flex">
						<?php
						if( $whatsapp ): ?>
							<li class="social-top__item">
								<a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp; ?>" target="_blank" class="social-top__link whatsapp">									
								</a>
							</li>
						<?php endif;						

						if( $telegram ): ?>
							<li class="social-top__item">
								<a href="https://t.me/+7<?php echo $telegram; ?>" target="_blank" class="social-top__link telegram">								
								</a>
							</li>
						<?php endif;

						if( $vk ): ?>
							<li class="social-top__item">
								<a href="<?php echo $vk; ?>" class="social-top__link vk" target="_blank">							
								</a>
							</li>
						<?php endif; ?>
					</ul>
                </div>
                
                
            </div>                    
        </div>            
    </section>

<?php } 