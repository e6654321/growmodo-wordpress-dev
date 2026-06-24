# Estatein Figma Match Checklist

Reference sources:
- Public Figma/community preview URL provided by the client.
- Public Estatein preview screenshots downloaded into `assets/images/`.
- Figma MCP node inspection is currently blocked by the Starter-plan call limit, so exact node IDs, X/Y coordinates, and measured spacing cannot be verified from the Figma API in this workspace.

Legend:
- `[x]` implemented in the theme and verified against available public preview imagery/copy.
- `[~]` visually approximated from screenshots because exact Figma node data is unavailable.
- `[blocked]` requires Figma MCP node access or direct edit access to the design file.

## Shared Layout
- [x] Promo bar: dark top announcement, star/spark mark, "Learn More" link, close button. Files: `header.php`, `assets/css/main.css`, `assets/js/main.js`.
- [x] Header: Estatein brand, centered nav, separate Contact Us button, mobile menu open/close UX. Files: `header.php`, `inc/template-tags.php`, `assets/js/main.js`.
- [~] Logo icon: recreated with CSS to match the purple Estatein mark from preview. File: `assets/css/main.css`.
- [x] Footer: Estatein brand, email capture, Home/About Us/Properties/Services/Contact Us sitemap columns, copyright, Terms & Conditions, and circular social buttons. Files: `footer.php`, `assets/css/main.css`.
- [x] Shared CTA band: "Start Your Real Estate Journey Today" copy and primary action. File: `template-parts/sections/contact.php`.
- [blocked] Exact header/footer frame dimensions and node spacing.

## Home Page
- [x] Hero headline: "Discover Your Dream Property with Estatein". File: `template-parts/sections/hero.php`.
- [x] Hero supporting copy, Learn More, Browse Properties buttons. File: `template-parts/sections/hero.php`.
- [x] Hero stats: 200+, 10k+, 16+. File: `template-parts/sections/hero.php`.
- [x] Hero building visual uses cropped public preview asset. Asset: `assets/images/estatein-hero-building.png`.
- [x] Circular "Discover Your Dream Property" hero badge with center arrow added between copy and building, matching the public preview structure. Files: `template-parts/sections/hero.php`, `assets/css/main.css`.
- [~] Hero background pattern and building placement recreated from screenshot. File: `assets/css/main.css`.
- [x] Four shortcut cards: Find Your Dream Home, Unlock Property Value, Effortless Property Management, Smart Investments, with distinct icon treatments and arrow affordances. Files: `template-parts/sections/hero.php`, `assets/css/main.css`.
- [x] Featured Properties section with property images, titles, subtitles, spec chips, price, and View Property Details button. Files: `template-parts/sections/work.php`, `template-parts/content-property.php`.
- [x] Testimonials, FAQ, section pager, CTA. Files: `template-parts/sections/testimonials.php`, `template-parts/sections/faq.php`, `template-parts/sections/contact.php`.
- [blocked] Pixel-exact hero and section coordinates.

## About Us Page
- [x] Our Journey hero section with stats. File: `page-templates/about-us.php`.
- [x] Our Values cards. File: `page-templates/about-us.php`.
- [x] Our Achievements cards. File: `page-templates/about-us.php`.
- [x] Navigating the Estatein Experience process cards. File: `page-templates/about-us.php`.
- [x] Meet the Estatein Team cards with cropped public preview portraits. Assets: `team-max-mitchell.png`, `team-sarah-johnson.png`, `team-david-brown.png`, `team-michael-turner.png`.
- [x] Our Valued Clients section with ABC Corporation and GreenTech Enterprises cards, Since labels, Visit Website buttons, Domain/Category metadata, What They Said quote panels, and "01 of 10" pager. Files: `page-templates/about-us.php`, `assets/css/main.css`.
- [x] CTA after client section. File: `template-parts/sections/contact.php`.
- [blocked] Exact team-card crop coordinates from Figma nodes.

## Properties Page
- [x] Hero headline and supporting copy. Files: `archive.php`, `page-templates/properties.php`.
- [x] Search bar with "Search For A Property" placeholder and Find Property button. Files: `archive.php`, `page-templates/properties.php`.
- [x] Filter strip: Location, Property Type, Pricing Range, Property Size, Build Year with leading icon hooks and dropdown affordance. Files: `archive.php`, `page-templates/properties.php`, `assets/css/main.css`.
- [x] Section copy: "Discover a World of Possibilities" and portfolio heading. Files: `archive.php`, `page-templates/properties.php`.
- [x] Property cards use exact public preview crops for Seaside, Metropolitan, and Rustic listings. Assets: `estatein-card-seaside.png`, `estatein-card-metropolitan.png`, `estatein-card-rustic.png`.
- [x] Property subtitles: Coastal Escapes, Urban Oasis, Countryside Charm; Read More link treatment; bed/bath/type chips. Files: `inc/template-tags.php`, `template-parts/content-property.php`, `page-templates/properties.php`.
- [x] Property card order matches the screenshot sequence: Seaside Serenity Villa, Metropolitan Haven, Rustic Retreat Cottage. Files: `functions.php`, `page-templates/properties.php`.
- [x] Property carousel pager: "01 of 10" with previous/next circular controls. Files: `archive.php`, `page-templates/properties.php`.
- [x] "Let's Make it Happen" inquiry section below property cards with Estatein form fields and consent checkbox. Files: `archive.php`, `page-templates/properties.php`, `template-parts/sections/contact-form.php`.
- [blocked] Exact card image crop source rectangles from Figma.

## Property Details Page
- [x] Title, location, and price header row. File: `single-property.php`.
- [x] Location pill treatment beside property title. Files: `single-property.php`, `assets/css/main.css`.
- [x] Expanded thumbnail gallery rail and two-column main gallery. File: `single-property.php`.
- [x] Description panel with labeled Bedrooms, Bathrooms, and Area stats. File: `single-property.php`.
- [x] Key Features and Amenities panel with stacked feature rows. File: `single-property.php`.
- [x] Property-specific inquiry form with Selected Property field, message, consent checkbox, and Send Your Message button. File: `single-property.php`.
- [x] Comprehensive Pricing Details with listing price, additional fee rows, and monthly cost rows. File: `single-property.php`.
- [~] Gallery uses public preview imagery and available cropped property assets; exact interior gallery assets are not separately exposed in the public page.
- [blocked] Exact gallery node images and spacing.

## Services Page
- [x] Hero headline: "Elevate Your Real Estate Experience". File: `page-templates/services.php`.
- [x] Service shortcuts: Dream Home, Unlock Property Value, Property Management, Smart Investments. File: `page-templates/services.php`.
- [x] Unlock Property Value section heading and Estatein-style card copy for Valuation Mastery, Strategic Marketing, Negotiation Wizardry, Closing Success, with Learn More card actions. Files: `page-templates/services.php`, `assets/css/main.css`.
- [x] Property Management section heading and Estatein-style card copy for Tenant Harmony, Maintenance Ease, Financial Peace of Mind, Legal Guardian, with Learn More card actions. Files: `page-templates/services.php`, `assets/css/main.css`.
- [x] Smart Investments CTA and shared bottom CTA. File: `page-templates/services.php`.
- [blocked] Exact icon glyphs from Figma component library.

## Contact Page
- [x] Hero headline: "Get in Touch with Estatein". File: `page-templates/contact.php`.
- [x] Contact method cards foreground the visible contact values: info@estatein.com, +1 (123) 456-7890, Main Headquarters, Instagram LinkedIn Facebook. File: `page-templates/contact.php`.
- [x] "Let's Connect" inquiry form with expanded Estatein field set, four-column desktop layout, budget, preferred contact method, and consent checkbox. Files: `page-templates/contact.php`, `template-parts/sections/contact-form.php`, `assets/css/main.css`.
- [x] Office locations section with Main Headquarters and Regional Office cards, address headings, email/phone/location chips, and full-width Get Direction actions. Files: `page-templates/contact.php`, `assets/css/main.css`.
- [x] FAQ and footer. Files: `template-parts/sections/faq.php`, `footer.php`.
- [blocked] Exact contact-card icon SVGs from Figma component library.

## Functional Verification
- [x] PHP lint passes for all theme PHP files in the Docker WordPress container.
- [x] Routes render with HTTP 200: `/`, `/about-us/`, `/properties/`, `/properties/seaside-serenity-villa/`, `/services/`, `/contact/`.
- [x] Property archive renders updated Figma-style subtitles and Read More treatment.
- [x] Mobile nav JS supports open, close, outside click, Escape, and resize reset.
- [x] Contact form uses nonce validation and redirects after submit.
- [x] Rendered HTML includes Properties "Let's Make it Happen", Property Details "Selected Property", Pricing fee rows, Budget, Preferred Contact Method, and consent checkbox.
- [x] Rendered HTML includes About "Our Valued Clients", ABC Corporation, GreenTech Enterprises, Domain, Category, What They Said, Visit Website, and "01 of 10".
- [x] Rendered HTML includes Contact office-card chips for info@estatein.com, support@estatein.com, +1 (987) 654-3210, and Downtown District.
- [x] Rendered HTML includes shared footer legal text, Terms & Conditions, and Facebook/LinkedIn/Twitter/YouTube social labels.
- [x] Main CSS cache version bumped to `1.0.6` so visual updates load during browser review.
