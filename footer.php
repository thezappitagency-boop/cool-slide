<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package agntix
 */

$agntix_smooth_scroll = get_theme_mod('agntix_theme_smooth_scroll_switch', 'off');

$agntix_smooth_scroll_from_page = function_exists('tpmeta_field') ? tpmeta_field('agntix_smooth_scroll') : NULL;

$enable_smooth_scroll_condition = !empty($agntix_smooth_scroll_from_page) && $agntix_smooth_scroll_from_page == 'default' ? $agntix_smooth_scroll : $agntix_smooth_scroll_from_page;

$enable_smooth_scroll = ($enable_smooth_scroll_condition == 'on') ? true : false;

$agntix_sticky_footer = function_exists('tpmeta_field') ? tpmeta_field('agntix_is_sticky_on') : NULL;

?>

<?php
if ($agntix_sticky_footer == "off") {
    
    do_action('agntix_footer_style');

    if ($enable_smooth_scroll == 'on'): ?>
        </div> <!-- smooth scroll end -->
        </div> <!-- smooth scroll end -->
    <?php endif;

} else { ?>
    </div> <!-- smooth scroll end -->
    </div> <!-- smooth scroll end -->
    <?php
    do_action('agntix_footer_style');
}
?>

<?php wp_footer(); ?>

</body>

</html>