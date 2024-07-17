<?php
/**
 * Блок отображает контент вкладок в карточке товара
 * 
 */

echo '<pre>';
print_r($tab_fields_postfix);
echo '</pre>';

if( have_rows('add_tab_' .$tab_fields_postfix ) ) {   
?>
    <div class="product-tab__content"> 
        <ul class="product-tab__configurations tab-document-list d-grid gap-3">
            <?php
            if( have_rows('add_tab_' .$tab_fields_postfix ) ) {
            while( have_rows('add_tab_' .$tab_fields_postfix ) ) {
            the_row();
            $tab_image = get_sub_field( 'tab_' .$tab_fields_postfix . '_image');
            $tab_title = get_sub_field( 'tab_' .$tab_fields_postfix. '_title');
            ?>

                <li class="tab-document-list__item">
                    <a class="tabs-document-list__link" href="<?php echo $tab_image; ?>" data-fancybox="tab_gallery">
                        <img src="<?php echo $tab_image; ?>" />
                    </a>

                    <h4 class="tabs-document-list__title tabs-document-list__title_configurations">
                        <?php echo $tab_title; ?>
                    </h4>
                </li>

            <?php }
            }
            ?>
        </ul>
    </div>       
<?php }