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

## Backlog / Next Steps
- [ ] Replace picsum placeholder images with real project images
- [ ] Add keyboard arrow-key navigation
- [ ] Optional: add autoplay with pause-on-hover
- [ ] Optional: Style tab in Elementor widget (title size, content padding)
