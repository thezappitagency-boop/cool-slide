/*!
 * Cool Slide — Skew Slider Bundle v1.0.0
 * Bundled from: utils.js + slideshow.js + index.js (Agntix / cool-slide theme)
 * WordPress dependencies: gsap, gsap-observer, imagesloaded
 */

/* =====================================================================
   utils.js
   ===================================================================== */

const preloadImages = (selector = 'img') => {
    return new Promise((resolve) => {
        imagesLoaded(document.querySelectorAll(selector), { background: true }, resolve);
    });
};


/* =====================================================================
   slideshow.js
   ===================================================================== */

const NEXT = 1;
const PREV = -1;

class Slideshow {
    DOM = {
        el: null,
        slides: null,
        slidesInner: null,
        slideNumber: null
    };

    current     = 0;
    slidesTotal = 0;
    isAnimating = false;

    constructor(DOM_el) {
        this.DOM.el          = DOM_el;
        this.DOM.slides      = [...this.DOM.el.querySelectorAll('.slide')];
        this.DOM.slidesInner = this.DOM.slides.map(item => item.querySelector('.slide__img'));
        this.DOM.slideNumber = DOM_el.closest('.skew-slider-area')
                               ? DOM_el.closest('.skew-slider-area').querySelector('.slides-numbers .active')
                               : document.querySelector('.slides-numbers .active');

        gsap.set(this.DOM.el, { perspective: 1000 });
        this.DOM.slides[this.current].classList.add('slide--current');
        this.slidesTotal = this.DOM.slides.length;
        this.updateSlideNumber();
    }

    next() { this.navigate(NEXT); }
    prev() { this.navigate(PREV); }

    navigate(direction) {
        if (this.isAnimating) return false;
        this.isAnimating = true;

        const previous    = this.current;
        this.current      = direction === NEXT
            ? (this.current < this.slidesTotal - 1 ? ++this.current : 0)
            : (this.current > 0 ? --this.current : this.slidesTotal - 1);

        this.updateSlideNumber();

        const currentSlide  = this.DOM.slides[previous];
        const upcomingSlide = this.DOM.slides[this.current];
        const upcomingInner = this.DOM.slidesInner[this.current];

        gsap.timeline({
            defaults: { duration: 1.2, ease: 'power3.inOut' },
            onStart: () => {
                upcomingSlide.classList.add('slide--current');
                gsap.set(upcomingSlide, { zIndex: 99 });
            },
            onComplete: () => {
                currentSlide.classList.remove('slide--current');
                gsap.set(upcomingSlide, { zIndex: 1 });
                this.isAnimating = false;
            }
        })
        .addLabel('start', 0)
        .to(currentSlide, { yPercent: -direction * 100 }, 'start')
        .fromTo(upcomingSlide, {
            yPercent:  0,
            autoAlpha: 0,
            rotationX: 140,
            scale:     0.1,
            z:         -1000
        }, {
            autoAlpha: 1,
            rotationX: 0,
            z:         0,
            scale:     1
        }, 'start+=0.1')
        .fromTo(upcomingInner, { scale: 1.8 }, { scale: 1 }, 'start+=0.17');
    }

    updateSlideNumber() {
        if (this.DOM.slideNumber) {
            this.DOM.slideNumber.textContent = this.addLeadingZero(this.current + 1);
        }
    }

    addLeadingZero(num) {
        return num < 10 ? `0${num}` : `${num}`;
    }
}


/* =====================================================================
   index.js  – widget initialiser
   ===================================================================== */

/**
 * initialise one slider instance per .skew-slider-wrap on the page.
 * Called on DOMContentLoaded AND by the Elementor frontend hook so it
 * also works inside the Elementor page-builder editor.
 */
function initSkewSliders() {
    document.querySelectorAll('.skew-slider-wrap').forEach(function (container) {
        // Guard: skip if already initialised
        if (container._skewSliderInit) return;
        container._skewSliderInit = true;

        const area     = container.closest('.skew-slider-area') || container.parentElement;
        const slideshow = new Slideshow(container);

        const prevBtn  = area.querySelector('.skew-slider-prev');
        const nextBtn  = area.querySelector('.skew-slider-next');

        if (prevBtn) prevBtn.addEventListener('click', () => slideshow.prev());
        if (nextBtn) nextBtn.addEventListener('click', () => slideshow.next());

        // Scroll / swipe navigation via GSAP Observer (free plugin)
        if (typeof Observer !== 'undefined') {
            Observer.create({
                target:     container,
                type:       'wheel,touch,pointer',
                onDown:     () => slideshow.prev(),
                onUp:       () => slideshow.next(),
                wheelSpeed: -1,
                tolerance:  10
            });
        }

        // Preload background images then reveal
        preloadImages('.slide__img').then(() => {
            document.body.classList.remove('loading');
        });
    });
}

/* ── Boot ─────────────────────────────────────────────────────────── */

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSkewSliders);
} else {
    initSkewSliders();
}

// Elementor editor: re-run when widget renders inside the panel
window.addEventListener('elementor/frontend/init', function () {
    if (!window.elementorFrontend || !window.elementorFrontend.hooks) return;
    window.elementorFrontend.hooks.addAction(
        'frontend/element_ready/cool-slide-skew-slider.default',
        function () { initSkewSliders(); }
    );
});
