<?php
/*
Template Name: Страница эксперта
Template Post Type: team
*/
get_header();

if (have_posts()) {
	the_post();
}

if (
	function_exists('blc_get_content_block_that_matches')
	&&
	blc_get_content_block_that_matches([
		'template_type' => 'single',
		'template_subtype' => 'canvas'
	])
) {
	echo blc_render_content_block(
		blc_get_content_block_that_matches([
			'template_type' => 'single',
			'template_subtype' => 'canvas'
		])
	);
	have_posts();
	wp_reset_query();
	return;
}
?>

    <section class="about-block team ct-container dark">
        <div class="container">
            <div class="keises__links keises-links d-flex align-iyems-center justify-content-between mb-4 mb-lg-5">
                <a href="/nashi-eksperty/" class="keises-links__link">Все эксперты</a>

                <a href="/" class="keises-links__link text-right">На главную</a>
            </div>
            <div class="single-page d-flex gap-3 mb-5 flex-column flex-lg-row">
                <div class="sibgle-page__text col">
                    <h1 class="single-page__title single-page__title_team col">
                        <?php the_title(); ?>
                    </h1>

                    <div class="single-page__excerpt">
                        <?php the_excerpt(); ?>
                    </div>                    
                </div>
                
                <?php
                if( has_post_thumbnail() ) {
                    echo '<figure class="single-page__image single-page__image_team" style="background: #3A4054;">';
                    the_post_thumbnail('full');
                    echo '</figure>';
                } else { ?>
                    <figure class="single-page__image single-page__image_team" style="background: #3A4054;">
                                  
                    </figure>
                <?php } ?>
            </div>

            <!-- Раздел с табами показываем только в том случае, если в админке добавлены и кнопки табов, и контенты -->
            <?php if( have_rows('add_team_tabs_btn') && have_rows('add_team_tabs_content') ): ?>

                <div class="single-page__content">
                    
                    <?php if( have_rows('add_team_tabs_btn') ): ?>
                        <!-- Список кнопок табов -->
                        <div class="team-tab-btns-wrapper d-flex align-items-center justify-content-between">
                            <span class="col"></span>

                            <ul class="team-tab-btns col-auto d-flex align-items-center">
                                <?php if( have_rows('add_team_tabs_btn') ): ?>
                                <?php $i = 1; while( have_rows('add_team_tabs_btn') ): the_row(); 
                                $team_tabs_btn_title = get_sub_field('team_tabs_btn_title'); 
                                $index = $i++;            
                                ?>

                                    <!-- Делаем проверку, что если Подраздел №1, то есть его Индекс == 1, то показываем его -->
                                    <li class="team_tabs_btn__link js-pathTabs <?php if($index == 1): ?>active<?php endif; ?>" data-path="<?php echo $index; ?>">
                                        <?php echo $team_tabs_btn_title; ?>
                                    </li>

                                <?php endwhile; ?>
                                <?php endif; ?>
                            </ul> 

                            <span class="col"></span>
                        </div>                    
                    <?php endif; ?>

                    <div class="team-tab-content">
                        <!-- Список контента табов -->
                        <?php if( have_rows('add_team_tabs_content') ): ?>
                        <?php $n = 1; while( have_rows('add_team_tabs_content') ): the_row(); 
                        $team_tabs_content = get_sub_field('team_tabs_content');                       
                        $indexN = $n++;                                     
                        ?>

                            <article class="team-tab-content__wrapper js-targetTabs <?php if($indexN === 1): ?>active<?php endif; ?>" data-target="<?php echo $indexN; ?>" >                         
                                <?php echo $team_tabs_content; ?>                            
                            </article>

                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                </div>

            <?php endif; ?>

            <!-- Блок основное об эксперте -->
            <?php if( have_rows('add_expert_param') ): ?>

                <div class="single-page__params expert-params">
                    <?php if( get_field('expert-params-title') ): ?>
                        <h2 class="expert-params__title">
                            <?php the_field('expert-params-title'); ?>
                        </h2>
                    <?php endif; ?>

                    <!-- Список параметров эксперта -->
                    <?php if( have_rows('add_expert_param') ): ?>
                    <?php while( have_rows('add_expert_param') ): the_row(); 
                    $expert_param_icon = get_sub_field('expert_param_icon');         
                    $expert_param_title = get_sub_field('expert_param_title');
                    ?>

                        <ul class="expert-params__list d-grid gap-3">
                            <li class="expert-params__item d-grid gap-2">
                                <figure class="expert-params__icon">
                                    <img src="<?php echo $expert_param_icon['url']; ?>" alt="<?php echo $expert_param_icon['alt']; ?>">
                                </figure>

                                <p class="expert-params__title">
                                    <?php echo $expert_param_title; ?>
                                </p>
                            </li>
                        </ul>

                    <?php endwhile; ?>
                    <?php endif; ?>

                </div>

            <?php endif; ?>
            
            <div class="post-nav">
                <?php
                the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle prev">' . esc_html__( '←', 'estore' ) . '</span> <span class="nav-title"></span>',
						'next_text' => '<span class="nav-title"></span> <span class="nav-subtitle next">' . esc_html__( '→', 'estore' ) . '</span>',
					)
				);
                ?>
            </div>            
        </div>
    </section>

    <script>
        // Открытие табов с разделами и подразделами
        var pathNums = document.querySelectorAll('.js-pathTabs'); // все кнопки табов
        
        var targetNums = document.querySelectorAll('.js-targetTabs'); // все контенты табов 
        
        // Объявляем функцию открытия табов
        const openTabs = function() {   

            pathNums.forEach(function(pathBtn){ // Итерируем все разделы сайдбара
                pathBtn.addEventListener('click', function(event){  // Кликаем по разделу сайдбара
                    event.preventDefault();
                    var path = event.currentTarget.dataset.path; // Определяем индекс раздела                     

                    // по клику деактивируем все кнопки табов
                    pathNums.forEach(function(eachBtn){                    
                        eachBtn.classList.remove('active');
                    }); 

                    // Активируем текущую кнопку
                    var currentBtn = event.currentTarget; // Определяем индекс раздела
                    console.log(currentBtn);
                    currentBtn.classList.add('active');
                    
                    // по клику отключаем все контенты
                    targetNums.forEach(function(targetNum){                    
                        targetNum.classList.remove('active');
                    }); 

                    // Закинем в переменную текущий Таб с соответствующим атрибутом data-target       
                    var currentTypeTab = document.querySelector(`[data-target="${path}"]`);                               
                
                    currentTypeTab.classList.add('active'); // Активируем первый раздел в контенте                                   
                        
                });
            }); 
        }

        openTabs();
    </script>

<?php
have_posts();
wp_reset_query();

get_footer('light');