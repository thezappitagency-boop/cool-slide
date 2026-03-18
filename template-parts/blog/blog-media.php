<?php

$agntix_audio_url = function_exists('tpmeta_field') ? tpmeta_field('agntix_post_audio') : NULL;
$gallery_images = function_exists('tpmeta_gallery_field') ? tpmeta_gallery_field('agntix_post_gallery') : '';
$agntix_video_url = function_exists('tpmeta_field') ? tpmeta_field('agntix_post_video') : NULL;

$is_single = is_single() ? true : false;

$blog_single_layout_from_customizer = get_theme_mod('agntix_blog_single_layout', 'blog_single_default');
$blog_single_layout_from_page = function_exists('tpmeta_field') ? tpmeta_field('agntix_post_single_layout') : '';

$blog_single_layout = !empty($blog_single_layout_from_page) ? $blog_single_layout_from_page : $blog_single_layout_from_customizer;
$single_thumb_class = is_single() ? 'postbox-details-thumb mb-45 tp-post-full-width-thumb' : 'postbox-thumb mb-35';

?>

<?php if (has_post_format('image')): ?>
    <?php if (has_post_thumbnail()): ?>
        <div class="<?php echo esc_attr($single_thumb_class) ?>">

            <?php if (is_single()): ?>
                <?php the_post_thumbnail(); ?>
            <?php else: ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- if post has video -->
<?php elseif (has_post_format('video')): ?>
    <?php if (has_post_thumbnail()): ?>
        <div class="postbox-thumb p-relative mb-35">

            <?php if (is_single()): ?>
                <?php the_post_thumbnail(); ?>
                
                <?php if (!empty($agntix_video_url)): ?>
                    <div class="postbox-play-btn z-index-1">
                        <a class="popup-video" href="<?php print esc_url($agntix_video_url); ?>">
                            <span>
                                <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 9L0 17.6603L0 0.339746L15 9Z" fill="#141820" />
                                </svg>
                            </span>
                        </a>
                    </div>
                <?php endif; ?>

            <?php else: ?>

                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>

                <?php if (!empty($agntix_video_url)): ?>
                    <div class="postbox-play-btn z-index-1">
                        <a class="popup-video" href="<?php print esc_url($agntix_video_url); ?>">
                            <span>
                                <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 9L0 17.6603L0 0.339746L15 9Z" fill="#141820" />
                                </svg>
                            </span>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- if post has audio -->
<?php elseif (has_post_format('audio')): ?>

    <?php if (!empty($agntix_audio_url)): ?>
        <div class="tp-postbox-thumb mb-35 ratio ratio-16x9">
            <?php echo wp_oembed_get($agntix_audio_url); ?>
        </div>
    <?php endif; ?>

    <!-- if post has gallery -->
<?php elseif (has_post_format('gallery')): ?>
    <?php if (!empty($gallery_images)): ?>
        <div class="postbox-slider-thumb mb-35 tp-postbox-gallery-slider">
            <div class="postbox-slider p-relative">
                <div class="swiper-container postbox-slider-active fix">
                    <div class="swiper-wrapper">
                        <?php foreach ($gallery_images as $key => $image): ?>
                            <div class="swiper-slide">
                                <div class="postbox-slider-item fix">
                                    <img class="w-100" src="<?php echo esc_url($image['url']); ?>"
                                        alt="<?php echo esc_attr($image['alt']); ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="postbox-arrow">
                    <button class="postbox-arrow-prev">
                        <span>
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 7H1M1 7L7 1M1 7L7 13" stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </button>
                    <button class="postbox-arrow-next">
                        <span>
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 7H13M13 7L7 1M13 7L7 13" stroke="currentcolor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php else: ?>

    <?php if (has_post_thumbnail()): ?>
        <div class="<?php echo esc_attr($single_thumb_class) ?>">
            <?php if (is_single()): ?>
                <?php the_post_thumbnail(); ?>
            <?php else: ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

<?php endif; ?>