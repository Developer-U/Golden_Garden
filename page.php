<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blocksy
 */

// get_template_part( 'single' );
get_header();

if( !is_front_page() ) {
    get_template_part( 'template-parts/hero-pages' );
}
if( is_page('o-nas')) {
    get_template_part( 'template-parts/about' );
    get_template_part( 'template-parts/work-levels' );
    // get_template_part( 'template-parts/team' );
    get_template_part( 'template-parts/how-see' );
}
if( is_page('blog')) {
    get_template_part( 'template-parts/blog-archive' );
}
if( is_page('kontakty')) {
    get_template_part( 'template-parts/contacts' );
    get_template_part( 'template-parts/requisites-block' );
    get_template_part( 'template-parts/map-block' );
}
if( is_page('nashi-eksperty') ) {
    get_template_part( 'template-parts/team' );
    get_template_part( 'template-parts/work-levels' );
}


get_footer();

