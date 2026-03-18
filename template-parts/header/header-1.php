<?php

/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agntix
 */


// main header settings

$agntix_header_btn_text = get_theme_mod('agntix_header_btn_text', __('Get in Touch', 'agntix'));
$agntix_header_btn_url = get_theme_mod('agntix_header_btn_url', __('#', 'agntix'));


$header_right_switch = get_theme_mod('header_right_switch', false);
$agntix_header_sticky = get_theme_mod('agntix_header_sticky', false);

$sticky_id = $agntix_header_sticky ? 'tp-header-sticky' : '';
?>
<header>

    <div style="background-color: #0E0F11" id="<?php echo esc_attr($sticky_id); ?>"
        class="tp-header-area tp-header-ptb tp-header-4-style header-transparent tp-agntix-default-header">
        <div class="container container-1580">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-5 col-5">
                    <div class="tp-header-logo">
                        <?php agntix_header_logo(); ?>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-7 col-7">
                    <div class="tp-header-box d-flex align-items-center justify-content-end p-0">
                        <div class="tp-header-menu tp-header-dropdown d-none d-xl-flex">
                            <nav class="tp-mobile-menu-active">
                                <?php agntix_header_menu(); ?>
                            </nav>
                        </div>

                        <?php if ($header_right_switch): ?>
                            <div class="tp-header-right">
                                <?php if (!empty($agntix_header_btn_text)): ?>
                                    <div class="tp-header-btn-box ml-25">
                                        <a href="<?php echo esc_url($agntix_header_btn_url); ?>"
                                            class="tp-btn-black btn-green-light-bg">
                                            <span class="tp-btn-black-filter-blur">
                                                <svg width="0" height="0">
                                                    <defs>
                                                        <filter id="buttonFilter">
                                                            <feGaussianBlur in="SourceGraphic" stdDeviation="5" result="blur">
                                                            </feGaussianBlur>
                                                            <feColorMatrix in="blur"
                                                                values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9">
                                                            </feColorMatrix>
                                                            <feComposite in="SourceGraphic" in2="buttonFilter" operator="atop">
                                                            </feComposite>
                                                            <feBlend in="SourceGraphic" in2="buttonFilter"></feBlend>
                                                        </filter>
                                                    </defs>
                                                </svg>
                                            </span>

                                            <span class="tp-btn-black-filter d-inline-flex align-items-center"
                                                style="filter: url(#buttonFilter)">
                                                <span class="tp-btn-black-text">
                                                    <?php echo agntix_kses($agntix_header_btn_text); ?>
                                                </span>
                                                <span class="tp-btn-black-circle">
                                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 9L9 1M9 1H1M9 1V9" stroke="currentcolor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="tp-header-bar ml-20 d-xl-none">
                                <button class="tp-offcanvas-open-btn">
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                </button>
                            </div>
                        <?php endif; ?>

                        <?php if (!$header_right_switch): ?>
                            <div class="tp-header-bar ml-20 d-xl-none">
                                <button class="tp-offcanvas-open-btn">
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<?php do_action('agntix_offcanvas_style'); ?>