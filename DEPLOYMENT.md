# Dev URL WordPress Deployment

Prepared package:

- `dist/growmodo-assessment-theme.zip`

This zip contains a single `growmodo-assessment/` theme folder and is ready for a WordPress theme upload.

Rebuild the package with:

```bash
./bin/build-package.sh
```

## Option A: WordPress Admin Upload

1. Log in to the dev WordPress admin dashboard.
2. Go to Appearance > Themes > Add New > Upload Theme.
3. Upload `dist/growmodo-assessment-theme.zip`.
4. Click Install Now.
5. Activate **Growmodo Assessment Theme**.
6. Go to Settings > Permalinks and click Save Changes.

## Option B: SFTP or File Manager

1. Upload `dist/growmodo-assessment-theme.zip` to the server.
2. Extract it into `wp-content/themes/`.
3. Confirm this path exists: `wp-content/themes/growmodo-assessment/style.css`.
4. Activate **Growmodo Assessment Theme** in WordPress Admin.
5. Go to Settings > Permalinks and click Save Changes.

## Option C: SSH Helper

If the server supports SSH/SCP, deploy with:

```bash
DEPLOY_HOST="example.com" \
DEPLOY_USER="deploy" \
WP_ROOT="/var/www/example.com/public" \
./bin/deploy-wordpress-ssh.sh
```

Optional:

```bash
SSH_PORT="2222" ./bin/deploy-wordpress-ssh.sh
```

The helper uploads `dist/growmodo-assessment-theme.zip`, extracts it to `wp-content/themes/growmodo-assessment`, and activates it with WP-CLI when WP-CLI is available on the server.

## Required WordPress Setup After Activation

Create or confirm these pages:

- Home
- About Us
- Properties
- Services
- Contact

Assign templates:

- About Us: `About Us`
- Properties: `Properties`
- Services: `Services`
- Contact: `Contact`

Set homepage:

1. Go to Settings > Reading.
2. Choose a static homepage.
3. Select `Home`.

Create a Primary Menu:

- Home
- About Us
- Properties
- Services
- Contact

Assign it to the Primary Menu location. The theme displays Contact as a separate header button.

## Content

The theme works without plugins. Optional ACF fields for `property` posts:

- `price`
- `bedrooms`
- `bathrooms`
- `property_type`

If no content exists, the theme provides Figma-aligned fallback content and local images.

## Verification

After deployment, check:

- `/`
- `/about-us/`
- `/properties/`
- `/properties/seaside-serenity-villa/`
- `/services/`
- `/contact/`

Expected: each route renders without a fatal error and uses the dark Estatein design.

## Needed For Direct Remote Deployment

To deploy directly to a dev URL from this machine, provide one of:

- WordPress admin URL, username, and password with theme upload permissions.
- SFTP/SSH host, username, auth method, and WordPress root path.
- Hosting control panel access with file manager permissions.

Once the target is available, upload `dist/growmodo-assessment-theme.zip`, activate the theme, configure pages/templates/menus, and verify the routes above.
