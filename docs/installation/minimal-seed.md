# Using the Minimal Seed Option

WittyWorkflow provides a `--minimal-seed` option for the `app:setup` command that allows you to install the application with only essential data, skipping demo content. This is useful for developers who want a clean starting point without sample products, services, and additional users.

## What's Included in Essential Data

When you use the `--minimal-seed` option, only the following essential data is created:

- **Admin user** (email: admin@example.com, password: password)
- **Team user** (email: team@example.com, password: password)
- **Essential admin-associated data**:
  - Address
  - Hero section
  - Social media links
  - Public page settings
  - Section colors
  - About page
  - Contact information
  - Terms and conditions
  - Privacy policy
  - FAQ data
  - Help content
  - CRUD settings
  - Support information
  - Flexibility settings
  - Business hours (weekdays only)
- **Shield roles and permissions**
- **Section positions**

## What's Excluded

The minimal seed option excludes:

- 125 additional demo users
- Sample products and their variants
- Additional business hours (weekends)
- Sample services

## Usage

To set up the application with only essential data:

```bash
php artisan app:setup --minimal-seed
```

You can combine this with other options:

```bash
# Skip key generation and use minimal seed
php artisan app:setup --no-key --minimal-seed

# Use production build and minimal seed
php artisan app:setup --production --minimal-seed

# Use all options
php artisan app:setup --no-key --production --minimal-seed
```

## When to Use

The `--minimal-seed` option is recommended when:

- You're setting up a development environment and want to minimize database size
- You're creating a production environment and plan to add your own content
- You want a clean starting point without demo data
- You're testing the application and don't need sample content

For demonstration or learning purposes, it's better to use the full seeding process (without the `--minimal-seed` option) to see all features populated with sample data.
