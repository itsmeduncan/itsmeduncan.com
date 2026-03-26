# ItsMeDuncan WordPress Theme

A custom WordPress theme built for [itsmeduncan.com](https://itsmeduncan.com) — a personal blog about AI implementation, engineering leadership, and building at scale.

![Theme Screenshot](screenshot.png)

## Features

- Dark hero section with Jetpack Newsletter email capture
- Featured posts grid on homepage with customizer-selected posts
- Auto-generated Table of Contents from H2 headings
- Floating social share bar (LinkedIn, X/Twitter, Copy Link)
- Mid-post email CTA injection (after 3rd H2 via `the_content` filter)
- Related posts section ("You might also like") by category
- Dark mode via `prefers-color-scheme: dark`
- JSON-LD structured data (WebSite, Article, Person schemas)
- Open Graph meta tags
- XML sitemap ping on publish
- Branded fallback cards for posts without featured images
- Category color-coding (teal, blue, purple, amber)
- Fully responsive with breakpoints at 768px and 640px

## Requirements

- WordPress 6.0+
- PHP 8.0+
- Jetpack plugin (for newsletter subscription forms)

## Installation

1. Clone this repository into `wp-content/themes/itsmeduncan/`
2. Activate the theme in **Appearance > Themes**
3. Configure via **Appearance > Customize**

Or download a zip and upload via **Appearance > Themes > Add New > Upload Theme**.

### Build a distributable zip

```bash
zip -r itsmeduncan-theme.zip . -x ".*" "LICENSE" "README.md" "CLAUDE.md" ".editorconfig" "node_modules/*"
```

## Customizer Options

- **Hero Section** — headline, subheadline, photo, CTA text
- **Email Capture** — Jetpack form, external provider URL, or custom embed HTML
- **Social Links** — LinkedIn, Twitter/X, GitHub URLs
- **Featured Posts** — comma-separated post IDs for homepage grid
- **Author Card** — photo, bio, and links shown on single posts

## Design

| Token | Value |
|---|---|
| Accent color | `#0d9488` (teal) |
| Dark background | `#0f172a` |
| Heading font | DM Sans (800 weight) |
| Body font | IBM Plex Sans (400/500) |
| Max width | 960px |
| Content width | 720px |

## Constraints

- No jQuery — vanilla JavaScript only
- No external icon fonts — inline SVGs
- All CSS in `style.css` (single file, no build step)
- WordPress coding standards: proper escaping, translation-ready, sanitized inputs
- Compatible with WordPress.com managed hosting

## File Structure

```
├── style.css           # Theme metadata + all CSS (including dark mode)
├── functions.php       # Setup, customizer, helpers, content filters
├── header.php          # Nav, OG tags, JSON-LD schema markup
├── footer.php          # Multi-column footer, email CTA, social links
├── front-page.php      # Homepage: hero, featured posts, recent posts
├── single.php          # Post: header, TOC, share bar, content, related, author
├── page.php            # Static pages
├── index.php           # Blog archive / category / tag fallback
├── search.php          # Search results
├── 404.php             # Error page
├── comments.php        # Intentionally blank (comments disabled)
├── screenshot.png      # Theme preview (1200x900)
└── assets/js/
    └── navigation.js   # Mobile menu toggle
```

## License

GPL-2.0-or-later. See [LICENSE](LICENSE) for details.
