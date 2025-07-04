# Contributing to WittyWorkflow

Love open source? Help shape WittyWorkflow! This guide will help you get started with contributing to the project.

## 🔄 Git Flow Workflow

WittyWorkflow uses the Git Flow branching model for development. Please follow these guidelines:

1. **Fork the repository**:
   - Click the "Fork" button at the top right of the repository page
   - Clone your fork locally: `git clone https://github.com/YOUR-USERNAME/ww-filament.git`

2. **Set up Git Flow**:
   ```bash
   # Initialize Git Flow with default settings
   git flow init -d
   ```

3. **Create a feature branch**:
   ```bash
   # Start a new feature
   git flow feature start your-feature-name
   ```

4. **Implement your changes**:
   - Follow the coding standards (PSR-12)
   - Write or update tests for your changes
   - Ensure all tests pass: `php artisan test`

5. **Commit your changes**:
   ```bash
   git commit -m "feat: add cool thing"
   ```
   Use [Conventional Commits](https://www.conventionalcommits.org/) format for your commit messages:

   ```
   <type>(<scope>): <description>
   ```

   Common types include:
   - `feat`: A new feature (minor version bump)
   - `fix`: A bug fix (patch version bump)
   - `docs`: Documentation changes
   - `style`: Code style changes (formatting, etc.)
   - `refactor`: Code changes that neither fix a bug nor add a feature
   - `test`: Adding or updating tests
   - `chore`: Maintenance tasks

   For breaking changes, add an exclamation mark after the type:
   ```
   feat!: redesign user authentication system
   ```

   This format is used by our automated release system to determine version numbers and generate release notes. See the [Release Process](./docs/RELEASE_PROCESS.md) documentation for more details.

6. **Finish your feature**:
   ```bash
   # Finish the feature and merge it into develop
   git flow feature finish your-feature-name
   ```

7. **Push to your fork**:
   ```bash
   git checkout develop
   git push origin develop
   ```

8. **Submit a pull request**:
   - Go to the original repository
   - Click "New pull request"
   - Select "compare across forks"
   - Set the base branch to `develop` (not `main`)
   - Select your fork and branch
   - Fill out the PR template with details about your changes

### Branch Structure

- `main` - Production code only, deployed to live environments
- `develop` - Integration branch for completed features
- `feature/*` - New features being developed
- `release/*` - Preparing for a new production release
- `hotfix/*` - Urgent fixes for production issues
- `support/*` - Maintenance for older versions (if needed)

### Release Process

WittyWorkflow uses an automated release process based on [semantic-release](https://github.com/semantic-release/semantic-release) that works alongside Git Flow.

#### Automated Releases

When changes are pushed to the `main` branch (typically after completing a Git Flow release), our GitHub Actions workflow automatically:

1. Analyzes commit messages since the last release
2. Determines the next version number based on [Semantic Versioning](https://semver.org/)
3. Generates comprehensive release notes
4. Creates a GitHub release with the appropriate tag
5. Updates the CHANGELOG.md file

This process relies on properly formatted commit messages following the [Conventional Commits](https://www.conventionalcommits.org/) specification.

#### Manual Release Process (for maintainers)

Project maintainers should still use Git Flow to manage releases:

```bash
# Start a release
git flow release start 1.2.3  # Version is a suggestion, final version will be determined automatically

# Finish a release (merges to both main and develop)
git flow release finish 1.2.3

# Push changes to trigger the automated release
git checkout main
git push origin main
git push origin --tags
git checkout develop
git push origin develop
```

For detailed information about the release process, see the [Release Process](./docs/RELEASE_PROCESS.md) documentation.

### Hotfix Process

Critical bugs in production are fixed using the Git Flow hotfix process, which works with our automated release system:

```bash
# Start a hotfix
git flow hotfix start hotfix-name  # No version needed, will be determined automatically

# Make your fixes
# Commit using conventional commits format, e.g.:
# git commit -m "fix: resolve critical login issue"

# Finish a hotfix (merges to both main and develop)
git flow hotfix finish hotfix-name

# Push changes to trigger the automated release
git checkout main
git push origin main
git push origin --tags
git checkout develop
git push origin develop
```

The automated release process will detect the fix commits and create a patch release automatically.

## 📝 Code Style Guidelines

- Follow PSR-12 coding standards
- Use Laravel naming conventions
- Write descriptive commit messages
- Document public methods and classes

### PHP Coding Standards

- Use 4 spaces for indentation (not tabs)
- Use camelCase for variables and methods
- Use PascalCase for class names
- Add appropriate docblocks to methods and classes

### JavaScript/Alpine.js Standards

- Use 2 spaces for indentation
- Use camelCase for variables and functions
- Document complex Alpine.js components

### CSS/Tailwind Standards

- Use Tailwind utility classes whenever possible
- Avoid custom CSS unless absolutely necessary
- Follow the mobile-first approach for responsive design

## 📤 Pull Request Process

1. Update the README.md with details of changes if applicable
2. Update the CHANGELOG.md with details of changes
3. The PR will be merged once reviewed and approved

## 🐛 Known Issues

The following are known issues that need addressing:

- Cart items don't get sent from `session id` to `user_id` if the user was logged out when placing the order but after filling out the cart logs in/registers for an account to continue with the order.

### 🔧 Workaround

- For now as a workaround only logged-in users can add to cart.

We hope that the community will step in and work on this issue. If you're interested in tackling this problem, please comment on the related GitHub issue or create a new one if it doesn't exist yet.

## 🔍 Finding Issues to Work On

- Check the [Issues](https://github.com/kristi11/ww-filament/issues) tab for open issues
- Look for issues labeled with `good first issue` or `help wanted`
- If you have an idea for a new feature, create an issue to discuss it before implementing

## 📊 Testing Guidelines

When contributing code, please ensure:

1. All existing tests pass
2. New features have corresponding tests
3. Bug fixes include regression tests

Run tests with:

```bash
php artisan test
```

## 📬 Getting Help

If you have questions about contributing, please:

- Open an issue on GitHub
- Email tanellari@gmail.com with questions

We appreciate your contributions to making WittyWorkflow better!

---

Last Updated: July 2025
