# Growmodo Assessment Submission

Hello Growmodo team,

Thank you for the assessment opportunity. I built a custom WordPress theme based on the provided Figma template:

**Real Estate Business Website UI Template Dark Theme | Produce UI Community Copy**

## Deliverables

- GitHub repository: `[add GitHub repository URL here]`
- Demo URL: `http://growmodo-estatein-dev-t3.us-west-2.elasticbeanstalk.com/`
- WordPress upload package: `dist/growmodo-assessment-theme.zip`
- AWS Elastic Beanstalk package: `dist/growmodo-aws-eb-wordpress.zip`
- Local setup: run `docker compose up -d` and `./bin/setup-local.sh`, then open `http://localhost:8080`. See `README.md` for full instructions.

## Completed Scope

- Custom WordPress theme using PHP, CSS, and JavaScript.
- Dark Estatein-style interface based on the Figma design system.
- Responsive Home, About Us, Properties, Property Details, Services, and Contact coverage.
- Reusable header, footer, page sections, property cards, service cards, and CTA components.
- Custom post types for Properties and Services.
- ACF-ready property fields with fallbacks, so the theme works even without ACF installed.
- Contact form using WordPress `admin-post.php` with nonce validation.
- Basic accessibility and SEO foundations, including semantic HTML, `title-tag` support, image alt text, and keyboard-accessible navigation.

## Notes

This was treated as the requested time-boxed stress test. I prioritized a working custom WordPress theme, responsive layout, clear content management paths, and close alignment with the Figma visual language. With more time, I would continue refining exact section-by-section spacing and expanding editor controls for every homepage content block.

For a dev URL deployment, upload `dist/growmodo-assessment-theme.zip` to a WordPress dev instance and follow `DEPLOYMENT.md`. Direct remote deployment from this machine requires the target WordPress admin or SFTP/SSH credentials.

For AWS, `dist/growmodo-aws-eb-wordpress.zip` was deployed to a single-instance Docker Elastic Beanstalk environment in `us-west-2`. The working dev URL is `http://growmodo-estatein-dev-t3.us-west-2.elasticbeanstalk.com/`. AWS public dev URLs may incur compute, load balancer, storage, and public IPv4 charges.
