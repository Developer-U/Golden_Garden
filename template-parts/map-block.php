<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
** Map block
*/ 

$page_id = get_the_ID();
$map_title = get_field( 'map_title', $page_id );
?>
    

    <section class="decor products">
        <div class="ct-container">
            <h2 class="decor__title map-title">
                <?php echo $map_title; ?>
            </h2> 

            <div class="map-cont">
                <div class="col-12" data-aos="slide-left">
                    <?php if( get_field('map_center_coords', 'options') ): ?>
                        <?php $mapBal = get_field('map_baloon', 'options'); ?>
                        <div id="map" class="map">
                        </div>    

                        <script type="text/javascript"> 
                            ymaps.ready(init);

                            function init() {
                                var myMap = new ymaps.Map('map', {
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
                                // Свойства.
                                properties: {
                                    balloonContentHeader: '',
                                    balloonContentBody:  `
                                    <figure class="map__image"><img src="<?php echo esc_url($mapBal['image']['url']); ?>"></figure>                                
                                    <div class="baloon__box">
                                        <div class="icon-content__work-time">
                                            <?php echo $mapBal['text'] ?>
                                        </div>                      
                                    </div>`
                                }
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
                    <?php endif; ?>
                </div>       
            </div>
        </div>
    </section>