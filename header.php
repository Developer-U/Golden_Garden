<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blocksy
 */

?><!doctype html>
<html <?php language_attributes(); ?><?php echo blocksy_html_attr() ?>>
<head>
	<?php do_action('blocksy:head:start') ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, viewport-fit=cover">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
	<?php wp_head(); ?>
	<?php do_action('blocksy:head:end') ?>	
	
</head>

<script src="https://api-maps.yandex.ru/2.1/?apikey=68f9a0ea-6fba-4a6e-9f0a-5a716b0b30d5&lang=ru"></script>

<body <?php body_class(); ?> <?php echo blocksy_body_attr() ?>>

<a class="skip-link show-on-focus" href="<?php echo apply_filters('blocksy:head:skip-to-content:href', '#main') ?>">
	<?php echo __('Skip to content', 'blocksy'); ?>
</a>

<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>

<?php
	if (function_exists('wp_body_open')) {
		wp_body_open();
	}

$whatsapp = get_field('whatsapp_link', 'options');
$telegram = get_field('telegram_link', 'options');
$vk = get_field('vk_link', 'options');
$logo_white = get_field('logo_white', 'options');
$address = get_field('address', 'options');
$tel = get_field('phone_link', 'options');
$phone_num = get_field('phone_num', 'options');
?>

<div id="main-container">
	<?php
		do_action('blocksy:header:before'); ?>

		<header class="header">
			<div class="ct-container">
				<div class="header__wrapper header-wrapper">

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

					<div class="header-wrapper__central header-central position-relative">
						<div class="header-central__left">
							<?php
								if( $tel && $phone_num ): ?>			
								<a class="header-central__address" href="tel:+7<?php echo $tel; ?>" class="footer-medium__link tel">
									<?php echo $phone_num; ?>
								</a>		
							<?php endif; 
							?>												
						</div>

						<a href="/" class="header-central__logo ">
							<img src="<?php echo $logo_white['url']; ?>" alt="<?php echo $logo_white['alt']; ?>">
						</a>

						<?php if($address) { ?>
							<a class="header-central__address  d-none d-lg-block " href="#" data-popup-map-open="map_popup">
								<?php echo $address; ?>

								<div class="header-center__map header-map position-absolute" data-popup-map="map_popup">
									
									<?php if( get_field('map_center_coords', 'options') ): ?>
										<?php $mapBal = get_field('map_baloon', 'options'); ?>

										<div id="map-header" class="map-inner">										
											<script type="text/javascript"> 
												ymaps.ready(init);

												function init() {
													var myMap = new ymaps.Map('map-header', {
														center: [<?php the_field('map_center_coords', 'options'); ?>],
														zoom: <?php the_field('map_center_zoom', 'options'); ?>,
														controls: ['zoomControl']
													}, {
														searchControlProvider: 'yandex#search'
												});                            

												myGeoObject = new ymaps.GeoObject({                           
													// Описание геометрии.
													geometry: {
														type: "Point",
														coordinates: [<?php the_field('map_center_coords', 'options'); ?>]
													},
													
												}, {
													// Опции.           
													preset: 'islands#redGlyphIcon'          
													}            
												);

												myMap.geoObjects.add(myGeoObject); 

												// Отключим зуммирование при скролле
												myMap.behaviors.disable('scrollZoom');
												}
											</script>
										</div>
										
									<?php endif; ?>
								
								</div>
							
							</a>
						<?php } ?>	

						<button class="popup__close position-absolute" data-popup-map-close="map_popup">
							<svg width="30" height="30" viewBox="0 0 38 37" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M4.18198 0.93934C3.59619 0.353553 2.64645 0.353553 2.06066 0.93934C1.47487 1.52513 1.47487 2.47487 2.06066 3.06066L16.8787 17.8787L0.93934 33.818C0.353553 34.4038 0.353553 35.3536 0.93934 35.9393C1.52513 36.5251 2.47487 36.5251 3.06066 35.9393L19 20L34.9393 35.9393C35.5251 36.5251 36.4749 36.5251 37.0607 35.9393C37.6464 35.3536 37.6464 34.4038 37.0607 33.818L21.1213 17.8787L35.9393 3.06066C36.5251 2.47488 36.5251 1.52513 35.9393 0.939341C35.3536 0.353554 34.4038 0.353555 33.818 0.939341L19 15.7574L4.18198 0.93934Z" fill="#1C2540"/>
							</svg>
						</button>
						
						<a class="map-link header-central__address position-absolute" href="/contacts#map">Смотреть полную карту</a>
					</div>

					<div class="header-wrapper__burger">
						<button class="burger" aria-label="Открыть меню">
							<span></span>
							<span></span>
							<span></span>
						</button>
					</div>					
				</div>
			</div>
		</header>

		<?php
		do_action('blocksy:header:after');
		do_action('blocksy:content:before');
	?>

	<main <?php echo blocksy_main_attr() ?>>

		<?php
			do_action('blocksy:content:top');
			blocksy_before_current_template();
		?>
