<?php

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agntix
 */

$terms = get_the_terms($post->ID, 'category');
$agntix_blog_cat = get_theme_mod('agntix_blog_cat', true);
?>

<?php if (!empty($agntix_blog_cat) && !empty($terms) && !is_wp_error($terms)): ?>
    <?php
    $term = $terms[0]; // Only first category
    $color = get_term_meta($term->term_id, '_agntix_post_cat_color', true);
    ?>
    <span class="postbox-tag">
        <a data-bg-color="<?php echo esc_attr($color); ?>" href="<?php echo esc_url(get_term_link($term->term_id)); ?>" rel="tag">
            <i>
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M4.39101 4.39135H4.39936M13.6089 8.73899L8.74578 13.6021C8.61979 13.7283 8.47018 13.8283 8.3055 13.8966C8.14082 13.9649 7.9643 14 7.78603 14C7.60777 14 7.43124 13.9649 7.26656 13.8966C7.10188 13.8283 6.95228 13.7283 6.82629 13.6021L1 7.78264V1H7.78264L13.6089 6.82629C13.8616 7.08045 14.0034 7.42427 14.0034 7.78264C14.0034 8.14102 13.8616 8.48483 13.6089 8.73899Z"
                        stroke="white" stroke-opacity="0.6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </i>
            <?php echo esc_html($term->name); ?>
        </a>
    </span>
<?php endif; ?>
