<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Expert section
*/ 
$expert_section_title = get_field('expert_section_title');
$expert_section_show = get_field('expert_section_show');

// Подключим поле ACF - тип поля "Записи (Object Type)" и подключим выбор эксперта в админке
$post_object = get_field('vyberite_eksperta');

if($post_object) {

    // Так мы получаем первый элемент в массиве - ID выбранногго в админке эксперта
    // echo '<pre>';
    // print_r( $post_object[0]  );
    // echo '</pre>';

    global $product;
    $id = $product->get_id();
    $product = wc_get_product($id); // Получим ID текущего объекта, в котором находимся

    $args = array(
        'post_type' => 'team',
        'post__in' => [$post_object[0]], // получаем ID выбранного эксперта
    );
    $q = new WP_Query( $args );


    if( $q->have_posts() && $expert_section_show == 'показать') {
        while( $q->have_posts() ) {
            $q->the_post();
        // Телефон эксперта
            $expert_section_phone = get_field('expert_section_phone', $post_object[0]);
            $expert_section_phone_num = preg_replace('/[^0-9]/', '', $expert_section_phone);

            // WhatsApp эксперта
            $expert_section_whatsapp = get_field('expert_section_whatsapp');
            $expert_section_whatsapp_num = preg_replace('/[^0-9]/', '', $expert_section_whatsapp);

            // Telegram эксперта
            $expert_section_telegram = get_field('expert_section_telegram');
            $expert_section_telegram_num = preg_replace('/[^0-9]/', '', $expert_section_telegram);        
        ?>

            <section class="decor expert-section">
                <div class="container">
                    <div class="expert-section__container">
                        <h2 class="line expert-section__title">
                            <?php echo $expert_section_title; ?>
                        </h2>

                        <div class="expert-section__wrapper d-grid">
                            <div class="expert-srction__block expert-block">
                                <h3 class="expert-block__title">
                                    <?php the_title(); 
                                ?>
                                    
                                </h3>

                                <p class="expert-block__excerpt">
                                    Ваш эксперт и путеводитель по объекту:<br /> <?php echo $product->get_title(); ?>
                                </p>

                                <?php
                                    if( $expert_section_phone ) { ?>			
                                    <a class="expert-block__phone" href="tel:+7<?php echo $expert_section_phone_num; ?>">
                                        +7&nbsp;<?php echo $expert_section_phone; ?>
                                    </a>		
                                <?php }; 
                                ?>	
                            </div>

                            <figure class="expert-block__image">
                                <?php
                                if( has_post_thumbnail()) {
                                    the_post_thumbnail( 'full', get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE ) );
                                }
                                ?>
                            </figure>
                        </div>

                        <?php if( $expert_section_phone || $expert_section_whatsapp_num || $expert_section_telegram_num ) { ?>
                            <div class="expert-section__btns expert-btns d-flex flex-column flex-sm-row align-items-streth gap-2">
                                <?php
                                if( $expert_section_phone ) { ?>			
                                    <a class="expert-btns__button expert-btns__button_tel" href="tel:+7<?php echo $expert_section_phone_num; ?>">
                                        Позвонить
                                    </a>		
                                <?php };          
                                if( $expert_section_whatsapp_num ): ?>               
                                    <a class="expert-btns__button expert-btns__button_whatsapp" href="https://api.whatsapp.com/send?phone=<?php echo $expert_section_whatsapp_num; ?>" target="_blank">	
                                        Написать в WhatsApp 								
                                    </a>             
                                <?php endif;
                                if( $expert_section_telegram_num ): ?>               
                                    <a class="expert-btns__button expert-btns__button_telegram" href="https://t.me/+7<?php echo $expert_section_telegram_num; ?>" target="_blank">			
                                        Написать в Telegram					
                                    </a>            
                                <?php endif;
                                ?>
                            </div>
                        <?php } ?>
                    </div>                
                </div>
            </section>

        <?php }
        }
}
?>