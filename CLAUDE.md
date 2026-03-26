# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

Custom WordPress theme "ItsMeDuncan" v2.0.0 for [itsmeduncan.com](https://itsmeduncan.com) — a WordPress.com Business plan site (site ID 151511014) focused on AI implementation and engineering leadership content.

## Deployment

Theme is deployed via WP-CLI over SSH:

```bash
# Build zip (excludes repo files)
zip -r itsmeduncan-theme.zip . -x ".*" "LICENSE" "README.md" "CLAUDE.md" ".editorconfig" "node_modules/*"

# Upload and activate
scp itsmeduncan-theme.zip itsmeduncan.wordpress.com@sftp.wp.com:/tmp/
ssh itsmeduncan.wordpress.com@sftp.wp.com "wp theme install /tmp/itsmeduncan-theme.zip --force --activate"
```

## Key features

- Open Graph meta tags (dynamic per page type)
- JSON-LD schema: WebSite (homepage), Article (posts), Person (About page)
- Auto-injected mid-post email CTA (after 3rd H2 via `the_content` filter)
- Table of contents generated from H2 headings (collapsible `<details>`)
- H2 anchor IDs added via content filter (priority 5)
- Floating social share bar (LinkedIn, Twitter/X, Copy Link) — desktop only
- Related posts ("You might also like") from same category
- Dark mode via `prefers-color-scheme: dark`
- XML sitemap ping to Google/Bing on `publish_post`
- Branded fallback cards for posts without featured images
- Customizer sections: Hero, Email Capture, Social Links, Featured Posts, Author Card
- Front page pagination redirect (`/page/N/` → `/blog/`)

## Design tokens

- Accent: `#0d9488` (teal)
- Dark bg: `#0f172a`
- Fonts: DM Sans (headings, 800), IBM Plex Sans (body, 400/500)
- Max width: 960px, content width: 720px

## Constraints

- No jQuery — vanilla JS only
- No external icon fonts — inline SVGs
- All CSS in `style.css` (no separate files)
- WordPress coding standards: proper escaping, translation-ready, sanitized inputs
- Must work on WordPress.com managed hosting (no .htaccess)
