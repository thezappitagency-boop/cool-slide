<?php
/**
 * Avista Child — InmuebleLife
 * functions.php
 *
 * Handles:
 *  1. Enqueue parent stylesheet, child stylesheet & global-styles.css
 *  2. Google Fonts (single combined request)
 *  3. CDN scripts: GSAP, GSAP ScrollTrigger, Swiper JS + CSS, Tailwind
 *  4. Child main.js (jQuery accordion + Swiper init)
 *  5. Dequeue / deregister: WOW.js, Avista's bundled Swiper, duplicate jQuery
 *  6. Snap-scroll toggle: custom page meta field
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ============================================================
   1. ENQUEUE STYLES & SCRIPTS
   ============================================================ */

add_action( 'wp_enqueue_scripts', 'il_enqueue_assets', 10 );

function il_enqueue_assets() {

    /* --- Parent theme stylesheet -------------------------------- */
    wp_enqueue_style(
        'avista-parent-style',
        get_template_directory_uri() . '/style.css'
    );

    /* --- Child theme style.css (design tokens + IL components) -- */
    wp_enqueue_style(
        'avista-child-style',
        get_stylesheet_uri(),
        array( 'avista-parent-style' ),
        wp_get_theme()->get( 'Version' )
    );

    /* --- Global supplementary stylesheet ------------------------ */
    wp_enqueue_style(
        'il-global-styles',
        get_stylesheet_directory_uri() . '/global-styles.css',
        array( 'avista-child-style' ),
        wp_get_theme()->get( 'Version' )
    );

    /* --- Google Fonts (single combined request) ----------------- */
    wp_enqueue_style(
        'il-google-fonts',
        'https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,400;0,500;1,100;1,400&family=Plus+Jakarta+Sans:wght@300;400;500&family=Montserrat:wght@400;500&display=swap',
        array(),
        null
    );

    /* --- Swiper CSS (CDN) --------------------------------------- */
    wp_enqueue_style(
        'il-swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        null
    );

    /* --- Tailwind CDN (load in <head>) -------------------------- */
    wp_enqueue_script(
        'il-tailwind',
        'https://cdn.tailwindcss.com',
        array(),
        null,
        false  // in <head>
    );

    /* --- GSAP core (footer, defer) ------------------------------ */
    wp_enqueue_script(
        'il-gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
        array(),
        null,
        true
    );
    wp_script_add_data( 'il-gsap', 'defer', true );

    /* --- GSAP ScrollTrigger (footer, defer) --------------------- */
    wp_enqueue_script(
        'il-gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
        array( 'il-gsap' ),
        null,
        true
    );
    wp_script_add_data( 'il-gsap-scrolltrigger', 'defer', true );

    /* --- Swiper JS (footer, defer) ------------------------------ */
    wp_enqueue_script(
        'il-swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        null,
        true
    );
    wp_script_add_data( 'il-swiper-js', 'defer', true );

    /* --- Child theme main.js ------------------------------------ */
    wp_enqueue_script(
        'il-main-js',
        get_stylesheet_directory_uri() . '/js/main.js',
        array( 'jquery', 'il-swiper-js' ),
        wp_get_theme()->get( 'Version' ),
        true   // in footer
    );
}


/* ============================================================
   2. DEQUEUE / DEREGISTER UNWANTED SCRIPTS
   Running at priority 20 so parent theme has already enqueued.
   NOTE: Check Avista's actual script handles via browser DevTools
         or by inspecting wp_scripts() if names below don't match.
   ============================================================ */

add_action( 'wp_enqueue_scripts', 'il_dequeue_unwanted_assets', 20 );

function il_dequeue_unwanted_assets() {

    /* WOW.js — strip entirely ----------------------------------- */
    $wow_handles = array( 'wow', 'wowjs', 'wow-js', 'avista-wow', 'tp-wow' );
    foreach ( $wow_handles as $handle ) {
        wp_dequeue_script( $handle );
        wp_deregister_script( $handle );
    }

    /* Avista / parent theme bundled Swiper ---------------------- */
    /* Replace handles below with the exact ones Avista uses.
       Common handles: 'swiper', 'swiper-bundle', 'avista-swiper',
       'tp-swiper', 'tp-swiper-bundle' */
    $swiper_handles = array(
        'swiper',
        'swiper-bundle',
        'avista-swiper',
        'tp-swiper',
        'tp-swiper-bundle',
    );
    foreach ( $swiper_handles as $handle ) {
        wp_dequeue_script( $handle );
        wp_deregister_script( $handle );
        wp_dequeue_style( $handle );
        wp_deregister_style( $handle );
    }

    /* Duplicate jQuery — keep WP core version only -------------- */
    /* Uncomment the line below ONLY if the parent theme loads
       its own jQuery separately (causes duplicate loading):       */
    // wp_dequeue_script( 'avista-jquery' );
}


/* ============================================================
   3. SNAP-SCROLL TOGGLE META FIELD
   Adds a checkbox to the Page editor sidebar.
   When checked, the front end gets CSS snap-scroll applied.
   ============================================================ */

add_action( 'add_meta_boxes', 'il_register_snap_scroll_meta_box' );

function il_register_snap_scroll_meta_box() {
    add_meta_box(
        'il-snap-scroll',
        'IL — Snap Scroll',
        'il_snap_scroll_meta_box_html',
        array( 'page', 'post' ),
        'side',
        'default'
    );
}

function il_snap_scroll_meta_box_html( $post ) {
    wp_nonce_field( 'il_snap_scroll_nonce', 'il_snap_scroll_nonce' );
    $value = get_post_meta( $post->ID, '_il_snap_scroll', true );
    echo '<label style="display:flex;align-items:center;gap:8px;cursor:pointer;">';
    echo '<input type="checkbox" name="il_snap_scroll" value="1" ' . checked( $value, '1', false ) . '>';
    echo '<span>Enable CSS snap-scroll on this page</span>';
    echo '</label>';
    echo '<p style="margin:.5em 0 0;color:#666;font-size:11px;">Applies <code>scroll-snap-type: y mandatory</code> to the page and <code>scroll-snap-align: start</code> to each top-level Elementor container.</p>';
}

add_action( 'save_post', 'il_save_snap_scroll_meta' );

function il_save_snap_scroll_meta( $post_id ) {
    if ( ! isset( $_POST['il_snap_scroll_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['il_snap_scroll_nonce'], 'il_snap_scroll_nonce' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $value = isset( $_POST['il_snap_scroll'] ) ? '1' : '0';
    update_post_meta( $post_id, '_il_snap_scroll', $value );
}

/* Output snap-scroll CSS inline if meta is enabled */
add_action( 'wp_head', 'il_apply_snap_scroll_css' );

function il_apply_snap_scroll_css() {
    if ( ! is_singular() ) return;
    $post_id = get_queried_object_id();
    if ( get_post_meta( $post_id, '_il_snap_scroll', true ) !== '1' ) return;

    echo '<style id="il-snap-scroll-css">
html { scroll-snap-type: y mandatory; overflow-y: scroll; }
.e-con, .elementor-section { scroll-snap-align: start; }
</style>' . "\n";
}
