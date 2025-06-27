# Installation Guide

This guide will help you get WittyWorkflow up and running quickly on your development or production environment.

## 📋 Prerequisites

Before you begin, ensure your development environment meets these requirements:

- **PHP 8.1+** with the following extensions:
  - BCMath
  - Ctype
  - Fileinfo
  - JSON
  - Mbstring
  - OpenSSL
  - PDO
  - Tokenizer
  - XML
- **Composer 2.0+**
- **Node.js 16+** and NPM
- **MySQL 5.7+** or PostgreSQL 10+
- **Git**

## ⚡ Quickstart

### Automated Setup (Recommended)

WittyWorkflow provides convenient setup commands to automate the installation process:

1. Clone the repo and navigate to the project directory:
   ```bash
   git clone https://github.com/kristi11/ww-filament.git
   cd ww-filament
   ```

2. Run the automated setup command:
   ```bash
   php artisan app:setup
   ```

   This command will:
   - Install NPM and Composer dependencies
   - Create .env file from .env.example
   - Generate application key
   - Run database migrations with seeding
   - Set up Shield with proper permissions
   - Create storage link
   - Build assets

   **Available options:**
   - `--no-key`: Skip the key generation step
   - `--production`: Use npm run build instead of npm run dev (for production environments)

   After setup is complete, start the development server with:
   ```bash
   php artisan serve
   ```

3. Visit your application in the browser:
   ```
   http://localhost:8000
   ```

### Shield Setup Only

If you need to set up just the Shield permissions system:

```bash
php artisan app:setup-shield
```

This command will:
- Run fresh migrations with seeding
- Set up Shield with proper permissions
- Generate Shield resources for the admin panel
- Set up the super admin user

### Manual Setup (Alternative)

If you prefer to run commands individually or need more control over the setup process:

1. Clone the repo:
   ```bash
   git clone https://github.com/kristi11/ww-filament.git
   ```

2. Navigate to the project directory:
    ```bash
    cd ww-filament
    ```

3. Install NPM dependencies:
   ```bash
    npm install
   ```

4. Install the composer dependencies:
   ```bash
   composer install
   ```
5. Create a copy of your .env file:
   ```bash
    cp .env.example .env
   ```
6. Generate an app encryption key:
   ```bash
   php artisan key:generate
   ```

   > **Note:** If using Laravel [Forge](https://forge.laravel.com/), there's no need to generate a key since Forge handles key generation when creating the server.

7. Create an empty database for your application. We recommend using [TablePlus](https://tableplus.com/), but you can use any database management tool you prefer.

8. In the `.env` file, add database information to allow Laravel to connect to the database. The default database name is `ww_filament`. If you are using a different name, you'll need to edit the `DB_DATABASE` variable in the `.env` file with your database name.

9. Migrate and seed the database:
   ```bash
   php artisan migrate:fresh --seed
   ```
10. Set up Shield for user roles and permissions:
   ```bash
   php artisan shield:setup --fresh
   php artisan shield:generate --all --panel=admin
   ```

   Then define the super admin of the system:
   ```bash
   php artisan shield:super-admin --user="1"
   ```

   `--user=1` is the `id` of the user that will be the `super admin`. You can change it to whatever user you want to be the `super admin`.

11. Link the storage folder:
    ```bash
    php artisan storage:link
    ```
12. Run the application:
    ```bash
    php artisan serve
    ```
13. Visit your application in the browser:
    ```
    http://localhost:8000
    ```

14. Compile assets for development:
    ```bash
    npm run dev
    ```

## 📝 Command list

For quick reference, here are the commands to set up WittyWorkflow:

### Automated Setup (Single Command)

```bash
# Complete setup with one command
php artisan app:setup

# Options:
# --no-key      Skip the key generation step
# --production  Use npm run build instead of npm run dev

# After setup, start the server with:
php artisan serve
```

### Shield Setup Only

```bash
# Set up Shield permissions system only
php artisan app:setup-shield
```

### Manual Setup (Individual Commands)

```bash
git clone https://github.com/kristi11/ww-filament.git .
npm install
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan shield:setup --fresh
php artisan shield:generate --all --panel=admin
php artisan shield:super-admin --user="1"
php artisan storage:link
npm run dev
php artisan serve
```

## ❓ Troubleshooting

If you encounter issues during installation, here are solutions to common problems:

| Issue | Solution |
|-------|----------|
| **Class not found errors** | Run `composer dump-autoload` |
| **Node.js errors** | Ensure you're using Node.js 16+ with `node -v` |
| **Database connection errors** | Verify credentials in `.env` file |
| **Permission issues** | Check directory permissions, especially for storage and bootstrap/cache |
| **Blank page after installation** | Check PHP error logs and ensure all requirements are met |
| **Missing images/assets** | Run `php artisan storage:link` again |
| **Shield errors** | Run `php artisan optimize:clear` then retry Shield commands |

For more complex issues, check the [Laravel documentation](https://laravel.com/docs) or open an issue on our [GitHub repository](https://github.com/kristi11/ww-filament/issues).

## 📧 Email Configuration

> [!NOTE]
> Don't forget to update your Mail settings to reflect your production server's needs

For local email testing, we recommend [Mailtrap](https://mailtrap.io/). To use Mailtrap:

1. Create a Mailtrap account
2. Add your Mailtrap credentials to the `.env` file:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email
MAIL_FROM_NAME="${APP_NAME}"
```

If you are using [Laravel Forge](https://forge.laravel.com/), you can add the credentials to the server environment variables.

[Back to Top](../../README.md)

---

Last Updated: June 2025
