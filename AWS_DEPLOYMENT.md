# AWS Dev URL Deployment

Goal: deploy the Estatein WordPress theme to an AWS-hosted dev URL.

## Cost Caveat

AWS is not guaranteed to be completely free for a public WordPress dev URL. Even when EC2 compute is free-tier eligible, AWS charges for public IPv4 addresses. AWS VPC pricing lists in-use public IPv4 addresses at `$0.005/hour`.

Do not create AWS resources unless you accept possible charges.

## Prepared AWS Package

Build the Elastic Beanstalk Docker package:

```bash
./bin/build-aws-eb-package.sh
```

Output:

```text
dist/growmodo-aws-eb-wordpress.zip
```

This package includes:

- `Dockerfile`
- `docker-compose.yml`
- `growmodo-assessment/` theme folder

The Elastic Beanstalk app runs:

- WordPress `6.6-php8.2-apache`
- MySQL `8.0`
- The custom `growmodo-assessment` theme copied into WordPress

## Current Dev Environment

- AWS region: `us-west-2`
- Elastic Beanstalk application: `growmodo-estatein-dev`
- Elastic Beanstalk environment: `growmodo-estatein-dev-env`
- Environment ID: `e-fpq6jzrmps`
- EC2 instance: `i-02167fcd2cde487c5`
- Working dev URL: `http://44.226.48.168/`
- Elastic Beanstalk CNAME: `growmodo-estatein-dev-env.eba-pd6rqmm3.us-west-2.elasticbeanstalk.com`

The EC2 IP was verified successfully immediately after deployment. The Elastic Beanstalk CNAME may need additional DNS propagation time before it resolves consistently.

## GitHub Actions Deployment

Pushes to `main` run `.github/workflows/main.yml`. The build job passes and the deploy job uses GitHub OIDC to assume:

```text
arn:aws:iam::004450693142:role/GitHubActionsGrowmodoEstateinDeploy
```

The role uploads source bundles to:

```text
elasticbeanstalk-us-west-2-004450693142
```

Required deploy permissions include Elastic Beanstalk application/environment updates and these S3 permissions on the Elastic Beanstalk source bucket:

- `s3:ListBucket`
- `s3:GetObject`
- `s3:PutObject`
- `s3:CreateBucket`

The `s3:CreateBucket` action is required by Elastic Beanstalk during `UpdateEnvironment`, even when the region source bucket already exists.

## Console Deployment Path

1. Open AWS Console.
2. Region: `us-west-2` is currently open in the browser.
3. Go to Elastic Beanstalk.
4. Create application.
5. Platform: Docker.
6. Application code: upload `dist/growmodo-aws-eb-wordpress.zip`.
7. Environment type: single instance.
8. Instance type: choose a free-tier eligible micro instance if the account is eligible.
9. Avoid load balancers, RDS, NAT Gateways, and extra static IPs for this temporary dev deployment.
10. Create environment.

After AWS finishes provisioning, open the Elastic Beanstalk environment URL.

## WordPress First-Run Setup

The AWS package includes WordPress and the theme, but WordPress still needs the initial web installer:

1. Open the Elastic Beanstalk environment URL.
2. Complete WordPress installation.
3. Log in to WordPress admin.
4. Go to Appearance > Themes.
5. Activate **Growmodo Assessment Theme**.
6. Confirm the theme-created pages, menus, Properties, Services, static homepage, and permalink structure are present.

On activation, the theme automatically creates the required assessment content if it is missing:

- Home, About Us, Properties, Services, and Contact pages.
- Primary and Footer menus.
- Three sample Properties with pricing/spec metadata.
- Three sample Services.
- Static homepage and `/%postname%/` permalink structure.

## Verification

Check:

- `/`
- `/about-us/`
- `/properties/`
- `/services/`
- `/contact/`

Property detail route requires a property post:

- `/properties/seaside-serenity-villa/`

## Cleanup

To avoid charges after review:

1. Terminate the Elastic Beanstalk environment.
2. Delete the Elastic Beanstalk application if no longer needed.
3. Confirm no EC2 instances, EBS volumes, Elastic IPs, NAT Gateways, or load balancers remain.
