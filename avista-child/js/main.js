/**
 * Avista Child — InmuebleLife
 * js/main.js
 *
 * jQuery safety wrapper.
 * - Accordion open/close with .il-accordion-trigger
 * - Swiper init: hero slider + similar listings slider
 */

(function ($) {
    'use strict';

    /* ============================================================
       ACCORDION
       - Clicking .il-accordion-trigger toggles .is-open on
         the parent .il-accordion-item and slideToggles the
         .il-accordion-panel inside it.
       - All other open items collapse (single-open behaviour).
       ============================================================ */

    $(document).on('click', '.il-accordion-trigger', function () {
        var $trigger = $(this);
        var $item    = $trigger.closest('.il-accordion-item');
        var $panel   = $item.find('.il-accordion-panel').first();
        var isOpen   = $item.hasClass('is-open');

        // Collapse any currently open item in the same accordion
        var $accordion = $item.closest('.il-accordion');
        $accordion.find('.il-accordion-item.is-open').not($item).each(function () {
            $(this).removeClass('is-open').find('.il-accordion-panel').first().slideUp(300);
        });

        // Toggle the clicked item
        if (isOpen) {
            $item.removeClass('is-open');
            $panel.slideUp(300);
        } else {
            $item.addClass('is-open');
            $panel.slideDown(300);
        }
    });


    /* ============================================================
       SWIPER — Hero Slider
       Initialised on #il-hero-swiper if Swiper is available.
       ============================================================ */

    function initHeroSwiper() {
        if (typeof Swiper === 'undefined') return;
        if (!document.getElementById('il-hero-swiper')) return;

        new Swiper('#il-hero-swiper', {
            loop:      true,
            speed:     700,
            autoplay: {
                delay:                  5000,
                disableOnInteraction:   false,
                pauseOnMouseEnter:      true,
            },
            pagination: {
                el:        '.il-hero-swiper-pagination',
                clickable: true,
            },
            keyboard: {
                enabled: true,
            },
        });
    }


    /* ============================================================
       SWIPER — Similar Listings Slider
       ============================================================ */

    function initSimilarSwiper() {
        if (typeof Swiper === 'undefined') return;
        if (!document.getElementById('il-similar-swiper')) return;

        new Swiper('#il-similar-swiper', {
            loop:         true,
            speed:        600,
            slidesPerView: 1.1,
            spaceBetween: 20,
            pagination: {
                el:        '.il-similar-swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 24,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 28,
                },
            },
        });
    }


    /* ============================================================
       DOCUMENT READY
       ============================================================ */

    $(function () {
        initHeroSwiper();
        initSimilarSwiper();
    });

})(jQuery);
