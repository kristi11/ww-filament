# Updating Existing GitHub Releases

This document provides instructions for updating the existing GitHub releases to follow GitHub standards and align with our new automated release process.

## Prerequisites

1. Install the GitHub CLI: https://cli.github.com/
2. Authenticate with GitHub: `gh auth login`

## Update Process

The following commands will update the existing releases to follow GitHub standards. Run these commands in order:

### 1. Update the Initial Release (v1.0.0)

```bash
gh release edit v1.0.0 \
  --title "v1.0.0 - Initial Release" \
  --notes "## Initial Release of WittyWorkflow

This is the initial release of the Witty Workflow, a TALL stack small business management tool. 

### Features

- E-commerce shop with product management
- Appointment scheduling and management
- Role-based access control system
- Customer management
- Team member management
- Business settings and configuration
- Responsive design with Tailwind CSS
- Interactive UI with Alpine.js
- Admin dashboard powered by Filament PHP

### Technical Details

- Built with Laravel 10.x
- Uses Filament 3.x for admin interface
- Implements TALL stack (Tailwind, Alpine.js, Laravel, Livewire)
- Includes Stripe integration for payments"
```

### 2. Update the v1.1 Release

```bash
gh release edit v1.1 \
  --title "v1.1.0 - Major Refactoring" \
  --notes "## v1.1.0 - Major Refactoring

This release includes significant refactoring of core components to improve performance, maintainability, and extensibility.

### Improvements

- Refactored AppServiceProvider for better service registration
- Restructured most Models for improved relationships and queries
- Enhanced Livewire components for better reactivity and performance
- Optimized database queries throughout the application
- Improved error handling and logging

### Technical Details

- Updated dependency versions
- Improved code organization
- Enhanced documentation
- Fixed various minor bugs"
```

### 3. Update the Latest Release (from Dependabot)

```bash
# First, get the latest tag
LATEST_TAG=$(gh release list | grep -v "v1.1.0\|v1.0.0" | head -n 1 | awk '{print $1}')

# If there's no tag yet, create one
if [ -z "$LATEST_TAG" ]; then
  LATEST_TAG="v1.1.1"
  gh release create $LATEST_TAG \
    --title "v1.1.1 - Security Updates" \
    --notes "## v1.1.1 - Security Updates

This release includes important security updates from Dependabot.

### Security Updates

- Updated league/commonmark to address security vulnerabilities
- Fixed potential security issues in dependencies

### Changes

- Merged pull request #2 from kristi11/dependabot/composer/league/commonmark
- Improved overall security posture of the application"
else
  # Update the existing release
  gh release edit $LATEST_TAG \
    --title "$LATEST_TAG - Security Updates" \
    --notes "## $LATEST_TAG - Security Updates

This release includes important security updates from Dependabot.

### Security Updates

- Updated league/commonmark to address security vulnerabilities
- Fixed potential security issues in dependencies

### Changes

- Merged pull request #2 from kristi11/dependabot/composer/league/commonmark
- Improved overall security posture of the application"
fi
```

## Verification

After running these commands, verify that the releases appear correctly on the GitHub releases page:

1. Go to https://github.com/kristi11/ww-filament/releases
2. Check that each release has:
   - A clear, semantic version number (v1.0.0, v1.1.0, etc.)
   - A descriptive title
   - Well-formatted release notes with sections
   - Proper tagging

## Future Releases

Future releases will be handled automatically by the semantic-release GitHub Action we've set up. Contributors should follow the Conventional Commits format for their commit messages, and releases will be generated automatically when changes are merged to the main branch.

For more information, see the [Release Process](./RELEASE_PROCESS.md) documentation.
