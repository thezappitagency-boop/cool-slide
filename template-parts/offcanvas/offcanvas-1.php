<?php

/**
 * Template part for displaying header side information
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agntix
 */

$agntix_offcanvas_logo = get_theme_mod('agntix_offcanvas_logo', get_template_directory_uri() . '/assets/img/logo/logo-black.png');
$agntix_offcanvas_content_switch = get_theme_mod('agntix_offcanvas_content_switch', false);

$agntix_offcanvas_title = get_theme_mod('agntix_offcanvas_title', esc_html__('Hello There!', 'agntix'));
$agntix_offcanvas_content = get_theme_mod('agntix_offcanvas_content', esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, ', 'agntix'));
?>

<div class="tp-offcanvas-area">
   <div class="tp-offcanvas-wrapper offcanvas-black-bg">
      <div class="tp-offcanvas-top d-flex align-items-center justify-content-between">

         <?php if (!empty($agntix_offcanvas_logo)): ?>
            <div class="tp-offcanvas-logo">
               <a href="<?php print esc_url(home_url('/')); ?>">
                  <img src="<?php echo esc_url($agntix_offcanvas_logo); ?>"
                     alt="<?php echo esc_attr__('agntix Logo', 'agntix'); ?>">
               </a>
            </div>
         <?php endif; ?>

         <div class="tp-offcanvas-close">
            <button class="tp-offcanvas-close-btn">
               <svg width="37" height="38" viewBox="0 0 37 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M9.19141 9.80762L27.5762 28.1924" stroke="currentColor" stroke-width="1.5"
                     stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M9.19141 28.1924L27.5762 9.80761" stroke="currentColor" stroke-width="1.5"
                     stroke-linecap="round" stroke-linejoin="round" />
               </svg>
            </button>
         </div>
      </div>
      <div class="tp-offcanvas-main">
         <?php if ($agntix_offcanvas_content_switch): ?>         
            <div class="tp-offcanvas-content">
               <?php if (!empty($agntix_offcanvas_title)): ?>
                  <h2 class="tp-offcanvas-title text-white">
                     <?php echo agntix_kses($agntix_offcanvas_title); ?>
                  </h2>
               <?php endif; ?>
               <?php if (!empty($agntix_offcanvas_content)): ?>
                  <p class="text-white mt-15"><?php echo agntix_kses($agntix_offcanvas_content); ?></p>
               <?php endif; ?>
            </div>
         <?php endif; ?>

         <div class="tp-offcanvas-menu d-xl-none">
            <nav></nav>
         </div>         
      </div>
   </div>
</div>
 <div class="body-overlay"></div>