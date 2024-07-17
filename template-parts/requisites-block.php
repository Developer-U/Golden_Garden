<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Requisites block
*/

$page_id = get_the_ID();
$requisites_title = get_field( 'requisites_title', $page_id );
$requisites_content = get_field( 'requisites_content', $page_id );
$requisites_text = get_field( 'requisites_text', $page_id );

if( $requisites_title ) {
?>

    <section class="dark object_week how-see">
        <div class="object_week__image how-see__right requisites__right"></div>

        <div class="container object_week__wrapper">
            <div class="object_week__gg"></div>

            <div class="object_week__short">
                <h2 class="line object_week__title">
                    <?php echo $requisites_title; ?>
                </h2>

                <?php if( $requisites_content ) { ?>
                    <div class="requisites__content">
                        <?php echo $requisites_content; ?> 
                    </div>
                <?php } 

                if( $requisites_text ) { ?>
                    <div class="requisites__text">
                        <?php echo $requisites_text; ?> 
                    </div>
                <?php } ?>

            </div>                    
        </div>            
    </section>

<?php } 