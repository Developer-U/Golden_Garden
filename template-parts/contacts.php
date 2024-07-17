<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Block Contacts
*/ 

$whatsapp = get_field('whatsapp_link', 'options');
$whatsapp_num = get_field('whatsapp_num', 'options');
$telegram = get_field('telegram_link', 'options');
$telegram_num = get_field('telegram_num', 'options');
$vk = get_field('vk_link', 'options');
$mail = get_field('mail', 'options');
$presentation = get_field('presentation', 'options');
$page_id = get_the_ID();
$how_see_block_one = get_field( 'how_see_block_one', 'options' );
$how_see_block_two = get_field( 'how_see_block_two', 'options' );
?>

<section class="about-block contacts ct-container">
    <div class="container">
        <div class="contacts__wrapper contacts-wrapper d-flex justify-content-between flex-column flex-md-row">

            <!-- Left phone block -->
            <div class="contacts-wrapper__block">
                <h2 class="contacts-wrapper__title h2-fz-50">
                    Позвонить:
                </h2>

                <div class="about-box__text about-box__text_contacts light">
                    <?php            
                    if( have_rows('add_contact_tel', $page_id) ): ?>
                    <?php while( have_rows('add_contact_tel', $page_id) ): the_row();
                    $contact_tel_link = get_sub_field('contact_tel_link', $page_id);
                    $contact_tel_num = get_sub_field('contact_tel_num', $page_id);
                    $contact_tel_label = get_sub_field('contact_tel_label', $page_id);
                    ?>

                        <div class="contacts-wrapper__inner">
                            <?php if( $contact_tel_label ): ?>	
                                <span><?php echo $contact_tel_label; ?></span>

                                <a href="tel:+7<?php echo $contact_tel_link; ?>" class="contacts-wrapper__link tel">
                                    <?php echo $contact_tel_num; ?>
                                </a>
                            <?php endif; ?>
                        </div>                       

                    <?php endwhile; ?>
                    <?php endif; ?>                    
                </div>
            </div>

            <!-- Right social block -->
            <div class="contacts-wrapper__block bottom">
                <h2 class="contacts-wrapper__title h2-fz-50">
                    Написать:
                </h2>

                <div class="about-box__text about-box__text_contacts dark">
                    <?php
                    if( $mail ): ?>		
                        <div class="contacts-wrapper__inner">                       
                            <span>e-mail</span>	
                            <a href="mailto:<?php echo $mail; ?>" class="contacts-wrapper__link">
                                <?php echo $mail; ?>
                            </a>	
                        </div>	
					<?php endif; 

                    if( $whatsapp && $whatsapp_num ): ?>                       
                        <div class="contacts-wrapper__inner">                       
                            <span>whatsapp</span>	
                            <a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp; ?>" target="_blank" class="contacts-wrapper__link">
                                <?php echo $whatsapp_num; ?>
                            </a>	
                        </div>	
                    <?php endif;

                    if( $telegram && $telegram_num ): ?>                       
                        <div class="contacts-wrapper__inner">                       
                            <span>telegram</span>	
                            <a href="https://t.me/+7<?php echo $telegram; ?>" target="_blank" class="contacts-wrapper__link">
                                <?php echo $telegram_num; ?>
                            </a>	
                        </div>
                    <?php endif;                    
                    ?>
                </div>
            </div>
        </div>

        <div class="contacts__wrapper contacts-wrapper d-flex flex-column flex-md-row">
            <!-- Get Presentation Block -->
            <?php if($presentation['link'] && $presentation['title']) { ?>
                <div class="contacts-wrapper__block">                
                    <h2 class="contacts-wrapper__title h2-fz-50">
                        Cкачать презентацию:
                    </h2>                

                    <div class="about-box__text about-box__text_contacts light">                    
                        <a href="<?php echo $presentation['link']; ?>" class="contacts__presentation">
                            <?php echo $presentation['title']; ?> 
                        </a>
                        <span><?php echo $presentation['size']; ?></span>                     
                    </div>
                </div>
            <?php } ?>

            <!-- Right social block -->
            <div class="contacts-wrapper__block bottom black">
                <h2 class="contacts-wrapper__title h2-fz-50">
                    Заказать просмотр:
                </h2>

                <div class="about-box__text about-box__text_contacts black">
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
            </div>
        </div>

    </div>
</section>