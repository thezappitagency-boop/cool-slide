<?php

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agntix
 */

$agntix_blog_date = get_theme_mod('agntix_blog_date', true);
$agntix_blog_author = get_theme_mod('agntix_blog_author', true);
$agntix_author_name = get_the_author_meta('display_name');
$agntix_blog_author = get_theme_mod('agntix_blog_author', true);

$terms = get_the_terms($post->ID, 'category');
$agntix_blog_cat = get_theme_mod('agntix_blog_cat', true);
$author_designation = get_the_author_meta('agntix_dasignation');

?>


<div class="postbox-author-wrap d-flex align-items-center justify-content-between mb-30">
    <?php if (!empty($agntix_blog_author)): ?>
        <div class="postbox-author-box d-flex align-items-center ">
            <div class="postbox-author-img">
                <img src="<?php print get_avatar_url(get_the_author_meta('ID')); ?>" alt="img">
            </div>
            <div class="postbox-author-info">
                <h4 class="postbox-author-name">
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>">
                        <?php echo esc_html($agntix_author_name); ?>
                    </a>
                </h4>
                       <?php if (!empty($author_designation)): ?>
                <span><?php echo esc_html($author_designation); ?></span>
            <?php endif; ?>                
            </div>
        </div>
    <?php endif; ?>

<?php if (!empty($agntix_blog_date)): ?>
    <div class="postbox-meta">
        <i>
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 4.19997V8.99997L12.2 10.6M17 9C17 13.4183 13.4183 17 9 17C4.58172 17 1 13.4183 1 9C1 4.58172 4.58172 1 9 1C13.4183 1 17 4.58172 17 9Z" stroke="white" stroke-opacity="0.6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </i>
        <span><?php the_time(get_option('date_format')); ?></span>
    </div>
    <?php endif; ?>
</div>