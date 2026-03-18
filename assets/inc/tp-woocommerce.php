<?php

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// product item 
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// product details 
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

// Wishlist Feature
// remove from archive page 
add_filter('storebuild_archive_wishlist_btn_html', '__return_false');

// remove from single page 
add_filter('storebuild_single_wishlist_btn_html', '__return_false');

// Quickview Feature
// remove from archive page 
add_filter('storebuild_archive_quickview_btn_html', '__return_false');

// remove from single page 
add_filter('storebuild_single_quickview_btn_html', '__return_false');



// modify HTML
add_filter('storebuild_wishlist_btn_html', function ($html, $atts, $is_wishlisted) {
    // var_dump($atts);
    if ($is_wishlisted) {
        return sprintf('<button type="button" class="%s tp-product-details-action-sm-btn" data-id="%d">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"></path></svg>
            Added
        </button>',
            esc_attr($atts['class']),
            esc_attr($atts['id']),
        );
    } else {
        return sprintf('<button type="button" class="%s tp-product-details-action-sm-btn" data-id="%d">
            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.33541 7.54172C3.36263 10.6766 7.42094 13.2113 8.49945 13.8387C9.58162 13.2048 13.6692 10.6421 14.6635 7.5446C15.3163 5.54239 14.7104 3.00621 12.3028 2.24514C11.1364 1.8779 9.77578 2.1014 8.83648 2.81432C8.64012 2.96237 8.36757 2.96524 8.16974 2.81863C7.17476 2.08487 5.87499 1.86999 4.69024 2.24514C2.28632 3.00549 1.68259 5.54167 2.33541 7.54172ZM8.50115 15C8.4103 15 8.32018 14.9784 8.23812 14.9346C8.00879 14.8117 2.60674 11.891 1.29011 7.87081C1.28938 7.87081 1.28938 7.8701 1.28938 7.8701C0.462913 5.33895 1.38316 2.15812 4.35418 1.21882C5.7492 0.776121 7.26952 0.97088 8.49895 1.73195C9.69029 0.993159 11.2729 0.789057 12.6401 1.21882C15.614 2.15956 16.5372 5.33966 15.7115 7.8701C14.4373 11.8443 8.99571 14.8088 8.76492 14.9332C8.68286 14.9777 8.592 15 8.50115 15Z" fill="currentColor" />
                <path d="M8.49945 13.8387L8.42402 13.9683L8.49971 14.0124L8.57526 13.9681L8.49945 13.8387ZM14.6635 7.5446L14.5209 7.4981L14.5207 7.49875L14.6635 7.5446ZM12.3028 2.24514L12.348 2.10211L12.3478 2.10206L12.3028 2.24514ZM8.83648 2.81432L8.92678 2.93409L8.92717 2.9338L8.83648 2.81432ZM8.16974 2.81863L8.25906 2.69812L8.25877 2.69791L8.16974 2.81863ZM4.69024 2.24514L4.73548 2.38815L4.73552 2.38814L4.69024 2.24514ZM8.23812 14.9346L8.16727 15.0668L8.16744 15.0669L8.23812 14.9346ZM1.29011 7.87081L1.43266 7.82413L1.39882 7.72081H1.29011V7.87081ZM1.28938 7.8701L1.43938 7.87009L1.43938 7.84623L1.43197 7.82354L1.28938 7.8701ZM4.35418 1.21882L4.3994 1.36184L4.39955 1.36179L4.35418 1.21882ZM8.49895 1.73195L8.42 1.85949L8.49902 1.90841L8.57801 1.85943L8.49895 1.73195ZM12.6401 1.21882L12.6853 1.0758L12.685 1.07572L12.6401 1.21882ZM15.7115 7.8701L15.5689 7.82356L15.5686 7.8243L15.7115 7.8701ZM8.76492 14.9332L8.69378 14.8011L8.69334 14.8013L8.76492 14.9332ZM2.19287 7.58843C2.71935 9.19514 4.01596 10.6345 5.30013 11.744C6.58766 12.8564 7.88057 13.6522 8.42402 13.9683L8.57487 13.709C8.03982 13.3978 6.76432 12.6125 5.49626 11.517C4.22484 10.4185 2.97868 9.02313 2.47795 7.49501L2.19287 7.58843ZM8.57526 13.9681C9.12037 13.6488 10.4214 12.8444 11.7125 11.729C12.9999 10.6167 14.2963 9.17932 14.8063 7.59044L14.5207 7.49875C14.0364 9.00733 12.7919 10.4 11.5164 11.502C10.2446 12.6008 8.9607 13.3947 8.42364 13.7093L8.57526 13.9681ZM14.8061 7.59109C15.1419 6.5613 15.1554 5.39131 14.7711 4.37633C14.3853 3.35729 13.5989 2.49754 12.348 2.10211L12.2576 2.38816C13.4143 2.75381 14.1347 3.54267 14.4905 4.48255C14.8479 5.42648 14.8379 6.52568 14.5209 7.4981L14.8061 7.59109ZM12.3478 2.10206C11.137 1.72085 9.72549 1.95125 8.7458 2.69484L8.92717 2.9338C9.82606 2.25155 11.1357 2.03494 12.2577 2.38821L12.3478 2.10206ZM8.74618 2.69455C8.60221 2.8031 8.40275 2.80462 8.25906 2.69812L8.08043 2.93915C8.33238 3.12587 8.67804 3.12163 8.92678 2.93409L8.74618 2.69455ZM8.25877 2.69791C7.225 1.93554 5.87527 1.71256 4.64496 2.10213L4.73552 2.38814C5.87471 2.02742 7.12452 2.2342 8.08071 2.93936L8.25877 2.69791ZM4.64501 2.10212C3.39586 2.49722 2.61099 3.35688 2.22622 4.37554C1.84299 5.39014 1.85704 6.55957 2.19281 7.58826L2.478 7.49518C2.16095 6.52382 2.15046 5.42513 2.50687 4.48154C2.86175 3.542 3.58071 2.7534 4.73548 2.38815L4.64501 2.10212ZM8.50115 14.85C8.43415 14.85 8.36841 14.8341 8.3088 14.8023L8.16744 15.0669C8.27195 15.1227 8.38645 15.15 8.50115 15.15V14.85ZM8.30897 14.8024C8.19831 14.7431 6.7996 13.9873 5.26616 12.7476C3.72872 11.5046 2.07716 9.79208 1.43266 7.82413L1.14756 7.9175C1.81968 9.96978 3.52747 11.7277 5.07755 12.9809C6.63162 14.2373 8.0486 15.0032 8.16727 15.0668L8.30897 14.8024ZM1.29011 7.72081C1.31557 7.72081 1.34468 7.72745 1.37175 7.74514C1.39802 7.76231 1.41394 7.78437 1.42309 7.8023C1.43191 7.81958 1.43557 7.8351 1.43727 7.84507C1.43817 7.8504 1.43869 7.85518 1.43898 7.85922C1.43913 7.86127 1.43923 7.8632 1.43929 7.865C1.43932 7.86591 1.43934 7.86678 1.43936 7.86763C1.43936 7.86805 1.43937 7.86847 1.43937 7.86888C1.43937 7.86909 1.43937 7.86929 1.43938 7.86949C1.43938 7.86959 1.43938 7.86969 1.43938 7.86979C1.43938 7.86984 1.43938 7.86992 1.43938 7.86994C1.43938 7.87002 1.43938 7.87009 1.28938 7.8701C1.13938 7.8701 1.13938 7.87017 1.13938 7.87025C1.13938 7.87027 1.13938 7.87035 1.13938 7.8704C1.13938 7.8705 1.13938 7.8706 1.13938 7.8707C1.13938 7.8709 1.13938 7.87111 1.13938 7.87131C1.13939 7.87173 1.13939 7.87214 1.1394 7.87257C1.13941 7.87342 1.13943 7.8743 1.13946 7.8752C1.13953 7.87701 1.13962 7.87896 1.13978 7.88103C1.14007 7.88512 1.14059 7.88995 1.14151 7.89535C1.14323 7.90545 1.14694 7.92115 1.15585 7.93861C1.16508 7.95672 1.18114 7.97896 1.20762 7.99626C1.2349 8.01409 1.26428 8.02081 1.29011 8.02081V7.72081ZM1.43197 7.82354C0.623164 5.34647 1.53102 2.26869 4.3994 1.36184L4.30896 1.0758C1.23531 2.04755 0.302663 5.33142 1.14679 7.91665L1.43197 7.82354ZM4.39955 1.36179C5.7527 0.932384 7.22762 1.12136 8.42 1.85949L8.57791 1.60441C7.31141 0.820401 5.74571 0.619858 4.30881 1.07585L4.39955 1.36179ZM8.57801 1.85943C9.73213 1.14371 11.2694 0.945205 12.5951 1.36192L12.685 1.07572C11.2763 0.632908 9.64845 0.842602 8.4199 1.60447L8.57801 1.85943ZM12.5948 1.36184C15.4664 2.27018 16.3769 5.34745 15.5689 7.82356L15.8541 7.91663C16.6975 5.33188 15.7617 2.04893 12.6853 1.07581L12.5948 1.36184ZM15.5686 7.8243C14.9453 9.76841 13.2952 11.4801 11.7526 12.7288C10.2142 13.974 8.80513 14.7411 8.69378 14.8011L8.83606 15.0652C8.9555 15.0009 10.3826 14.2236 11.9413 12.9619C13.4957 11.7037 15.2034 9.94602 15.8543 7.91589L15.5686 7.8243ZM8.69334 14.8013C8.6337 14.8337 8.56752 14.85 8.50115 14.85V15.15C8.61648 15.15 8.73201 15.1217 8.83649 15.065L8.69334 14.8013Z" fill="currentColor" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.8384 6.93209C12.5548 6.93209 12.3145 6.71865 12.2911 6.43693C12.2427 5.84618 11.8397 5.34743 11.266 5.1656C10.9766 5.07361 10.8184 4.76962 10.9114 4.48718C11.0059 4.20402 11.3129 4.05023 11.6031 4.13934C12.6017 4.45628 13.3014 5.32371 13.3872 6.34925C13.4113 6.64606 13.1864 6.90622 12.8838 6.92993C12.8684 6.93137 12.8538 6.93209 12.8384 6.93209Z" fill="currentColor" />
                <path d="M12.8384 6.93209C12.5548 6.93209 12.3145 6.71865 12.2911 6.43693C12.2427 5.84618 11.8397 5.34743 11.266 5.1656C10.9766 5.07361 10.8184 4.76962 10.9114 4.48718C11.0059 4.20402 11.3129 4.05023 11.6031 4.13934C12.6017 4.45628 13.3014 5.32371 13.3872 6.34925C13.4113 6.64606 13.1864 6.90622 12.8838 6.92993C12.8684 6.93137 12.8538 6.93209 12.8384 6.93209" stroke="currentColor" stroke-width="0.3" />
            </svg>
            Add to Wishlist
        </button>',
            esc_attr($atts['class']),
            esc_attr($atts['id']),
        );
    }
}, 10, 3);


// Compare Feature
// remove from archive page 
add_filter('storebuild_archive_compare_btn_html', '__return_false');

// remove from single page 
add_filter('storebuild_single_compare_btn_html', '__return_false');

// modify HTML
add_filter('storebuild_compare_btn_html', function ($html, $attrs) {

    return sprintf(
        '<button type="button" class="%s tp-product-details-action-sm-btn" data-id="%d">
                <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 3.16431H10.8622C12.0451 3.16431 12.9999 4.08839 12.9999 5.23315V7.52268" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M3.25177 0.985168L1 3.16433L3.25177 5.34354" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12.9999 12.5983H3.13775C1.95486 12.5983 1 11.6742 1 10.5295V8.23993" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M10.748 14.7774L12.9998 12.5983L10.748 10.4191" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Compare
        </button>',
        esc_attr($attrs['class']),
        esc_attr($attrs['id']),
    );
}, 10, 2);

// product add to cart button
function agntix_wooc_add_to_cart($args = array())
{
    global $product;

    if ($product) {
        $defaults = array(
            'quantity' => 1,
            'class' => implode(
                ' ',
                array_filter(
                    array(
                        'tp-action-btn text-center',
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                        $product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                    )
                )
            ),
            'attributes' => array(
                'data-product_id' => $product->get_id(),
                'data-product_sku' => $product->get_sku(),
                'aria-label' => $product->add_to_cart_description(),
                'rel' => 'nofollow',
            ),
        );

        $args = wp_parse_args($args, $defaults);

        if (isset($args['attributes']['aria-label'])) {
            $args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
        }
    }


    // check product type 
    if ($product->is_type('simple')) {
        $btntext = esc_html__("Add to Cart", 'agntix');
    } elseif ($product->is_type('variable')) {
        $btntext = esc_html__("Select Options", 'agntix');
    } elseif ($product->is_type('external')) {
        $btntext = esc_html__("Buy Now", 'agntix');
    } elseif ($product->is_type('grouped')) {
        $btntext = esc_html__("View Products", 'agntix');
    } else {
        $btntext = esc_html__("Add to Cart", 'agntix');
    }

    echo sprintf(
        '<a title="%s" href="%s" data-quantity="%s" class="%s" %s>%s</a>',
        $btntext,
        esc_url($product->add_to_cart_url()),
        esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
        esc_attr(isset($args['class']) ? $args['class'] : 'tp-action-btn'),
        isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
        $btntext
    );
}


// agntix_product_grid 
function agntix_product_grid()
{
    $post_cats = get_the_terms(get_the_ID(), 'product_cat');
    global $product;
    $product_id = $product->get_id();
    ?>

    <div class="tp-product-item mb-40">
        <div class="tp-product-item-thumb">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
            <?php if (function_exists('storebuild_init')): ?>
                <div class="tp-product-quick-view-wrapper">
                    <button class="tp-quick-view-btn strb-quickview-btn" data-id="<?php echo esc_attr($product_id); ?>"><svg
                            width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.99948 5.06828C7.80247 5.06828 6.82956 6.04044 6.82956 7.23542C6.82956 8.42951 7.80247 9.40077 8.99948 9.40077C10.1965 9.40077 11.1703 8.42951 11.1703 7.23542C11.1703 6.04044 10.1965 5.06828 8.99948 5.06828ZM8.99942 10.7482C7.0581 10.7482 5.47949 9.17221 5.47949 7.23508C5.47949 5.29705 7.0581 3.72021 8.99942 3.72021C10.9407 3.72021 12.5202 5.29705 12.5202 7.23508C12.5202 9.17221 10.9407 10.7482 8.99942 10.7482Z"
                                fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M1.41273 7.2346C3.08674 10.9265 5.90646 13.1215 8.99978 13.1224C12.0931 13.1215 14.9128 10.9265 16.5868 7.2346C14.9128 3.54363 12.0931 1.34863 8.99978 1.34773C5.90736 1.34863 3.08674 3.54363 1.41273 7.2346ZM9.00164 14.4703H8.99804H8.99714C5.27471 14.4676 1.93209 11.8629 0.0546754 7.50073C-0.0182251 7.33091 -0.0182251 7.13864 0.0546754 6.96883C1.93209 2.60759 5.27561 0.00288103 8.99714 0.000185582C8.99894 -0.000712902 8.99894 -0.000712902 8.99984 0.000185582C9.00164 -0.000712902 9.00164 -0.000712902 9.00254 0.000185582C12.725 0.00288103 16.0676 2.60759 17.945 6.96883C18.0188 7.13864 18.0188 7.33091 17.945 7.50073C16.0685 11.8629 12.725 14.4676 9.00254 14.4703H9.00164Z"
                                fill="currentColor"></path>
                        </svg></button>
                </div>
            <?php endif; ?>

            <div class="tp-product-item-btn">
                <?php agntix_wooc_add_to_cart(); ?>
            </div>
        </div>
        <div class="tp-product-item-content d-flex justify-content-between align-content-center">
            <h4 class="tp-product-item-title"><a class="tp-line-black"
                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <span class="tp-product-item-price"><?php woocommerce_template_loop_price(); ?></span>
        </div>
    </div>

    <?php
}

add_action('woocommerce_before_shop_loop_item', 'agntix_product_grid');

function agntix_product_details()
{
    global $product;
    $post_cats = get_the_terms(get_the_ID(), 'product_cat');
    $rating_count = $product->get_rating_count();
    // var_dump($product); 
    ?>
    <div class="tp-product-details-wrapper">
        <?php if (!empty($post_cats)): ?>
            <div class="tp-product-details-category">
                <?php
                $html = '';
                foreach ($post_cats as $key => $cat) {

                    $html .= '<span>' . $cat->name . '</span>,';

                }
                echo rtrim($html, ',');
                ?>
            </div>
        <?php endif; ?>
        <h3 class="tp-product-details-title"><?php echo the_title(); ?></h3>

        <!-- inventory details -->
        <div class="tp-product-details-inventory d-flex align-items-center mb-10">
            <div class="tp-product-details-stock mb-10">
                <span><?php echo esc_html($product->get_stock_status()); ?></span>
            </div>
            <div class="tp-product-details-rating-wrapper d-flex align-items-center mb-10">
                <?php if ($rating_count > 0): ?>
                    <?php woocommerce_template_single_rating(); ?>
                <?php else: ?>
                    <div class="tp-product-details-reviews">
                        <span><?php echo esc_html('(0 Ratings)', 'agntix'); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php echo woocommerce_template_single_excerpt(); ?>

        <!-- price -->
        <div class="tp-product-details-price-wrapper mb-20">
            <?php woocommerce_template_single_price(); ?>
        </div>

        <!-- variations -->
        <div class="tp-product-details-variation">
            <?php if (class_exists('Tp_Wvs')) {
                echo do_shortcode('[pure_wc_swatches]');
            } ?>
        </div>

        <!-- actions -->
        <div class="tp-product-details-action-wrapper">
            <?php if (!$product->is_type('external')): ?>
                <h3 class="tp-product-details-action-title"><?php esc_html_e('Quantity', 'agntix'); ?></h3>
            <?php endif; ?>

            <?php woocommerce_template_single_add_to_cart(); ?>
        </div>

        <?php if (class_exists('Storebuild\Frontend\StoreBuild_Wishlists') && class_exists('Storebuild\Frontend\StoreBuild_Compare')): ?>
            <div class="tp-product-details-action-sm">
                <?php if (class_exists('Storebuild\Frontend\StoreBuild_Wishlists')): ?>
                    <?php echo do_shortcode('[storebuild_wishlist]'); ?>
                <?php endif; ?>

                <?php if (class_exists('Storebuild\Frontend\StoreBuild_Compare')): ?>
                    <?php echo do_shortcode('[storebuild_compare]'); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php woocommerce_template_single_meta(); ?>

        <div class="tp-product-details-social">
            <?php
            $post_url = urlencode(get_permalink());
            $post_title = urlencode(get_the_title());
            ?>
            <span><?php esc_html_e('Share:', 'agntix'); ?> </span>
            <!-- Facebook Share -->
            <a href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url ); ?>" target="_blank" rel="noopener">
                <i class="fa-brands fa-facebook-f"></i>
            </a>

            <!-- Twitter (X) Share -->
            <a href="<?php echo esc_url('https://twitter.com/intent/tweet?text=' . urlencode($post_title) . '&url=' . urlencode($post_url)); ?>" target="_blank" rel="noopener">
                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M4.41177 0H0L5.23083 6.87316L0.334618 12.6389H2.59681L6.29998 8.27809L9.58823 12.5988H14L8.6172 5.52593L8.62673 5.53813L13.2614 0.0802914H10.9992L7.55741 4.13336L4.41177 0ZM2.43522 1.20371H3.80866L11.5648 11.395H10.1913L2.43522 1.20371Z"
                        fill="currentcolor"></path>
                </svg>
            </a>

            <!-- LinkedIn Share -->
            <a href="<?php echo esc_url('https://www.linkedin.com/sharing/share-offsite/?url=' . urlencode($post_url)); ?>" target="_blank" rel="noopener">

                <i class="fa-brands fa-linkedin-in"></i>
            </a>
        </div>
    </div>

    <?php
}
add_action('woocommerce_single_product_summary', 'agntix_product_details');



// Add "Buy Now" button next to Add to Cart button

function agntix_add_buy_now_button()
{
    global $product;

    if (!$product || !is_a($product, 'WC_Product')) {
        return;
    }

    $product_id = $product->get_id();
    $checkout_url = wc_get_checkout_url();

    $agntix_buy_now_text = get_theme_mod('agntix_buy_now_text', __('Buy Now', 'agntix'));
    $agntix_buy_now_switch = get_theme_mod('agntix_buy_now_switch', true);

    // Show the button only if the switch is enabled (i.e. true)
    if ($agntix_buy_now_switch) {
        echo '<a href="' . esc_url($checkout_url . '?add-to-cart=' . $product_id) . '" class="tp-product-details-buy-now-btn w-100 text-center mt-15">
            <button type="button">' . esc_html($agntix_buy_now_text) . '</button>
        </a>';
    }
}


add_action('agntix_woocommerce_buy_now_button', 'agntix_add_buy_now_button');