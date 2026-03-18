/*!
 * Cool Slide — Skew Slider Bundle v1.0.0
 * Bundled from: utils.js + slideshow.js + index.js (Agntix / cool-slide theme)
 * Dependencies (loaded before this): gsap.min.js, Observer.min.js, imagesloaded.pkgd.min.js
 */

/* =====================================================================
   utils.js
   ===================================================================== */

/**
 * Preload all background-image elements matching selector.
 * Uses imagesLoaded with { background: true } so it watches CSS backgrounds.
 * @param  {string} selector  CSS selector – default 'img'
 * @returns {Promise}
 */
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
    /**
     * Holds references to DOM elements.
     * @type {Object}
     */
    DOM = {
        el: null,
        slides: null,
        slidesInner: null,
        slideNumber: null
    };

    current      = 0;
    slidesTotal  = 0;
    isAnimating  = false;

    /**
     * @param {HTMLElement} DOM_el – .skew-slider-wrap container
     */
    constructor(DOM_el) {
        this.DOM.el          = DOM_el;
        this.DOM.slides      = [...this.DOM.el.querySelectorAll('.slide')];
        this.DOM.slidesInner = this.DOM.slides.map(item => item.querySelector('.slide__img'));
        this.DOM.slideNumber = document.querySelector('.slides-numbers .active');

        // Give the container a perspective for the 3-D rotationX effect
        gsap.set(this.DOM.el, { perspective: 1000 });

        // Mark first slide as current
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
        // outgoing slide: fly up (or down)
        .to(currentSlide, {
            yPercent: -direction * 100
        }, 'start')
        // incoming slide: rotate from deep 3-D space into place
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
        // image scales from oversized to fill
        .fromTo(upcomingInner, {
            scale: 1.8
        }, {
            scale: 1
        }, 'start+=0.17');
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
   index.js  (initialiser)
   ===================================================================== */

function initSkewSlider() {
    const slidesContainer = document.querySelector('.skew-slider-wrap');
    if (!slidesContainer) return;

    const slideshow = new Slideshow(slidesContainer);

    const prevBtn = document.querySelector('.skew-slider-prev');
    const nextBtn = document.querySelector('.skew-slider-next');

    if (prevBtn) prevBtn.addEventListener('click', () => slideshow.prev());
    if (nextBtn) nextBtn.addEventListener('click', () => slideshow.next());

    // GSAP Observer – wheel / touch / pointer swipe support
    if (typeof Observer !== 'undefined') {
        Observer.create({
            type:       'wheel,touch,pointer',
            onDown:     () => slideshow.prev(),
            onUp:       () => slideshow.next(),
            wheelSpeed: -1,
            tolerance:  10
        });
    }

    // Wait for all background images, then show slider
    preloadImages('.slide__img').then(() => {
        document.body.classList.remove('loading');
    });
}

/* ── Boot ─────────────────────────────────────────────────────────── */

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSkewSlider);
} else {
    initSkewSlider();
}

// Elementor editor: re-run when widget is rendered in the panel
if (window.elementorFrontend && window.elementorFrontend.hooks) {
    window.elementorFrontend.hooks.addAction(
        'frontend/element_ready/cool-slide-skew-slider.default',
        () => initSkewSlider()
    );
}
