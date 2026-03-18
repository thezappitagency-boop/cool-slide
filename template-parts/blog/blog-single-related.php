<?php

$args = [
    'post_type' => 'post',
    'posts_per_page' => 15,
    'post__not_in' => [get_the_ID()],
    'category__in' => wp_get_post_categories(get_the_ID()),
];

$related = get_posts($args);

$related_title = get_theme_mod('agntix_blog_related_title', esc_html__('Related Posts', 'agntix'));

$post_count = count($related);
$col = $post_count < 3 ? 'col-xl-4 col-lg-4 col-md-6 mb-30' : 'swiper-slide';

if ($related): ?>
<?php if ($post_count > 3): ?>
     <div class="related-post-area blog-grid-style grey-bg-4 pt-110 pb-90">
        <div class="container">
            <div class="row">
            <?php if (!empty($related_title)): ?>
                <div class="col-xl-6">
                    <div class="related-post-title-box mb-35">
                    <h4 class="related-post-title tp-split-text tp-split-right">
                        <?php echo esc_html($related_title) ?>
                    </h4>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="row">
            <div class="col-xl-12">
                <div class="agntix-post-related">
                    <div class="agntix-post-related-slider-active swiper">
                        <div class="swiper-wrapper">
                        <?php foreach ($related as $post):
                            setup_postdata($post);
                            $agntix_blog_date = get_theme_mod('agntix_blog_date', true);
                            $terms = get_the_terms($post->ID, 'category');
                            $custom_avater = get_the_author_meta('agntix_author_avater');
                            $author_name = get_the_author_meta('display_name');
                            $author_bio_avatar_size = 180;
                            ?>
                                <div class="<?php echo esc_attr($col); ?>">
                                <div class="tp-blog-3-item">
                                    <div class="tp-blog-3-content mb-20">
                                        <?php if (!empty($terms)) : ?>
                                            <div class="tp-blog-3-category">
                                                <?php foreach ($terms as $key => $term) : 
                                                    $color = get_term_meta($term->term_id, '_agntix_post_cat_color', true); 
                                                ?>
                                                    <a data-bg-color="<?php echo esc_attr($color); ?>" href="<?php echo esc_url(get_term_link($term->term_id)); ?>" rel="tag">
                                                        <?php echo esc_html($term->name); ?>
                                                    </a>
                                                    <?php if ($key == 1) {
                                                        break; 
                                                    } ?>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <h4 class="tp-blog-3-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h4>
                                        <div class="tp-blog-3-meta">
                                            <span>
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M8 3.7998V7.9998L10.8 9.3998" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            </span>
                                            <span> <?php the_time(get_option('date_format')); ?></span>
                                        </div>
                                    </div>

                                    <!-- <div class="tp-blog-3-thumb fix">
                                        <a href="#"><img class="w-100" src="assets/img/home-03/blog/blog-1.jpg" alt=""></a>
                                    </div> -->

                                    <?php get_template_part('template-parts/blog/blog-media'); ?>

                                    <div class="tp-blog-3-content">
                                        <div class="tp-blog-3-avater-info d-flex align-items-center">
                                            <?php if (!empty($custom_avater)): ?>
                                                    <img src="<?php echo esc_url($custom_avater); ?>"
                                                        alt="<?php echo esc_attr($author_name) ?>">
                                                <?php else: ?>
                                                    <?php print get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size, '', '', ['class' => 'media-object img-circle']); ?>
                                                <?php endif; ?>
                                                <span><?php print esc_html($author_name); ?></span>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            <?php endforeach;
                                wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
     </div>
     <?php endif; ?>
<?php endif; ?>