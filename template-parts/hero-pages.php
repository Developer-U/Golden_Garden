<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/*
 ** Displaying Hero block for all pages
 */
$page_id = get_the_ID();

$tel = get_field('phone_link', 'options');
$phone_num = get_field('phone_num', 'options');
$address = get_field('address', 'options');
$hero_bg = get_field('hero_bg', $page_id);
?>

<section class="pages-hero" style="background-image: url('<?php echo $hero_bg['url']; ?>">
    <?php if (is_page('kontakty')) { ?>
        <div class="contacts-bg"></div><?php } ?>
    <div class="ct-container hero-slider__top">
        <?php
        if ($tel && $phone_num): ?>
            <a href="tel:+7<?php echo $tel; ?>" class="hero-slider__tel">
                <?php echo $phone_num; ?>
            </a>
        <?php endif;

        if ($address) { ?>
            <a class="header-central__address d-lg-none" href="/kontakty#map">
                <?php echo $address; ?>
            </a>
        <?php } ?>

    </div>

    <div class="pages-hero__block position-relative ct-container d-flex flex-column justify-content-end">
        <div class="pages-hero__wrapper pages-wrapper d-flex align-items-start justify-content-between gap-lg-3">
            <div class="pages-wrapper__left col-auto">
                <h1><?php the_title(); ?></h1>

                <!-- breadcrumbs -->
                <div class="breadcrumbs">
                    <div class="breadcrumbs__container">
                        <?php
                        if (function_exists('yoast_breadcrumb')) {
                            yoast_breadcrumb('<div class="breadcrumbs__list">', '</div>');
                        }
                        ?>
                    </div>
                </div>
                <!-- breadcrumbs end -->
            </div>

            <?php
            if (!is_page('kontakty')) { ?>
                <a class="button gold-btn col-auto" href="/quizle/podobrat-nedvizhimost/">
                    Подобрать недвижимость
                </a>
            <?php } ?>
        </div>
    </div>
</section>