<?php if (get_previous_post_link() or get_next_post_link()):
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    ?>

    <?php if (get_previous_post()): ?>
        <div class="col-xl-12 fix">
            <a href="<?php echo get_permalink($prev_post) ?>">
                <div class="postbox-details-nevigation-wrap p-relative pt-120 pb-30">
                    <div class="postbox-details-nevigation-thumb-bg">
                        <?php if (!empty(get_the_post_thumbnail($prev_post))): ?>
                            <div class="postbox-details-nevigation-thumb fix">
                                <img data-speed=".8" src="<?php echo get_the_post_thumbnail_url($prev_post); ?>" alt="">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="postbox-details-nevigation-content">
                        <span>
                            <?php echo esc_html__('Next Post', 'agntix'); ?>
                        </span>
                        <h4 class="postbox-details-nevigation-title">
                            <?php print wp_trim_words(get_the_title($prev_post), 5, ''); ?>
                        </h4>
                    </div>
                </div>
            </a>
        </div>
    <?php else: ?>
        <div class="container container-1330 full-width-no-post d-none">
            <div class="row">
                <div class="col-xl-8">
                    <div class="postbox-details-nevigation-wrap p-relative postbox-details-nav-no-post">
                        <div class="postbox-details-nevigation-thumb-bg">
                            <h4 class="postbox-details-nevigation-title">
                                <?php echo esc_html__('No Next Post Available', 'agntix'); ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>