<?php


// wordpress commnets form  start

function custom_comment_form_fields($fields)
{
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');

    $fields = array(
        'author' => '<div class="row tp-contact-input-form">
                    <div class="col-xl-6">
                        <div class="postbox-details-input-box">
                            <div class="postbox-details-input mb-20">
                            <input type="text" name="author" id="author" placeholder="' . esc_attr__('Your name', 'agntix') . '" value="' . esc_attr($commenter['comment_author']) . '" ' . ($req ? 'required' : '') . '>
                            </div>
                        </div>
                    </div>',

        'email' => '<div class="col-xl-6">
                        <div class="postbox-details-input-box">
                            <div class="postbox-details-input mb-20">
                                <input type="email" name="email" id="email" placeholder="' . esc_attr__('Your email', 'agntix') . '" value="' . esc_attr($commenter['comment_author_email']) . '" ' . ($req ? 'required' : '') . '>
                            </div>
                        </div>
                    </div>',
        'url' => '<div class="col-xl-12">
                    <div class="postbox-details-input-box">
                        <div class="postbox-details-input mb-20">
                            <input type="text" name="url" id="url" placeholder="' . esc_attr__('Your website url', 'agntix') . '" value="' . esc_attr($commenter['comment_author_url']) . '">
                        </div>
                    </div>
                </div>',
    );

    return $fields;
}
add_filter('comment_form_default_fields', 'custom_comment_form_fields');

// Customize the comment form textarea


// Move the comment textarea to the bottom
function move_comment_textarea_to_bottom($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;

    return $fields;
}

add_action('comment_form_fields', 'move_comment_textarea_to_bottom');




// custom_comment_list
function agntix_comment_list($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    $custom_avater = get_the_author_meta('agntix_author_avater');
    $author_name = get_the_author_meta('display_name');

    $args['callback'] = 'custom_comment_list';
    $args['reply_text'] = '<span>
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.5 6L1 3.5L3.5 1" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M9 9V5.5C9 4.96957 8.78929 4.46086 8.41421 4.08579C8.03914 3.71071 7.53043 3.5 7 3.5H1" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            Reply';


    if ($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback') {
        // Display pingbacks and trackbacks differently if needed
        ?>
        <li class="pingback">
            <p><?php esc_html_e('Pingback:', 'agntix'); ?>         <?php comment_author_link(); ?></p>
        </li>
        <?php
    } else {
        // Display regular comments
        ?>
        <li class="mt-20" <?php comment_class('comment'); ?> id="comment-<?php comment_ID(); ?>">
            <div class="postbox-comment-box d-flex">
                <div class="postbox-comment-avater mr-20">
                    <?php if (!empty($custom_avater)): ?>
                        <img src="<?php echo esc_url($custom_avater); ?>" alt="<?php echo esc_attr($author_name) ?>">
                    <?php else: ?>
                        <?php print get_avatar($comment, 90, ); ?>
                    <?php endif; ?>
                </div>
                <div class="postbox-comment-text">
                    <div class="postbox-comment-name">
                        <h5><?php comment_author(); ?></h5>
                        <span class="post-meta">
                            <?php comment_date(); ?>
                            <?php echo esc_html__('at', 'agntix'); ?>
                            <?php echo get_comment_time(); ?>
                        </span>
                    </div>
                    <div class="agntix-post-comment-text">
                        <?php if ($comment->comment_approved == '0'): ?>
                            <p><?php esc_html_e('Your comment is awaiting moderation.', 'agntix'); ?></p>
                        <?php endif; ?>
                        <?php comment_text(); ?>
                    </div>
                    <div class="postbox-comment-reply">
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </div>
                </div>
            </div>

        <?php
    }
}
