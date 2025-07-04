# Release Process

This document explains how the automated release process works in this project.

## Overview

We use [semantic-release](https://github.com/semantic-release/semantic-release) to automate our release process. This tool:

1. Determines the next version number based on commit messages
2. Generates release notes
3. Creates a GitHub release
4. Updates the CHANGELOG.md file
5. Creates a Git tag

The release process is triggered automatically when changes are pushed to the `main` branch.

## How It Works with Git Flow

Our project follows the Git Flow workflow as described in the [CONTRIBUTING.md](../CONTRIBUTING.md) file. Here's how the automated release process fits into Git Flow:

1. Development happens on feature branches (`feature/*`) branched from `develop`
2. When features are complete, they are merged into `develop`
3. When ready for a release, a release branch (`release/*`) is created from `develop`
4. The release branch is merged into `main` (and back into `develop`)
5. When changes are pushed to `main`, the automated release process is triggered
6. semantic-release analyzes the commits, determines the version, and creates a release

## Commit Message Format

To ensure that semantic-release can determine the correct version number, commit messages should follow the [Conventional Commits](https://www.conventionalcommits.org/) format:

```
<type>(<scope>): <description>

[optional body]

[optional footer(s)]
```

### Types

The commit type determines how the version number is incremented:

- `feat`: A new feature (minor version bump)
- `fix`: A bug fix (patch version bump)
- `docs`: Documentation changes (patch version bump)
- `style`: Changes that don't affect the code's meaning (patch version bump)
- `refactor`: Code changes that neither fix a bug nor add a feature (patch version bump)
- `perf`: Performance improvements (patch version bump)
- `test`: Adding or correcting tests (patch version bump)
- `build`: Changes to the build system (patch version bump)
- `ci`: Changes to CI configuration (patch version bump)
- `chore`: Other changes that don't modify src or test files (patch version bump)

### Breaking Changes

To indicate a breaking change (which will trigger a major version bump), add `BREAKING CHANGE:` in the commit message body or add a `!` after the type:

```
feat!: add new authentication system

BREAKING CHANGE: `auth()` now returns a Promise instead of a boolean
```

## Examples

Here are some example commit messages:

```
feat: add user profile page
```

```
fix: resolve issue with login form validation
```

```
docs: update installation instructions
```

```
feat(auth): implement two-factor authentication
```

```
feat!: redesign API endpoints
```

## Manual Releases

In some cases, you may need to create a release manually. To do this, follow the Git Flow release process as described in the [CONTRIBUTING.md](../CONTRIBUTING.md) file:

```bash
# Start a release
git flow release start 1.2.3

# Finish a release (merges to both main and develop)
git flow release finish 1.2.3

# Push changes
git checkout main
git push origin main
git push origin --tags
git checkout develop
git push origin develop
```

The automated release process will still be triggered when changes are pushed to `main`, but it will respect the version number in the tag if one exists.
