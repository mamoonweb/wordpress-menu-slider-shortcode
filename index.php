<?php

function enqueue_swiper_on_product_single_page() {

        // Enqueue Swiper CSS file
        wp_enqueue_style('my-swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
        
        // Enqueue Swiper JS file
        wp_enqueue_script('my-swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), '1.0', true);

		// Enqueue Custom JS file
	wp_enqueue_script('custom-js-child', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), '1.0', true);
		
}

function swiper_slider_menu_shortcode($atts) {
    $atts = shortcode_atts(array(
        'menu_id' => '',
    ), $atts);

    $menu_id = $atts['menu_id'];
    $menu_object = wp_get_nav_menu_object($menu_id);
    $menu_items = wp_get_nav_menu_items($menu_object->slug);

    $output = '<div class="swiper-container nav-slide">';
    $output .= '<div class="swiper-wrapper">';
    if ($menu_items) {
        foreach ($menu_items as $menu_item) {
            $output .= '<div class="swiper-slide"><a class="menu-link" href="' . $menu_item->url . '">' . $menu_item->title . '</a></div>';
        }
    }
    
    $output .= '</div>';
	$output .= '<div class="swiper-button-next"></div>';
    $output .= '<div class="swiper-button-prev"></div>';
    $output .= '</div>';
   

    return $output;
}
add_shortcode('swiper_slider_menu', 'swiper_slider_menu_shortcode');
?>

<!-- Add Css -->

<style>
.swiper-container.nav-slide{
    width: auto !important;
    overflow: hidden !important;
    padding: 0;
}

.swiper-container.nav-slide .swiper-slide {
    width: auto !important;
}

.nav-slide a.menu-link{
    font-family: "Lato", Sans-serif;
    font-size: 13px !important;
    font-weight: 500;
    color: #000 !important;
}

.nav-slide .swiper-button-prev {
    left: -10px !important;
}
.nav-slide .swiper-button-next {
    right: -10px;
}
.nav-slide .swiper-button-next:after, .nav-slide .swiper-button-prev:after {
    font-size: 26px !important;
}
</style>

<!-- Add Custom JS -->

<script>
document.addEventListener("DOMContentLoaded", function() {

	var swiper = new Swiper(".swiper-container.nav-slide", {
            slidesPerView: "auto",
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
	
});
</script>


