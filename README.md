# Growmodo WordPress Assessment Theme

Custom WordPress theme for the Growmodo WordPress Developer assessment. The theme is based on the duplicated Figma template **Real Estate Business Website UI Template Dark Theme | Produce UI Community Copy** and implements the Estatein real estate website direction.

## Live Dev Site

- Dev URL: `http://44.226.48.168/`
- WordPress Admin: `http://44.226.48.168/wp-admin/`
- AWS notes: see `AWS_DEPLOYMENT.md`.

## Project Overview

The assessment asks for a fully functional WordPress website translated from the provided Figma design. This implementation focuses on the requirements called out in the brief: a custom theme, reusable WordPress components, responsive layouts, basic interactive behavior, editable content paths, accessibility, SEO foundations, performance-conscious assets, and clear documentation.

## Development Process

1. Reviewed the Growmodo assessment brief and extracted the required deliverables.
2. Inspected the duplicated Figma file with the Figma MCP to identify the core page set and visual system.
3. Built a custom theme rather than relying on a page builder, so the codebase demonstrates WordPress theme structure and reusable PHP templates.
4. Created fallback content and local image assets so the theme has a polished first-run experience even before an admin adds posts or ACF fields.
5. Added documentation and submission notes to make the final handoff straightforward.

## Implemented Pages

- Home: hero, quick property actions, featured properties, services, process, and contact CTA.
- About Us: brand overview and credibility metrics.
- Properties: listing grid using the `property` custom post type with fallback listings.
- Property Details: single property template with image, specs, description, and price.
- Services: service grid using the `service` custom post type with fallback service cards.
- Contact: contact intro and working WordPress form handler.

## Theme Structure

- `functions.php`: theme setup, assets, menus, custom post types, Customizer defaults, and contact form handler.
- `template-parts/`: reusable cards and page sections.
- `page-templates/`: dedicated templates for About Us, Properties, Services, and Contact.
- `assets/css/main.css`: responsive Estatein-inspired dark UI.
- `assets/js/main.js`: mobile navigation and contact success behavior.
- `assets/images/`: local property imagery exported from the Figma design context.

## Content Management

The theme registers:

- `property` custom post type for real estate listings.
- `service` custom post type for service cards.

Advanced Custom Fields is optional. If installed, create these fields for the `property` post type:

- `price`
- `bedrooms`
- `bathrooms`
- `property_type`

If ACF is not installed, the theme uses safe fallback values through `growmodo_assessment_field()`.

## Plugins and Tools

- Required plugins: none.
- Optional plugin: Advanced Custom Fields for richer property editing.
- Figma MCP was used to inspect the duplicated design file.

## Local Setup

### Option A: Docker Setup

This repository includes a complete local Docker setup. It starts WordPress on port `8080`, mounts this folder as the active theme, creates the required pages, assigns templates, creates a menu, and adds sample Properties and Services.

Requirements:

- Docker Desktop running.

Commands:

```bash
docker compose up -d
./bin/setup-local.sh
```

Open:

- Site: `http://localhost:8080`
- Admin: `http://localhost:8080/wp-admin`
- Login: `admin`
- Password: `password`

To stop the local site:

```bash
docker compose down
```

To remove the local database and WordPress volume:

```bash
docker compose down -v
```

### Option B: Existing WordPress Install

1. Copy this folder into `wp-content/themes/growmodo-assessment`.
2. In WordPress Admin, go to Appearance > Themes and activate **Growmodo Assessment Theme**.
3. The theme activation creates Home, About Us, Properties, Services, Contact, menus, sample Properties, sample Services, static homepage settings, and pretty permalinks when they are missing.
4. Optional: add or edit Property and Service posts. If no posts exist, the templates still show fallback content.

## Dev URL Deployment

The prepared WordPress upload package is:

```text
dist/growmodo-assessment-theme.zip
```

Rebuild it with:

```bash
./bin/build-package.sh
```

Use WordPress Admin > Appearance > Themes > Add New > Upload Theme, or upload/extract the package into `wp-content/themes/` via SFTP. See `DEPLOYMENT.md` for the full dev URL deployment checklist and required remote access details.

For AWS Elastic Beanstalk dev deployment, build:

```bash
./bin/build-aws-eb-package.sh
```

Then upload `dist/growmodo-aws-eb-wordpress.zip` to a Docker Elastic Beanstalk environment. See `AWS_DEPLOYMENT.md`.

## Main Branch Pipeline

GitHub Actions runs `.github/workflows/main.yml` on every push to `main` and on manual dispatch. The default build job:

- Runs PHP syntax checks for all theme PHP files.
- Builds `dist/growmodo-assessment-theme.zip`.
- Builds `dist/growmodo-aws-eb-wordpress.zip`.
- Validates both ZIP archives.
- Uploads both ZIPs as workflow artifacts.

The workflow also includes an optional Elastic Beanstalk deploy job. To enable it, configure these GitHub repository settings:

- Repository variable: `ENABLE_AWS_EB_DEPLOY=true`
- Repository variable: `AWS_ROLE_TO_ASSUME=arn:aws:iam::004450693142:role/GitHubActionsGrowmodoEstateinDeploy`
- Repository variable: `AWS_EB_SOURCE_BUCKET=elasticbeanstalk-us-west-2-004450693142`

The deploy job targets the current dev environment documented in `AWS_DEPLOYMENT.md`: `growmodo-estatein-dev` / `growmodo-estatein-dev-env` in `us-west-2`.

## Testing Checklist

- Theme activates without fatal errors.
- Home, About Us, Properties, Property Details, Services, and Contact pages render.
- Mobile menu opens and closes.
- Contact form validates required fields, verifies nonce, sends mail through `wp_mail()`, and redirects with a success state.
- Property cards render with fallback content and with custom post content.
- Layout is responsive on desktop, tablet, and mobile.
- Keyboard users can reach navigation links, buttons, and form fields.

## Time-Box Notes

The Growmodo brief frames this as a 4-hour stress test, so this submission prioritizes complete WordPress structure, working page coverage, responsive behavior, and close visual alignment with the Figma system. Further production polish would include exact pixel matching for every remaining Figma section, richer editor controls for all homepage content, and a production CRM/form plugin integration.
