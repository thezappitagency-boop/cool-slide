<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agntix
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('tp-postbox mb-60'); ?>>
    <div class="tp-postbox-quote">
        <?php the_content(); ?>
    </div>
</article>