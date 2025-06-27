# Deployment Guide

This guide covers the process of deploying WittyWorkflow to a production environment.

## 🖥️ Server Requirements

- PHP 8.1+
- Nginx or Apache
- MySQL 5.7+ or PostgreSQL 10+
- Composer
- Node.js and NPM (for asset compilation)

## 📋 Deployment Steps

1. **Set up your web server and database**:
    - Configure Nginx/Apache with proper PHP settings
    - Create a database for your application

2. **Clone the repository to your server**:

    ```bash
    git clone https://github.com/kristi11/ww-filament.git /path/to/your/site
    ```

3. **Install dependencies**:

    ```bash
    composer install --no-dev --optimize-autoloader
    npm install && npm run build
    ```

4. **Set up environment variables**:
    - Copy `.env.example` to `.env`
    - Configure database, mail, and other settings
    - Generate application key: `php artisan key:generate`

5. **Run migrations**:

    ```bash
    php artisan migrate
    ```

6. **Set up task scheduling**:
   Add this to your crontab:

    ```
    * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
    ```

7. **Configure caching**:

    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

8. **Set up Shield permissions**:

    ```bash
    php artisan shield:setup --fresh
    php artisan shield:generate --all --panel=admin
    php artisan shield:super-admin --user="1"
    ```

9. **Create storage link**:

    ```bash
    php artisan storage:link
    ```

10. **Set proper file permissions**:
    ```bash
    chmod -R 775 storage bootstrap/cache
    chown -R www-data:www-data storage bootstrap/cache
    ```

## 🌐 Platform-Specific Guides

### Laravel Forge

[Laravel Forge](https://forge.laravel.com/) provides a simple way to deploy Laravel applications:

1. Create a new server in Forge
2. Connect your GitHub repository
3. Configure deployment settings
4. Set up environment variables
5. Enable automatic deployments

### Digital Ocean

Deploying to Digital Ocean's App Platform:

1. Create a new app in the Digital Ocean dashboard
2. Connect your GitHub repository
3. Configure build settings (PHP 8.1+, Node.js)
4. Set up environment variables
5. Deploy the application

### AWS

Deploying with AWS Elastic Beanstalk:

1. Create a new Elastic Beanstalk environment
2. Configure PHP settings
3. Set up environment variables
4. Deploy your application code
5. Configure database connections

## 🔄 Continuous Deployment

For automated deployments, consider setting up a CI/CD pipeline:

1. Create a `.github/workflows/deploy.yml` file for GitHub Actions
2. Configure the workflow to run tests and deploy on successful builds
3. Set up secrets for deployment credentials
4. Configure deployment targets

## 📊 Post-Deployment Checklist

After deploying, verify the following:

- [ ] Application loads correctly
- [ ] Database migrations have run successfully
- [ ] User authentication works
- [ ] File uploads function properly
- [ ] Scheduled tasks run as expected
- [ ] Email sending is configured correctly
- [ ] Stripe integration works (if using the shop)

## 🔍 Troubleshooting Deployment Issues

Common deployment issues and solutions:

| Issue                          | Solution                                                   |
| ------------------------------ | ---------------------------------------------------------- |
| **500 Server Error**           | Check Laravel logs in `storage/logs/laravel.log`           |
| **White screen**               | Ensure debug mode is enabled temporarily to see errors     |
| **Missing assets**             | Verify `npm run build` completed and storage link exists   |
| **Database connection errors** | Check `.env` database credentials                          |
| **Permission issues**          | Ensure proper permissions on storage and cache directories |

[Back to Top](../../README.md)

---

Last Updated: June 2025
