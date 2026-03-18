<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package agntix
 */

get_header();

$agntix_404_thumb = get_theme_mod('agntix_error_thumb', get_template_directory_uri() . '/assets/img/error/error.png');
$agntix_error_title = get_theme_mod('agntix_error_title', __('Oops!', 'agntix'));
$agntix_error_title_sm = get_theme_mod('agntix_error_title_sm', __('Something went Wrong...', 'agntix'));
$agntix_error_link_text = get_theme_mod('agntix_error_link_text', __('Back To Home', 'agntix'));
$agntix_error_desc = get_theme_mod('agntix_error_desc', __('Sorry, we couldn\'t find your page.', 'agntix'));

?>

<!-- error area start -->
<div class="tp-error-area pt-190 pb-120 agntix-dark" style="background: #0E0F11">
   <div class="container">
      <div class="row">
         <div class="col-xl-12">
            <div class="tp-error-wrapper text-center">
               <?php if (!empty($agntix_error_title)): ?>
                  <h4 class="tp-error-title">
                     <?php print esc_html($agntix_error_title); ?>
                  </h4>
               <?php endif; ?>

               <?php if (!empty($agntix_404_thumb)): ?>
                  <img src="<?php echo esc_url($agntix_404_thumb); ?>"
                     alt="<?php print esc_attr__('Error 404', 'agntix'); ?>">
               <?php endif; ?>

               <div class="tp-error-content">

                  <?php if (!empty($agntix_error_title_sm)): ?>
                     <h4 class="tp-error-title-sm">
                        <?php print esc_html($agntix_error_title_sm); ?>
                     </h4>
                  <?php endif; ?>

                  <?php if (!empty($agntix_error_desc)): ?>
                     <p><?php print esc_html($agntix_error_desc); ?></p>
                  <?php endif; ?>

                  <?php if (!empty($agntix_error_link_text)): ?>
                     <a class="tp-btn" href="<?php print esc_url(home_url('/')); ?>">
                        <?php print esc_html($agntix_error_link_text); ?>
                     </a>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- error area end -->


<?php
get_footer();
