<?php
$agntix_blog_single_social = get_theme_mod('agntix_blog_single_social', false);
$blog_tag_col = $agntix_blog_single_social ? 'col-lg-8' : 'col-lg-12';

$agntix_blog_tags = get_theme_mod('agntix_blog_tags', true);
$share_column = $agntix_blog_tags ? 'col-lg-4' : 'col-lg-12';
$share_class = $agntix_blog_tags ? 'text-md-end' : 'text-start';

?>
<?php if ($agntix_blog_single_social || ($agntix_blog_tags && has_tag())): ?>
    <div class="postbox-details-tag-wrap d-flex justify-content-between align-items-center">
        <div class="row align-items-center w-100">
            <?php if ($agntix_blog_tags): ?>
                <div class="<?php echo esc_attr($blog_tag_col); ?>">
                    <div class="postbox-details-tag d-flex align-items-center">
                        <span><?php esc_html_e('Tagged with :', 'agntix'); ?></span>
                        <div class="tagcloud">
                            <?php print agntix_get_tag(); ?>
                        </div>                        
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($agntix_blog_single_social): 
                $instagram_url = 'https://www.instagram.com/';
                $dribbble_url = 'https://www.dribbble.com/';
                ?>
                <div class="<?php echo esc_attr($share_column); ?>">
                    <div class="postbox-details-social text-start text-md-end">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank">
                            <span>
                                <svg width="18" height="17" viewBox="0 0 11 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.77219 6.41667C1.13333 6.41667 1 6.54137 1 7.13889V8.22222C1 8.81974 1.13333 8.94444 1.77219 8.94444H3.31657V13.2778C3.31657 13.8753 3.4499 14 4.08876 14H5.63314C6.272 14 6.40533 13.8753 6.40533 13.2778V8.94444H8.13944C8.62396 8.94444 8.74881 8.85636 8.88192 8.42063L9.21286 7.3373C9.44088 6.59088 9.30037 6.41667 8.47038 6.41667H6.40533V4.61111C6.40533 4.21224 6.75106 3.88889 7.17752 3.88889H9.3753C10.0142 3.88889 10.1475 3.76419 10.1475 3.16667V1.72222C10.1475 1.1247 10.0142 1 9.3753 1H7.17752C5.04518 1 3.31657 2.61675 3.31657 4.61111V6.41667H1.77219Z" stroke="currentcolor" stroke-width="1.5" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank">
                            <span>
                                <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.67227 0H0L6.72535 8.79151L0.430223 16.1665H3.33876L8.09997 10.5886L12.3277 16.1153H18L11.0793 7.06826L11.0915 7.08386L17.0504 0.102701H14.1418L9.71667 5.28701L5.67227 0ZM3.131 1.53968H4.89685L14.869 14.5755H13.1032L3.131 1.53968Z" fill="currentcolor"></path>
                                </svg>
                            </span>
                        </a>

                        <a href="<?php echo esc_url($dribbble_url); ?>" target="_blank">
                            <span>
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.9994 10.5256C17.2116 10.3786 16.4014 10.302 15.5746 10.302C11.025 10.302 6.97863 12.6212 4.39943 16.2214M15.45 3.53634C12.79 6.63763 8.79271 8.61014 4.32318 8.61014C3.17971 8.61014 2.06716 8.48103 1 8.23695M11.7254 17.9135C11.9384 16.8869 12.0503 15.8237 12.0503 14.7345C12.0503 9.39347 9.35944 4.67635 5.25026 1.84649M18 9.45632C18 14.1266 14.1944 17.9126 9.5 17.9126C4.80558 17.9126 1 14.1266 1 9.45632C1 4.78603 4.80558 1 9.5 1C14.1944 1 18 4.78603 18 9.45632Z" stroke="currentcolor" stroke-width="1.5" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>

                        <a href="<?php echo esc_url($instagram_url); ?>" target="_blank">
                            <span>
                                <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.2426 4.82562H14.2496M5.27195 1H13.8159C16.1752 1 18.0878 2.90279 18.0878 5.25V13.75C18.0878 16.0972 16.1752 18 13.8159 18H5.27195C2.91262 18 1 16.0972 1 13.75V5.25C1 2.90279 2.91262 1 5.27195 1ZM12.9615 8.96482C13.0669 9.67223 12.9455 10.3947 12.6144 11.0295C12.2833 11.6643 11.7595 12.179 11.1174 12.5005C10.4753 12.8221 9.74767 12.934 9.03796 12.8204C8.32825 12.7067 7.67263 12.3734 7.16433 11.8677C6.65603 11.362 6.32096 10.7098 6.20675 10.0037C6.09255 9.29764 6.20504 8.57373 6.52823 7.93494C6.85141 7.29615 7.36883 6.775 8.00688 6.44563C8.64494 6.11625 9.37115 5.99542 10.0822 6.10032C10.8075 6.20732 11.479 6.54356 11.9975 7.05938C12.516 7.5752 12.854 8.24324 12.9615 8.96482Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>