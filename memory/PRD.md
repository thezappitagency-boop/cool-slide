# Cool Slide – Skew Slider Extraction

## Original Problem
Extract the skew slider demo from the Agntix/cool-slide WordPress theme into:
A) An Elementor widget plugin
B) A standalone HTML/CSS/JS stack

## Source Repo
`/app` = cool-slide theme (Agntix). Key source files:
- `assets/js/skew-slider/{index,slideshow,utils}.js`
- `assets/scss/layout/pages/_project-slider.scss` (lines 726–900)
- `assets/fonts/ClashDisplay-Semibold.{woff,woff2}`
- `assets/fonts/MangoGrotesque-Regular.{woff,woff2}`
- `assets/js/Observer.min.js` (GSAP Observer plugin)

## What Was Built (2025-03-18)

### Option A – Elementor Widget Plugin
- `/app/build/cool-slide-skew-widget.zip` (88 KB, ready to install)
- Files: `cool-slide-skew-widget.php`, `widgets/class-skew-slider-widget.php`,
  `assets/css/skew-slider.css`, `assets/js/skew-slider-bundle.js`,
  `assets/js/Observer.min.js`, `assets/fonts/*`
- Widget controls: Slides repeater (image, category, title line 1+2, URL),
  copyright/CTA text, social links repeater, prev/next button labels
- Loads GSAP from CDN if not already registered by theme (safe for non-Agntix sites)
- Elementor editor preview via `content_template()`

### Option B – Standalone HTML/CSS/JS
- `/app/build/cool-slide-standalone.zip` (85 KB, open index.html)
- Files: `index.html`, `css/skew-slider.css`, `js/skew-slider-bundle.js`,
  `js/Observer.min.js`, `fonts/*`
- GSAP from CDN, imagesLoaded from unpkg
- Self-contained, edit slides directly in HTML comments

## Architecture
- JS bundle = utils.js + slideshow.js + index.js concatenated (no module bundler needed)
- GSAP 3.12.5 + Observer plugin for wheel/touch/pointer navigation
- CSS custom properties for white/black + @font-face for ClashDisplay-Semibold
- Responsive breakpoints: 1399/1199/991/767px

## What Was Built – V2 (2026-03-23)

### V2 – Blank / Shortcode Shell (preserves V1 completely)

**Standalone:**
- `/app/build/cool-slide-standalone-v2.zip` – open `standalone/index-v2.html`
- Full-screen (no demo sections above/below); slides are blank background images
- Add content per slide via `<div class="skew-slider-content">` or shortcode HTML
- Navigation: chevron-up SVG (bottom-left = Prev) / chevron-down SVG (bottom-right = Next)
- Same GSAP ScrollTrigger pin behaviour as V1

**Elementor Plugin:**
- `/app/build/cool-slide-skew-widget-v2.zip` (install like V1 — no conflicts)
- Repeater fields: Background Image + Slide Content / Shortcode (textarea)
- Shortcode is passed through `do_shortcode()` on the front end
- Editor preview shows shortcode text inside a tinted label (shortcodes not executed in preview)
- Navigation: chevron SVG icons; all other controls (copyright, social, CTA) identical to V1

**V2 Key Files:**
- `build/standalone/index-v2.html`
- `build/elementor-widget/cool-slide-skew-widget-v2/cool-slide-skew-widget-v2.php`
- `build/elementor-widget/cool-slide-skew-widget-v2/widgets/class-skew-slider-v2-widget.php`

## Backlog / Next Steps
- [ ] Replace picsum placeholder images with real project images
- [ ] P2: Add keyboard arrow-key navigation (ArrowUp/ArrowDown)
- [ ] P2: Add autoplay option with pause-on-hover
- [ ] Optional: Style tab in Elementor widget (title size, content padding)
