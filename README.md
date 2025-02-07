span

<br />
<div align="center">
  <a href="https://github.com/kristi11/wittyworkflow/">
    <img src="public/android-chrome-192x192.png" alt="Logo" width="80" height="80">
  </a>

<h3 align="center">Witty workflow</h3>

<p align="center">
    A platform for managing your business
    <br />
    <br />
    <a href="https://wittyworkflow.com/">View Demo</a>
    ·
    <a href="https://github.com/kristi11/wittyworkflow/issues">Report Bug</a>
    ·
    <a href="https://github.com/kristi11/wittyworkflow/issues">Request Feature</a>
  </p>

> # This app is in active development

### The website is a demonstration app for developer or clients to see how their app would look like in real world scenarios. Some CRUD features have been disabled to maintain a proper demonstration environment. To enable all the CRUD functionality follow the steps outlined on the <a href="#disabled-features">Disabled features</a> section and then on the **Content** resource choose to enable the desired functions.

## **THIS REPOSITORY SHOULD BE USED ON A BRAND-NEW PROJECT**

</div>

<!-- TABLE OF CONTENTS -->

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#key-features">Key Features</a></li>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
        <a href="#key-features">Key features</a>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#command_list">Command list</a></li>
    <li>
      <a href="#configuration">Configuration</a>
      <ul>
        <li><a href="#disabled-features">Disabled features</a></li>
        <li><a href="#panel-switching">Panel switching</a></li>
        <li><a href="#adding-variants">Adding variants</a></li>
        <li><a href="#otp">One Time Passwords</a></li>
        <li><a href="#demonstration-environment-note">Demonstration environment note</a></li>
      </ul>
    </li>
    <li><a href="#shop">Shop</a></li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
    <li>
      <a href="#known-issues">Known issues</a>
      <ul>
        <li><a href="#workaround">Workaround</a></li>
      </ul>
    </li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->

## About The Project

##### [WittyWorkflow](https:://wittyworkflow.com) is a TALL stack small business management tool. It includes an E-commerce shop, appointment management, role based access and much more. Below is an overview of the key functionalities of the app:

## Key Features:

> * **Dynamic Hero:** Engage your audience with a visually appealing and dynamic hero section that captures attention and
>   communicates your brand essence. The hero is fully customizable from the admin panel to ensure a seamless user
>   experience.

> * **Role-Based Access:** Utilizing the
>   powerful [Filament PHP](https://filamentphp.com/), [WittyWorkflow](https:://wittyworkflow.com) offers role-based
>   access control, enabling
>   different panels for different user roles. Admins have full access to all functionalities, while staff members and
>   customers have a more limited view.

> * **SPA functionality with `Wire:Navigate` :** Enhance navigation with an SPA like menu featuring `wire:navigate`
>   functionality, bringing Single Page Application (SPA) functionality to your site for smooth transitions between links.

> * **Public Email Form and Footer:** Facilitate communication by implementing a public email form and completing the
>   footer for a professional and polished user interface.

> * **Enhanced Footer:**  Showing different requirements/terms/help etc. of what your business has/requires/offers

> * **Appointment management:** Manage your appointments

> * **Email Notifications on Appointment Changes:** Receive email notifications for changes in appointments, ensuring you never miss valuable information about your upcoming appointments.

> * **Email Notifications on shop purchases: Be notified every time a purchase is made.**

> * **Full control:** On what section shows/hides from the landing page depending on your businesses need for the section

> * **2-Factor authentication:** To enhance security of your accounts

> * **Theme customization:** To give every user the ability to customize the look and feel of the app to their liking

> * **Application health:** See how your application is performing and make the necessary changes in the server

> * **Business information:** Have full access on different aspects of your business including system users, section
>   visibility, business services, announcements and much more...

> * **E-commerce:** TALL stack e-commerce shop. Stripe integration

> * **Shop panel control** Have control over the shop products and orders straight from you admin panel.
> * **One Time Passwords (OTP)** for an extra added layer of security.

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

## Built With

This section lists all major frameworks/libraries used to bootstrap this project.

* ![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
* ![Livewire](https://img.shields.io/badge/livewire-%234e56a6.svg?style=for-the-badge&logo=livewire&logoColor=white)
* ![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white)
* ![Filament](https://img.shields.io/badge/Filament-FFAA00?style=for-the-badge&logoColor=%23000000)
* ![Alpine.js](https://img.shields.io/badge/alpinejs-white.svg?style=for-the-badge&logo=alpinedotjs&logoColor=%238BC0D0)
* ![Stripe](https://img.shields.io/badge/Stripe-5469d4?style=for-the-badge&logo=stripe&logoColor=ffffff)

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

<!-- GETTING STARTED -->

## Getting Started

This project is built with [Filament 3](https://filamentphp.com)

## Installation

To get started clone this repository.

1. Clone the repo

   ```
   https://github.com/kristi11/ww-filament.git
   ```

   or if you have a different name you'd like to use for the project create an empty folder with your desired name, `cd`
   into that folder and
   run the following command:

   ```
   https://github.com/kristi11/ww-filament.git .
   ```

   this will clone all the project's content without the project name folder.
2. Install NPM dependencies

   ```
   npm install
   ```

   and run npm `npm run dev` if you're working locally or `npm run build` if you're working on production.
3. Install the composer dependencies.

   ```
   composer install
   ```
4. Create a copy of your .env file.

   ```
    cp .env.example .env
   ```
5. Generate an app encryption key.

   ```
   php artisan key:generate
   ```

   if using laravel [forge](https://forge.laravel.com/) there's no need to generate key since when creating the
   server [forge](https://forge.laravel.com/) will take care of the key generation.
6. Create an empty database for your application. I personally like using [TablePlus](https://tableplus.com/), but you
   can
   use whatever you like.
7. In the `.env` file, add database information to allow Laravel to connect to the database. The default database name
   is `ww_filament`. If you are using a different name, you'll need to edit the `DB_DATABASE` variable in the `.env`
   file with your database name.
8. Migrate and seed the database.

   ```
   php artisan migrate:fresh --seed
   ```
9. [WittyWorkflow](https:://wittyworkflow.com) uses [Shield](https://filamentphp.com/plugins/bezhansalleh-shield) plugin
   to provide proper user roles. We need to setup the plugin and generate the permissions for that package

   ```
   php artisan shield:setup --fresh
   php artisan shield:generate --all --panel=admin
   ```

   and define the super admin of the system

   ```
   php artisan shield:super-admin --user="1"
   ```

   `--user=1` is the `id` of the user that will be the `super admin`. You can change it to whatever user you want to be
   the `super admin`. the credentials for the super admin are the following:

   ```
   email: admin@example.com
   password: password
   ```
10. Link the storage folder.

    ```
    php artisan storage:link
    ```
11. Run the application.

    ```
    php artisan serve
    ```
12. Visit your application in the browser.

    ```
    http://localhost:8000
    ```

### Command list

```
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
```

Don't forget to run `npm run dev` and `php artisan serve`
after the above commands are ran.

> [!NOTE]
>
> Don't forget to update your Mail settings to reflect your production server's needs

I use [Mailtrap](https://mailtrap.io/) for local email testing. You can use whatever you like. If you want to
use [Mailtrap](https://mailtrap.io/),
create an account and add the credentials to the `.env` file. If you are using [forge](https://forge.laravel.com/) you
can add the credentials to the server environment variables.

If you decide to use [Mailtrap](https://mailtrap.io/), you can use the following credentials:

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

This app uses DigitalOcean Spaces to store files. If you want to
use [DigitalOcean Spaces](https://www.digitalocean.com/products/spaces) you need to add the credentials to the `.env` file.

```
DO_SPACES_KEY=key
DO_SPACES_SECRET=secret
DO_SPACES_BUCKET=bucket-name
DO_SPACES_REGION=region
DO_SPACES_ENDPOINT=endpoint-that-is-provided-by-DigitalOcean
```

Here's a [youtube video](https://www.youtube.com/watch?v=vFwy-vB_d_k) on how to set up Digital Ocean Spaces with Laravel.

If you are using [forge](https://forge.laravel.com/) you can add the credentials to the server environment variables.

<!-- SHOP -->

## Shop

Add the Stripe credentials:

```
STRIPE_KEY=your-stripe-key
STRIPE_SECRET=your-stripe-secret
STRIPE_WEBHOOK_SECRET=your-stripe-webhook-secret
```

In your local server (for testing purposes only) use [stripe-cli](https://docs.stripe.com/stripe-cli) and run `stripe login` to log in into stripe and then `stripe listen --forward-to {your url here}/stripe/webhook --format JSON` to listen to Stripe's webhook.
After running the `stripe listen` command you will be provided with the `STRIPE_WEBHOOK_SECRET` that you need to paste into your `.env` file for the webhook to function properly. Installation instructions for your local development environment will be in the stripe-cli link above

To make test purchases in your local environment you can enter card nr. `4242 4242 4242 4242`. Any 4 numbers for expiration date for example `03/11` and any 3 numbers for CVC code for example `111`. This is stripe's testing card numbers

#### To enter Stripe's live mode you need to complete your business profile in [Stripe's dashboard](https://dashboard.stripe.com/test/dashboard) and change the API keys from _test_ to _live API keys_. Also after running `php artian cashier:webhook` in your production server you need to go to the [webhooks page](https://dashboard.stripe.com/webhooks) click on the newly created webhook and copy the `Signin secret` to your `STRIPE_WEBHOOK_SECRET` in your `.env` file. Also i noticed that the `php artian cashier:webhook` doesn't generate the `checkout.session.completed` so you will have to do that manually in order for the purchase to go through. To do that click on the newly created webhook and as of `11/13/2024` you can go to the `...` button on the right side of the page, choose `update details` and on the `events to send` click `select events...` and enter `checkout.session.completed`. This way stripe will start listening for the event and proceed the payment.

> [!IMPORTANT]
>
> ## To make a test live purchase in the [store](https://wittyworkflow.com/shop) login and choose a product to purchase. After clicking `checkout` in the cart, in your order details click `Add promotion code` and enter `100OFF` for a `100%` discount in your order just so you can see that everything works as intended.

# Your application is now ready for use. Enjoy! To install it in production follow your servers specific needs.

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

## Configuration

### **Disabled features:**

> [!IMPORTANT]
>
> #####  Switch the `canEdit()` function in `CRUDSettingsResource.php` to `true` ose `false` to enable or disable choosing whether the admin should be able to edit content or not.

> [!IMPORTANT]
>
> #####  The only disabled feature in the demonstration app is being able to edit the super-admin profile like email and password. That can easily be enabled following the below steps.

### **Side note:**

#### If the `canCreate()`, `canEdit()` or `canDelete()` functions return anything other than a `true` or `false` value is best not to mess with that value because that value is supposed to be that way.

[WittyWorkflow](https:://wittyworkflow.com) uses [filament-breezy](https://filamentphp.com/plugins/jeffgreco-breezy) to
manage user profiles. Change the following value to `shouldRegisterUserMenu: true/false` depending on your app's needs,
to `enable/disable` profile editing on `AdminPanelProvider.php` and `TeamPanelProvider.php` for the `Admin` and `Team member`
roles

```
->myProfile(
    shouldRegisterUserMenu: false, // Sets the 'account' link in the panel User Menu (default = false)
    shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
    navigationGroup: 'Settings', // Sets the navigation group for the My Profile page (default = null)
    hasAvatars: false, // Enables the avatar upload form component (default = false)
    slug: 'profile' // Sets the slug for the profile page (default = 'my-profile')

)
->enableTwoFactorAuthentication(
    force: false, // force the user to enable 2FA before they can use the application (default = false)
)
```

### Role configuration

[WittyWorkflow](https:://wittyworkflow.com) used the [Shield](https://filamentphp.com/plugins/bezhansalleh-shield)
package to manage roles as stated above. In order to give permissions to manage appointments go on the `Roles` section of the dashboard, inside the `Settings` sidebar menu group and for both `team_user` and `panel_user` choose `select all` on
the `Appointment` model permissions and to give the `panel_user` view permissions on the gallery choose  `view`
and `view any` under the `Gallery` model permissions. Also give the `panel_user` all permissions on the `Order` model permissions.

### Role explanation

#### In order to use the Team role you need to create the role from the admin panel and the name of the role should be 'team_user' as it doesn't exist by default and then assign that role to a desired user. Multiple roles can be assigned to a user

* `super_admin` = The super admin of the system
* `team_user` = The team members of the system assigned by the Super Admin
* `panel_user` = The panel for the customers

### Panel switching

> [!NOTE]
>
> In order to properly switch user panels for different roles the admin of the system must be assigned all the available roles (`super_admin`, `team_user` and `panel_user`) in the user resource. That way the admin will not be prompted with a `403` code when trying to access a panel that he doesn't have access to.

### Demonstration environment note

> [!NOTE]
>
> In order to maintain a proper demonstration environment in the [demonstration app](https://wittyworkflow.com/), the admin has only been given the `super_admin` role so when trying to switch panels on the [demonstration app](https://wittyworkflow.com/) you will be prompted with the `403` error. This would be alleviated by simply adding `team_user` and `panel_user` to the admin of the system on the user resource but as stated above this is done INTENTIONALLY to maintain a proper demonstration environment.

<!-- Adding variants -->

### Adding variants

**There are quite a few steps you need to take to add/edit/delete variants and i'll walk you through all of them:**

* Create migration to `add/edit/delete` database variants.
* Update the `ProductVariant.php` factory if needed. As of now only the `size` and `color` variants are assigned on the initial database seed just to keep things simple.
* Add the`Enum` for the newly created variant in `App/Enums`. To keep things simple, the enum can be named the same name as the database column but you can name it whatever you want.
* Update the `getForm()` function in `ProductVariant.php` model, add/edit/delete the desired variants.
* Update the `$table` function in `ProductVariantResource.php`, add/edit/delete the desired variants.
* Update the `$table` function in `VariationsRelationManager.php`, add/edit/delete the desired variants.
* Add/Update/Delete the newly created Enum name inside `config/enums.php`.
* Update '$casts' on the `ProductVariant.php` model

**If the above steps have been implemented, your newly created variant is ready for use throughout the app.**

> [!NOTE]
>
> **The App comes preloaded with some general variants and some tech variants. You should add the variant types that fit the type of store you're building.**

<!-- One Time Passwords -->

> [!Important]
>
> OTP is now available for an extra added layer of security. To enable OTP just go to your desired panels and uncomment  `//FilamentOtpLoginPlugin::make(),`. The available panels are `AdminPanelProvider.php`, `CustomerPanelProvider.php` and `TeamPanelProvider.php`. If you're going to enable OTP is advisable to enable it on all panels but that depends on your app's needs.

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

<!-- USAGE EXAMPLES -->

## Usage

_For App examples, please refer to [WittyWorkflow](https://wittyworkflow.com/)_

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

To access the `super-admin dashboard` email me at `tanellari@gmail.com`.

To access the `team dashboard` go to the [Team dashboard](https://wittyworkflow.com/team/login) and enter the following
credentials:

```
Email: team@example.com
Password: password
```

To access the `customer dashboard` go to the [Customer dashboard](https://wittyworkflow.com/dashboard/login) and create
an account

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

<!-- ROADMAP -->

## Roadmap

1. [X]  Create separate dashboards for each user role
2. [X]  Add Filament [Shield](https://filamentphp.com/plugins/bezhansalleh-shield) for managing user roles and
   permissions
3. [X]  Create business information resources (appointments, services, users etc )
4. [X]  Add socials resource for referencing business's social profiles
5. [X]  Add CRUD functionality to sections of the public page for a more controlled and customizable experience
6. [X]  Add Hero animations
7. [X]  Add footer resources to give users an easy way to add their policies, FAQ and other business related information
8. [X]  Add flash notifications and email notifications for appointment changes
9. [X]  Add shop for purchases
10. [ ]  Add more animated hero options the user can choose from
11. [X]  Improve visuals (**ongoing effort**)
12. [ ]  Add How to section showing the users how to use the app
13. [ ]  Add analytics to admin dashboard
14. [ ]  Improve SEO
15. [X]  Add [Announce](https://filamentphp.com/plugins/rupadana-announce) package to announce different messages to
    system users
16. [X]  Add [Themes](https://filamentphp.com/plugins/hasnayeen-themes) package to give users more options on system
    layout and design
17. [X]  Add [Filament Breezy](https://filamentphp.com/plugins/jeffgreco-breezy) for 2-factor authentication and better
    profile updating
18. [X]  Add [Language-switch](https://filamentphp.com/plugins/bezhansalleh-language-switch) to support different
    languages
19. [X]  Add [Spatie Laravel Health](https://filamentphp.com/plugins/shuvroroy-spatie-laravel-health) to check how the
    app is running.
20. [ ]  Add CRUD for shipping/billing address in the app so you don't have to enter it manually when checking out.
21. [ ]  Add in app tracking for orders. Thinking of using laravel reverb for live tracking.
22. [X]  Add One Time Passwords (OTP) for an extra added layer of security
23. [X]  Add [Panel switch](https://filamentphp.com/plugins/bezhansalleh-panel-switch) so the administrator switches between the panels for each of the available roles to see what's available for that particular panel and make the necessary changes if needed

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

<!-- ISSUES -->

> [!NOTE]
>
> ## Known issues
>
> The following are the known issues that need addressing and i hope that the community will step in and work on them:
>
> * Cart items don't get sent from `session id` to `user_id` if the user was logged out when placing the order but after filling out the cart logs in/registers for an account to continue with the order.

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

## Workaround

For now as a workaround only logged in users can add to cart.

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

<!-- CONTRIBUTING -->

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any
contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please contact me at `tanellari@gmail.com`

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE` for more information.

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

<!-- CONTACT -->

## Contact

Kristi Tanellari - [@TanellariKristi](https://twitter.com/TanellariKristi) - tanellari@gmail.com

Project Link: [https://github.com/kristi11/ww-filament/](https://github.com/kristi11/wittyworkflow/)

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

<!-- ACKNOWLEDGMENTS -->

## Acknowledgments

I've included a few of my favorite links to kick things off!

* [Laravel](https://laravel.com)
* [Filament](https://filamentphp.com/)
* [Livewire](https://livewire.laravel.com)
* [Tailwind CSS](https://tailwindcss.com)
* [README Template](https://github.com/othneildrew/Best-README-Template/)
* [Markdown Badges](https://github.com/Ileriayo/markdown-badges)
* [Choose an Open Source License](https://choosealicense.com)
* [GitHub Pages](https://pages.github.com)

<p align="right">(<a href="#about-the-project">back to top</a>)</p>
