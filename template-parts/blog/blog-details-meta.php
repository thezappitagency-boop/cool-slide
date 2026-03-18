<?php

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agntix
 */

$categories = get_the_terms($post->ID, 'category');

$agntix_blog_date = get_theme_mod('agntix_blog_date', true);
$agntix_blog_comments = get_theme_mod('agntix_blog_comments', true);
$agntix_blog_author = get_theme_mod('agntix_blog_author', true);
$agntix_blog_cat = get_theme_mod('agntix_blog_cat', true);
$agntix_blog_tags = get_theme_mod('agntix_blog_tags', true);
$agntix_author_name = get_the_author_meta('display_name');

?>
<div class="postbox-details-meta d-flex align-items-center">
    <?php if (!empty($agntix_blog_author)): ?>
        <div class="postbox-author-box">
            <a class="d-flex align-items-center" href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                <div class="postbox-author-img">
                    <img src="<?php print get_avatar_url(get_the_author_meta('ID')); ?>" alt="author-img">
                </div>
                <div class="postbox-author-info">
                    <h4 class="postbox-author-name"><?php echo esc_html($agntix_author_name); ?></h4>
                </div>
            </a>
        </div>
    <?php endif; ?>

    <?php if (!empty($agntix_blog_date)): ?>
        <div class="postbox-meta">
            <i>
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9 4.19997V8.99997L12.2 10.6M17 9C17 13.4183 13.4183 17 9 17C4.58172 17 1 13.4183 1 9C1 4.58172 4.58172 1 9 1C13.4183 1 17 4.58172 17 9Z"
                        stroke="white" stroke-opacity="0.6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </i>
            <span><?php the_time(get_option('date_format')); ?></span>
        </div>
    <?php endif; ?>

    <?php if (!empty($agntix_blog_comments)): ?>
        <div class="postbox-meta">        
            <a href="<?php comments_link(); ?>">
                <i>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17 8.55557C17.003 9.72878 16.7289 10.8861 16.2 11.9333C15.5728 13.1882 14.6086 14.2437 13.4155 14.9816C12.2223 15.7195 10.8473 16.1106 9.44443 16.1111C8.27122 16.1142 7.11387 15.8401 6.06666 15.3111L1 17L2.68889 11.9333C2.15994 10.8861 1.88583 9.72878 1.88889 8.55557C1.88943 7.15269 2.28054 5.77766 3.01841 4.58451C3.75629 3.39135 4.81178 2.42719 6.06666 1.80002C7.11387 1.27107 8.27122 0.996966 9.44443 1.00003H9.88887C11.7416 1.10224 13.4916 1.88426 14.8037 3.19634C16.1157 4.50843 16.8978 6.25837 17 8.11113V8.55557Z"
                            stroke="white" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round">
                        </path>
                    </svg>
                </i>
                <span><?php comments_number(); ?></span>
            </a>
        </div>
    <?php endif; ?>
</div>