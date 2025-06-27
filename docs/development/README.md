# Development Guide

This guide covers testing and customization aspects of WittyWorkflow to help you extend and adapt the platform to your specific needs.

## 🧪 Testing

WittyWorkflow comes with a comprehensive test suite covering models, features, and integrations.

### 🏃‍♂️ Running Tests

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run specific test
php artisan test --filter=HeroTest
```

### 📁 Test Structure

- **Unit Tests**: Test individual components in isolation
- **Feature Tests**: Test complete features and user workflows
- **Browser Tests**: Test UI interactions using Laravel Dusk (if installed)

The test files are organized in the following directories:

- `tests/Unit/`: Unit tests for individual classes and methods
- `tests/Feature/`: Feature tests for complete functionality
- `tests/Feature/Models/`: Tests for model functionality

### ✍️ Writing New Tests

When adding new features, create corresponding tests in the appropriate directory:

- Model tests in `tests/Feature/Models/`
- Feature tests in `tests/Feature/`
- Browser tests in `tests/Browser/` (if using Dusk)

Example of a basic model test:

```php
/** @test */
public function it_can_create_a_model()
{
    $model = YourModel::factory()->create();
    $this->assertInstanceOf(YourModel::class, $model);
    $this->assertDatabaseHas('your_models', ['id' => $model->id]);
}
```

## 🎨 Customization Guide

WittyWorkflow is designed to be highly customizable without modifying core files.

### 🎭 Theme Customization

- **Colors**: Modify the color scheme in `tailwind.config.js`
- **Typography**: Change fonts and text styles in `resources/css/app.css`
- **Layouts**: Customize layouts in `resources/views/layouts/`

### 🧩 Extending Core Functionality

- **Custom Resources**: Add new Filament resources in `app/Filament/Resources/`
- **Custom Widgets**: Create dashboard widgets in `app/Filament/Widgets/`
- **Custom Fields**: Add custom form fields in `app/Forms/Components/`

### 📚 Common Customization Examples

1. **Adding a Blog**:
    - Create a Blog model and migration
    - Add a Filament resource for managing blog posts
    - Create public routes and views for displaying posts

2. **Custom User Roles**:
    - Extend the Shield configuration to add new roles
    - Define permissions for the new roles
    - Create role-specific dashboards or views

3. **Payment Gateway Integration**:
    - Add alternative payment methods beyond Stripe
    - Create payment gateway service classes
    - Integrate with checkout process

## 🔍 Debugging Tips

When developing with WittyWorkflow, these debugging techniques can be helpful:

- Use Laravel's built-in `dd()` and `dump()` functions for quick debugging
- Enable query logging with `DB::enableQueryLog()` and `DB::getQueryLog()`
- Use Laravel Telescope for comprehensive debugging (if installed)
- Check Laravel logs in `storage/logs/laravel.log`

## 🚀 Development Workflow

For the most efficient development experience:

1. Make changes in a feature branch
2. Run tests to ensure functionality
3. Use Laravel Mix/Vite for asset compilation
4. Follow PSR-12 coding standards
5. Document your changes

## 📦 Package Development

If you're extending WittyWorkflow with custom packages:

- Use Laravel's package development tools
- Follow Filament's plugin development guidelines for admin panel extensions
- Ensure compatibility with the TALL stack components

[Back to Top](../../README.md)

---

Last Updated: June 2025
