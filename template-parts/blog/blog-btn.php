<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agntix
 */

$agntix_blog_btn = get_theme_mod('agntix_blog_btn', 'Read More');
$agntix_blog_btn_switch = get_theme_mod('agntix_blog_btn_switch', true);

?>

<?php if (!empty($agntix_blog_btn_switch)): ?>
    <div class="tp-postbox-btn">
        <a href="<?php the_permalink(); ?>" class="tp-btn-yellow-border postbox-btn">

            <span>
                <span class="text-1"><?php print esc_html($agntix_blog_btn); ?></span>
                <span class="text-2"><?php print esc_html($agntix_blog_btn); ?></span>
            </span>
            <i>
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 11L11 1M11 1V11M11 1H1" stroke="#D0FF71" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 11L11 1M11 1V11M11 1H1" stroke="#D0FF71" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </i>
        </a>
    </div>
<?php endif; ?>