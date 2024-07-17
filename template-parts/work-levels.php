<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Work levels
*/ 
$page_id = get_the_ID();
$levels_title = get_field('levels_title', 'options');
$levels_text = get_field('levels_text', 'options');

if( $levels_text['one'] ) {
?>

    <section class="levels <?php if( is_page('o-nas')): ?>dark<?php endif; ?>">
        <div class="container">
            <?php
                if( $levels_title ) { ?>
                <h2 class="levels__title">
                    <?php echo $levels_title; ?>
                </h2>
            <?php } ?>

            <ul class="levels__list levels-list d-flex flex-wrap justify-content-xxl-between">
                <li class="levels-list__item">
                    <span class="levels-list__num">1</span>
                    
                    <p class="levels-list__text">
                        <?php echo $levels_text['one']; ?>
                    </p>
                </li>
                <li class="levels-list__item levels-list__item_light">
                    <span class="levels-list__num">2</span>

                    <p class="levels-list__text">
                        <?php echo $levels_text['two']; ?>
                    </p>
                </li>
                <li class="levels-list__item">
                    <span class="levels-list__num">3</span>

                    <p class="levels-list__text">
                        <?php echo $levels_text['three']; ?>
                    </p>
                </li>
                <li class="levels-list__item levels-list__item_light">
                    <span class="levels-list__num">4</span>

                    <p class="levels-list__text">
                        <?php echo $levels_text['four']; ?>
                    </p>
                </li>
            </ul>
         
            <a class="button gold-btn centered" style="width: fit-content" href="/quizle/podobrat-nedvizhimost/">
                Получить персональное предложение
            </a>
        </div>
    </section>

<?php } ?>