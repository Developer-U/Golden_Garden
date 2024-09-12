<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
	<div class="product-entry-wrapper">
		<h1 class="entry-title mobile"><?php the_title(); ?></h1>
	</div>
	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action('woocommerce_before_single_product_summary');
	
	?>

	<div class="summary entry-summary">

		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action('woocommerce_single_product_summary');
		?>
		<?php			
		if (!has_term('secondary_housing', 'product_cat')) { ?>
			<div class="product-single-description">
				<?php the_content(); ?>
			</div>
		<?php } ?>
		

		<div class="product-tab__content">
			<?php
			// Вёрстка таба "Характеристики объекта" только для категории "Готовое жильё"
			if (has_term('secondary_housing', 'product_cat')) {
				$object_params = get_field('object_params');
				$building_params = get_field('building_params');
				?>

				<article class="product-tab__block">
					<span class="product-tab__title">
						<h3>Об объекте</h3>
					</span>

					<div class="object-params d-grid">
						<table class="object-params__table object-params-table">
							<tr>
								<td class="object-params-table__key">Тип объекта</td>
								<td class="object-params-table__value">
									<?php
									if ($object_params['type']) {
										echo $object_params['type'];
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
							<tr>
								<td class="object-params-table__key">Количество комнат</td>
								<td class="object-params-table__value">
									<?php
									if ($object_params['rooms_length']) {
										echo $object_params['rooms_length'] . '&nbsp;ком.';
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
							<tr>
								<td class="object-params-table__key">Этаж</td>
								<td class="object-params-table__value">
									<?php
									if ($object_params['level_from'] && $object_params['level_to']) {
										echo $object_params['level_from'] . '&nbsp;из&nbsp;' . $object_params['level_to'];
									} elseif ($object_params['level_from']) {
										echo $object_params['level_from'];
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
							<tr>
								<td class="object-params-table__key">Отопление</td>
								<td class="object-params-table__value">
									<?php
									if ($object_params['heating']) {
										echo $object_params['heating'];
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
							<tr>
								<td class="object-params-table__key">Балкон/лоджия</td>
								<td class="object-params-table__value">
									<?php
									if ($object_params['balcony']) {
										echo $object_params['balcony'];
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<td class="object-params-table__key">Площадь общая</td>
								<td class="object-params-table__value">
									<?php
									if ($object_params['total_area']) {
										echo $object_params['total_area'] . '&nbsp;м²';
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
							<tr>
								<td class="object-params-table__key">Площадь жилая</td>
								<td class="object-params-table__value">
									<?php
									if ($object_params['living_area']) {
										echo $object_params['living_area'] . '&nbsp;м²';
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
							<tr>
								<td class="object-params-table__key">Высота потолков</td>
								<td class="object-params-table__value">
									<?php
									if ($object_params['ceiling_height']) {
										echo $object_params['ceiling_height'] . '&nbsp;м';
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
							<tr>
								<td class="object-params-table__key">Санузел</td>
								<td class="object-params-table__value">
									<?php
									if ($object_params['bathroom']) {
										echo $object_params['bathroom'];
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<td class="object-params-table__key">Планировка</td>
								<td class="object-params-table__value">
									<?php
									if ($object_params['configuration']) {
										echo $object_params['configuration'];
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
							<tr>
								<td class="object-params-table__key">Вид из окон</td>
								<td class="object-params-table__value">
									<?php
									if ($object_params['view']) {
										echo $object_params['view'];
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
							<tr>
								<td class="object-params-table__key">Ремонт</td>
								<td class="object-params-table__value">
									<?php
									if ($object_params['repair']) {
										echo $object_params['repair'];
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
							<tr>
								<td class="object-params-table__key">Газ</td>
								<td class="object-params-table__value">
									<?php
									if ($object_params['gas']) {
										echo $object_params['gas'];
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
						</table>
					</div>
				</article>

				<article class="product-tab__block">
					<span class="product-tab__title">
						<h3>О здании</h3>
					</span>

					<div class="object-params d-grid">
						<table class="object-params__table object-params-table">
							<tr>
								<td class="object-params-table__key">Тип дома</td>
								<td class="object-params-table__value">
									<?php
									if ($building_params['type']) {
										echo $building_params['type'];
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
							<tr>
								<td class="object-params-table__key">Лифт</td>
								<td class="object-params-table__value">
									<?php
									if ($building_params['elevator']) {
										echo $building_params['elevator'];
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
							<tr>
								<td class="object-params-table__key">Год постройки</td>
								<td class="object-params-table__value">
									<?php
									if ($building_params['build_year']) {
										echo $building_params['build_year'];
									} else {
										echo '—';
									} ?>
								</td>
							</tr>
						</table>
					</div>
				</article>
			<?php }

			// Вёрстка таба "Фотогалерея" только для категории "Готовое жильё"
			if ($tab_fields_postfix == 'tab_object_gallery' && has_term('secondary_housing', 'product_cat')) {
				?>

				<ul class="product-tab__configurations tab-document-list d-grid gap-1 gap-sm-3">
					<?php
					if (have_rows('add_' . $tab_fields_postfix)) {
						while (have_rows('add_' . $tab_fields_postfix)) {
							the_row();
							$tab_image = get_sub_field($tab_fields_postfix . '_image');
							$tab_title = get_sub_field($tab_fields_postfix . '_title');
							?>

							<li class="tab-document-list__item tab-document-list__item_image">
								<a class="tabs-document-list__link tabs-document-list__link_image" href="<?php echo $tab_image['url']; ?>"
									data-fancybox="<?php echo $tab_fields_postfix; ?>">
									<img src="<?php echo $tab_image['url']; ?>" />
								</a>
								<h4 class="tabs-document-list__title">
									<?php echo $tab_title; ?>
								</h4>
							</li>

						<?php }
					} ?>
				</ul>
			<?php }

			if ($tab_fields_postfix == 'presentations' || $tab_fields_postfix == 'blago') { // Дополнительная проверка - если этот таб - презентации или благоустройство, то добавляем возможность подключать или видео или файлы
				$tab_content_type = get_field('tab_' . $tab_fields_postfix . '_content_type');

				if ($tab_content_type === 'видео') { ?>
					<div class="product-tab__videos tab-videos d-grid gap-3">
						<?php
						if (have_rows('add_tab_video_' . $tab_fields_postfix)) {
							while (have_rows('add_tab_video_' . $tab_fields_postfix)) {
								the_row();
								$tab_video_link = get_sub_field('tab_' . $tab_fields_postfix . '_id'); ?>
								<div class="youtube-player" data-id="<?php echo $tab_video_link; ?>"></div>
								<?php

							}
						} ?>
					</div>
				<?php } else {
					addDocuments($tab_fields_postfix);
				}

			} else {
				addDocuments($tab_fields_postfix);
			}
			?>
    	</div>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action('woocommerce_after_single_product_summary');
	?>
</div>

<?php do_action('woocommerce_after_single_product'); ?>