<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blocksy
 */

blocksy_after_current_template();
do_action('blocksy:content:bottom');
$tel = get_field('phone_link', 'options');
$phone_num = get_field('phone_num', 'options');
$whatsapp = get_field('whatsapp_link', 'options');
$telegram = get_field('telegram_link', 'options');
$vk = get_field('vk_link', 'options');
$logo_white = get_field('logo_white', 'options');
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
	<?php if( !is_product() ) { ?>
		<footer id="footer" class="footer dark">
	<?php } else { ?>
		<footer id="footer" class="footer dark">
	<?php } ?>
		<div class="container">
			<?php if( $logo_white ) { ?>
				<div class="footer__top">
					<a href="/" class="footer__logo centered">
						<img src="<?php echo $logo_white['url']; ?>" alt="<?php echo $logo_white['alt']; ?>">
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

<!-- Попап Бургерное меню -->
<section class="popup-menu">
	<div class="popup-menu__wrapper d-flex flex-column">
		<button class="popup-close">
			<svg width="38" height="37" viewBox="0 0 38 37" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M4.18198 0.93934C3.59619 0.353553 2.64645 0.353553 2.06066 0.93934C1.47487 1.52513 1.47487 2.47487 2.06066 3.06066L16.8787 17.8787L0.93934 33.818C0.353553 34.4038 0.353553 35.3536 0.93934 35.9393C1.52513 36.5251 2.47487 36.5251 3.06066 35.9393L19 20L34.9393 35.9393C35.5251 36.5251 36.4749 36.5251 37.0607 35.9393C37.6464 35.3536 37.6464 34.4038 37.0607 33.818L21.1213 17.8787L35.9393 3.06066C36.5251 2.47488 36.5251 1.52513 35.9393 0.939341C35.3536 0.353554 34.4038 0.353555 33.818 0.939341L19 15.7574L4.18198 0.93934Z" fill="#1C2540"/>
			</svg>
		</button>

		<?php echo mytheme_primary_menu();

		if( $tel && $phone_num ): ?>			
			<a href="tel:+7<?php echo $tel; ?>" class="popup-menu__link tel">
				<?php echo $phone_num; ?>
			</a>		
		<?php endif; ?>
	</div>	
</section>




<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
  /*
   * Light YouTube Embeds by @labnol
   * Credit: https://www.labnol.org/
   */

  function labnolIframe(div) {
    var iframe = document.createElement('iframe');
    iframe.setAttribute('src', 'https://www.youtube.com/embed/' + div.dataset.id + '?autoplay=1');
    iframe.setAttribute('frameborder', '0');
    iframe.setAttribute('allowfullscreen', '1');
    iframe.setAttribute('allow', 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture');
    div.parentNode.replaceChild(iframe, div);
  }

  function initYouTubeVideos() {
    var playerElements = document.querySelectorAll('.youtube-player');
    for (var n = 0; n < playerElements.length; n++) {
      var videoId = playerElements[n].dataset.id;
      var div = document.createElement('div');
      div.setAttribute('data-id', videoId);
      var thumbNode = document.createElement('img');
      thumbNode.src = '//i.ytimg.com/vi/ID/hqdefault.jpg'.replace('ID', videoId);
      div.appendChild(thumbNode);
      var playButton = document.createElement('div');
      playButton.setAttribute('class', 'play');
      div.appendChild(playButton);
      div.onclick = function () {
        labnolIframe(this);
      };
      playerElements[n].appendChild(div);
    }
  }

  document.addEventListener('DOMContentLoaded', initYouTubeVideos);
</script>

</body>
</html>
