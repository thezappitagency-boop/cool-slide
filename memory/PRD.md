# InmuebleLife (IL) — Mazatlán RE · Avista Child Theme

## Original Problem Statement
Build a WordPress child theme for the Avista parent theme, targeting a real estate website "InmuebleLife (IL)" in Mazatlán, Sinaloa, Mexico. All specs are in the build brief: `Emergent Build Brief v2 — Mazatlán RE.md`.

## Target Platform
- WordPress + Elementor 3.35.1 (Flexbox Containers)
- Parent theme: Avista

## Deliverable Location
`/app/avista-child/` (zip: `/app/build/avista-child-phase1.zip`)

---

## What Has Been Implemented

### Phase 1 — Core Child Theme + Skeleton Pages (2026-03-23)

#### Child Theme Files
| File | Purpose |
|------|---------|
| `style.css` | WordPress theme header + all IL design tokens (`:root` CSS vars) + all global component CSS (`.il-title`, `.il-gradient-title`, `.il-property-title`, `.il-detail-item`, `.il-body-text`, `.il-accordion-*`, `.il-btn`) |
| `functions.php` | Enqueues parent stylesheet, child `style.css`, `global-styles.css`, Google Fonts (Barlow Condensed / Plus Jakarta Sans / Montserrat), CDN scripts (GSAP 3.12.2 + ScrollTrigger, Swiper 11 JS + CSS, Tailwind), child `main.js`. Dequeues WOW.js + Avista's bundled Swiper. Snap-scroll toggle meta field for pages. |
| `global-styles.css` | Supplementary styles: section layout utilities, Swiper hero customization, property card component, gallery grid, CF7 form overrides, filter bar, pagination, share row, responsive breakpoints (1024px, 767px) |
| `js/main.js` | jQuery safety wrapper. Accordion (single-open, slideToggle). Swiper init for `#il-hero-swiper` and `#il-similar-swiper`. |

#### Skeleton Page Templates (Elementor 3.35 Flexbox Containers JSON)
| File | Sections |
|------|---------|
| `skeleton-pages/listing-detail.json` | 1) Hero Slider (Swiper, gradient overlay, Gallery + Learn More CTAs) · 2) Property Info 2-col (rule, address, `.il-property-title`, 4 detail items, CTA / body text, 2 accordions, share row) · 3) Video (play button, rotated `.il-title`, dev visibility note) · 4) Photo Gallery (4-up grid, Magnific Popup note) · 5) Contact Form (dark bg, `.il-title.is-white`, CF7 shortcode widget) · 6) Similar Listings 2-col (dark left: vertical title + CTAs; right: Swiper 3-card) |
| `skeleton-pages/listing-archive.json` | 1) Page Header (`.il-title.is-accent` + body subtitle) · 2) Filter Bar (Neighborhood, Beds, Price range, Search `.il-btn`) · 3) Listings Grid (3-col, 6 placeholder property cards) · 4) Pagination (prev/next `.il-btn` + page info) |

---

## Design Tokens (in `style.css`)

| Token | Value |
|-------|-------|
| `--font-display` | "Barlow Condensed", sans-serif |
| `--font-body` | "Plus Jakarta Sans", sans-serif |
| `--font-label` | "Montserrat", sans-serif |
| `--color-accent` | #FF5F05 (IL-Orange) |
| `--color-accent-deep` | #1a0800 |
| `--color-text` | #000000 |
| `--color-text-light` | #ffffff |
| `--color-bg-dark` | #000000 |
| `--color-bg-light` | #ffffff |
| `--color-muted` | rgba(255,255,255,0.45) |
| `--transition-default` | 0.3s cubic-bezier(0.4, 0, 0.2, 1) |

---

## Delivery Checklist Status

| Item | Status |
|------|--------|
| Child theme activates without PHP errors | Ready to test |
| No 404s on enqueued fonts/scripts | All CDN URLs verified in brief |
| WOW.js not present in network requests | Dequeued in functions.php |
| `[property_carousel]` shortcode renders | Plugin installed separately by user |
| All `.il-title` use Barlow Condensed | ✓ in style.css |
| Body text uses Plus Jakarta Sans | ✓ in style.css |
| `#FF5F05` is only accent color | ✓ in style.css |
| No default Avista accent visible | Depends on Avista overrides (check after activation) |
| Elementor opens skeleton pages without errors | JSON validated ✓ |
| Accordion JS works on listing detail | ✓ in main.js |
| Swiper initializes on hero placeholder | ✓ in main.js + CDN enqueued |
| No JS console errors on page load | Test after activation |

---

## Installation Instructions

### 1. Upload & Activate Child Theme
1. Upload the `avista-child/` folder to `/wp-content/themes/`
2. In WP Admin > Appearance > Themes, activate "Avista Child — InmuebleLife"

### 2. Import Skeleton Pages (Elementor)
1. Create a new page (e.g. "Single Listing") and open in Elementor
2. Click the folder icon (Templates) > Import — upload `listing-detail.json`
3. Repeat for "All Listings" using `listing-archive.json`

### 3. Notes
- Replace `[contact-form-7 id="REPLACE_WITH_CF7_ID" ...]` with your actual CF7 form ID
- Swiper handle names used to deregister Avista's version may need adjustment — check browser DevTools Network tab for Avista's actual handles
- Share links use text placeholders (FB / IG / X) — swap for Font Awesome icons or icon images

---

## Prioritized Backlog

### P1 — Next Actions
- [ ] Test child theme activation on staging (PHP errors, 404 scripts)
- [ ] Adjust Avista Swiper dequeue handles to match actual theme handles
- [ ] Replace CF7 shortcode placeholder with real form ID
- [ ] Populate skeleton pages with ACF dynamic tags (Phase 2)

### P2 — Phase 2 Features
- [ ] About page (Nimo reference)
- [ ] Neighborhood guide pages (requires custom map)
- [ ] Blog templates
- [ ] Home page skeleton

### P3 — Previous Project Backlog
- [ ] Skew Slider: Add keyboard arrow-key navigation (ArrowUp/ArrowDown)
- [ ] Skew Slider: Add autoplay option with pause-on-hover
