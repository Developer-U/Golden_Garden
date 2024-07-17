<?php
/**
 * The template for displaying the light footer

 */

blocksy_after_current_template();
do_action('blocksy:content:bottom');
$tel = get_field('phone_link', 'options');
$phone_num = get_field('phone_num', 'options');
$whatsapp = get_field('whatsapp_link', 'options');
$telegram = get_field('telegram_link', 'options');
$vk = get_field('vk_link', 'options');
$logo_black = get_field('logo_black', 'options');
$address = get_field('address', 'options');
$mail = get_field('mail', 'options');
$copyright = get_field('copyright', 'options');
?>
	</main>

<?php
	do_action('blocksy:content:after');
	do_action('blocksy:footer:before');
	?>

	<!-- Footer -->

    <footer class="footer light">
		<div class="container">
			<?php if( $logo_black ) { ?>
				<div class="footer__top">
					<a href="/" class="footer__logo centered">
						<img src="<?php echo $logo_black['url']; ?>" alt="<?php echo $logo_black['alt']; ?>">
					</a>
				</div>
			<?php } ?>

			<div class="footer__medium footer-medium d-grid gap-3">
				<?php echo mytheme_primary_menu(); ?>

				<div class="footer-medium__center">
					<ul class="footer-medium__social header-social d-none d-sm-flex">
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

					<?php
					if( $tel && $phone_num ): ?>			
						<a href="tel:+7<?php echo $tel; ?>" class="footer-medium__link tel">
							<?php echo $phone_num; ?>
						</a>		
					<?php endif; 

					if( $mail ): ?>			
						<a href="mailto:<?php echo $mail; ?>" class="footer-medium__link mail">
							<?php echo $mail; ?>
						</a>		
					<?php endif; ?>
				</div>

				<div id="podbor_form">
					<?php echo do_shortcode('[contact-form-7 id="43e4293" title="Подобрать недвижимость"]'); ?>
				</div>
			</div>
			
			<div class="footer__bottom footer-bottom d-grid gap-3">						
				<p class="footer-bottom__item">
					<?php if( $copyright ) { ?>
						©&nbsp;<?php echo date("Y");?>&nbsp; <?php echo $copyright; ?>
					<?php } ?>
				</p>					

				<a class="footer-bottom__item" href="/privacy">
					Политка конфиденциальности
				</a>

				<p class="footer-bottom__item">
					Разработка сайта:&nbsp;<a href="https://sim-style.ru">Веб-студия «Символ стиля»</a>
				</p>			
			</div>			
		</div>
	</footer>
<?php
	do_action('blocksy:footer:after');
?>
</div>

<?php wp_footer(); ?>

<!-- Попап заказать звонок -->
<section class="popup-menu">
	<div class="popup-menu__wrapper d-flex flex-column justify-content-between gap-3">
		<?php echo mytheme_primary_menu();

		if( $tel && $phone_num ): ?>			
			<a href="tel:+7<?php echo $tel; ?>" class="popup-menu__link tel">
				<?php echo $phone_num; ?>
			</a>		
		<?php endif; ?>
	</div>	
</section>

</body>
</html>
