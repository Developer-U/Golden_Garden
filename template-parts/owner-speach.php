<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/*
 ** Block Owner sreach
 */

$page_id = get_the_ID();
$speach_photo = get_field('speach_photo', $page_id);
$speach_title = get_field('speach_title', $page_id);
$speach_text = get_field('speach_text', $page_id);
$speach_owner = get_field('speach_owner', $page_id);
?>

<?php
if ($speach_text) { ?>

    <section class="dark speach">
        <div class="ct-container speach__wrapper speach-wrapper d-grid">
            <?php
            if ($speach_photo) { ?>
                <figure class="speach-wrapper__photo">
                    <img src="<?php echo $speach_photo['url']; ?>" alt="<?php echo $speach_photo['alt']; ?>">
                </figure>
            <?php } ?>

            <article class="speach__text speach-text">
                <?php if ($speach_title) { ?>
                    <h2 class="line speach-text__title">
                        <?php echo $speach_title; ?>
                    </h2>
                <?php } ?>

                <div class="speach-text__text d-flex flex-column justify-content-between">
                    <div class="speach-text__top">
                        <?php echo $speach_text; ?>
                    </div>

                    <?php
                    if ($speach_photo) { ?>
                        <p class="speach-text__owner">
                            <?php echo $speach_owner; ?>
                        </p>
                    <?php } ?>
                </div>
            </article>
        </div>
    </section>

<?php } ?>