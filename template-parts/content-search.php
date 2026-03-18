<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agntix
 */

$agntix_audio_url = function_exists('tpmeta_field') ? tpmeta_field('agntix_post_audio') : NULL;
$gallery_images = function_exists('tpmeta_gallery_field') ? tpmeta_gallery_field('agntix_post_gallery') : '';
$agntix_video_url = function_exists('tpmeta_field') ? tpmeta_field('agntix_post_video') : NULL;

$agntix_blog_single_social = get_theme_mod('agntix_blog_single_social', true);
$blog_tag_col = $agntix_blog_single_social ? 'col-xl-8 col-lg-6' : 'col-xl-12';

$enable_box_social = get_theme_mod('agntix_post_box_social_switch', false);
$readmore_btn = get_theme_mod('agntix_blog_button', true);
$readmore_text = get_theme_mod('agntix_blog_button_text', esc_html__('Read More', 'agntix'));

$excerpt = wp_trim_words(get_the_excerpt(), 30, '[…]');


if (is_single()): ?>
    <!-- details start -->
    <article id="post-<?php the_ID(); ?>" <?php post_class('tp-postbox-details-article'); ?>>
        <div class="tp-postbox-details-article-inner">
            <!-- content start -->
            <?php the_content(); ?>

            <?php
            wp_link_pages([
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'agntix'),
                'after' => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after' => '</span>',
            ]);
            ?>
            <?php get_template_part('template-parts/blog/blog-single-share'); ?>
        </div>
    </article>
    <!-- details end -->
<?php else: ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('tp-postbox postbox-item mb-30'); ?>>

        <?php get_template_part('template-parts/blog/blog-meta'); ?>

        <?php get_template_part('template-parts/blog/blog-media'); ?>

        <div class="postbox-content">

            <?php get_template_part('template-parts/blog/blog-cat-meta'); ?>

            <h3 class="postbox-title <?php echo esc_attr($heading_excerpt_class); ?>">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>

            <?php if (!empty($excerpt)): ?>
                <div class="tp-postbox-excerpt">
                    <p><?php echo wp_kses_post($excerpt); ?></p>
                </div>
            <?php endif; ?>

            <?php get_template_part('template-parts/blog/blog-btn'); ?>
        </div>
    </article>

<?php endif; ?>