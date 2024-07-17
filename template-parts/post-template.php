<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Displaying content of Post Single page
*/ 

get_template_part('template-parts/hero-single');
?>

	<div id="page_content_wrapper" class="single-content">	    
		<div class="inner container">

			<!-- Begin main content -->
			<div class="inner_wrapper d-flex">
				<div class="sidebar_content col">				
					<?php the_content();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {									

						if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
							<p>Необходимо<a href="<?php echo wp_login_url( get_permalink() ); ?>">зарегистрироваться,</a>чтобы оставлять комментарии</p><br/>
						<?php else :

							echo '<div id="my_comment_form">';
								$args = array(
									'fields'  => [
										'author' => '<p class="comment-form-author">
											<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>
											<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' />
										</p>',
										'email'  => '<p class="comment-form-email">
											<label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>
											<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' />
										</p>',															
										'cookies' => '<p class="comment-form-cookies-consent">'.
											sprintf( '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />', $consent ) .'
											<label for="wp-comment-cookies-consent">'. __( 'Save my name, email, and website in this browser for the next time I comment.' ) .'</label>
										</p>',
									],
									'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="button gold-btn comment__btn" style="margin-top:0" value="%4$s" />%4$s</button>',

								);
								comment_form( $args, $post_id );
							echo '</div>';

						endif;
					}
					
					?>
				</div>

				<div class="sidebar_wrapper tutorial__sidebar">			
				
					<div class="tutorial__accord tutorial-accord">    		
						<div class="sidebar">
						
							<div class="content">

								<?php 
								get_template_part('posts-sidebar'); ?>
							
							</div>
					
						</div>
						<br class="clear"/>
				
						<div class="sidebar_bottom"></div>
					</div>
			
				</div>
			</div>
		</div>
	</div>

<script>
	jQuery(document).ready(function($) {
		// Плавающий сайдбар
		var $window = $(window);
		var $sidebar = $(".tutorial-accord"); // Внутренний контейнер сайдбара
		var $sidebarTop = $sidebar.position().top;  // Позиция Сайдбара от верха экрана
		
		var $footer = $('#footer');
		var $footerTop = $footer.position().top;
		const availableScreenWidth = window.screen.availWidth;

		if( availableScreenWidth >= 192) {
			$window.scroll(function(event) { // Объявляем событие Scroll, чтобы отслеживать сразу все изменения в прокрутке

			// Следующие переменные объявляем именно внутри функции Scroll
			var $scrollTop = $window.scrollTop(); // позиция прокрутки от верха экрана
			var $sidebarWrapper = $('.tutorial-accord'); // Внешний контейнер Сайдбара
			var $sidebarHeight = $sidebarWrapper.height(); // Высота внешнего контейнера Сайдбара (должна приравниваться высоте правого содержимого!)

			// Если нужно, чтобы Сайдбар начинал плавать не сразу при скролле, а после какого-то промежутка,
			// то пишем условие отступа от верха экрана
			if( $scrollTop >= 600) { // т.е. только в случае, когда отскроллил от верха на 300px, фиксируем внутренний контейнер Сайдбара
				$sidebar.addClass("fixed");
			}            

			//Устанавливаем Топ позицию Сайдбара - выбираем что больше: заданное число (118px), или разница (Верхняя позиция Сайдбара минус отскролливание от верха)
			var $topPosition = Math.max( 32, ($sidebarTop + 32) - $scrollTop);
			console.log($sidebarTop);
			console.log($scrollTop);
			// console.log($sidebarHeight);
			console.log($topPosition);
			// console.log($footerTop);

			// Для того, чтобы Сайдбар остановился, когда мы доскроллили до самого футера,
			// вначале определим новую Позицию Сайдбара
			// Вычитаем из Отскролливания высоту сайдбара, а затем - отступ от верха до футера

			var newTopPosition = $scrollTop - $sidebarHeight - $footerTop;
			// console.log(newTopPosition);

			// Если Сумма (отскролливание от верха + Позиция от верха) становится больше, чем высота сайдбара
			// Другими словами, когда мы подходим к футеру
			// Переопределяем Топ позицию - берём меньшее число из (Топ позиция начальная или Разность)


			if ($scrollTop + $sidebarHeight > $footerTop) {
				var $topPosition = Math.min( $topPosition, $footerTop - $scrollTop - ($sidebarHeight + 124));
			}


			$sidebar.css("top", $topPosition); // Устанавливаем сам плавающий Сайдбар
			});
		}

		
	});
</script>
