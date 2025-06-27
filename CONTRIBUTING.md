# Contributing to WittyWorkflow

Love open source? Help shape WittyWorkflow! This guide will help you get started with contributing to the project.

## 🔄 Development Workflow

1. **Fork the repository**:
    - Click the "Fork" button at the top right of the repository page
    - Clone your fork locally: `git clone https://github.com/YOUR-USERNAME/ww-filament.git`

2. **Create a feature branch**:

    ```bash
    git checkout -b feature/your-idea
    ```

3. **Implement your changes**:
    - Follow the coding standards (PSR-12)
    - Write or update tests for your changes
    - Ensure all tests pass: `php artisan test`

4. **Commit your changes**:

    ```bash
    git commit -m "Add cool thing"
    ```

    Use descriptive commit messages that explain what changes were made and why.

5. **Push to your fork**:

    ```bash
    git push origin feature/your-idea
    ```

6. **Submit a pull request**:
    - Go to the original repository
    - Click "New pull request"
    - Select "compare across forks"
    - Select your fork and branch
    - Fill out the PR template with details about your changes

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

Last Updated: June 2025
