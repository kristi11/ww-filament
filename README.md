<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->

[![LinkedIn][linkedin-shield]][linkedin-url]



<!-- PROJECT LOGO -->
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
    <b>PLEASE DO KEEP IN MIND THAT THIS IS A NEW APP AND THERE WILL BE A LOT OF ROOM FOR IMPROVEMENT</b>

### The app's CRUD functionality has been severally restricted in this [demonstration](https://wittyworkflow.com) app. Follow the below steps to activate CRUD functionality on the desired resources in order to achieve the desired functionality

## **THIS REPOSITORY SHOULD BE USED ON A BRAND-NEW PROJECT**

</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
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
    <li><a href="#configuration">Configuration</a></li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->

## About The Project

##### [WittyWorkflow](https:://wittyworkflow.com) is a dynamic web application poised to evolve into a robust platform designed to streamline business management. The application incorporates a range of features to empower users in efficiently managing their businesses. Below is an overview of the key functionalities of the app:

## Key Features:

* **Dynamic Hero:** Engage your audience with a visually appealing and dynamic hero section that captures attention and
  communicates your brand essence. The hero is fully customizable from the admin panel to ensure a seamless user
  experience.

* **Role-Based Access:** Utilizing the
  powerful [Filament PHP](https://filamentphp.com/), [WittyWorkflow](https:://wittyworkflow.com) offers role-based
  access control, enabling
  different panels for different user roles. Admins have full access to all functionalities, while staff members and
  customers have a more limited view.

* **SPA functionality with `Wire:Navigate` :** Enhance navigation with an SPA like menu featuring `wire:navigate`
  functionality, bringing Single Page Application (SPA) functionality to your site for smooth transitions between links.

* **Public Email Form and Footer:** Facilitate communication by implementing a public email form and completing the
  footer for a professional and polished user interface.

* **Enhanced Footer:**  Showing different requirements/terms/help etc. of what your business has/requires/offers

* **Appointments:** Manage your appointments

* **Email Notifications on Appointment Changes:** Receive email notifications for changes in appointments, ensuring you
  never miss valuable information about your upcoming appointments.

* **Full control:** On what section shows/hides from the landing page depending on your businesses need for the section

* **2-Factor authentication:** To enhance security of your accounts

* **Theme customization:** To give every user the ability to customize the look and feel of the app to their liking

* **Application health:** See how your application is performing and make the necessary changes in the server

* **Business information:** Have full access on different aspects of your business including system users, section
  visibility, business services, announcements and much more...

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Built With

This section lists all major frameworks/libraries used to bootstrap this project.

* [![Laravel][Laravel.com]][Laravel-url]
* [![Livewire][Livewire.laravel.com]][Livewire-url]
* [![Tailwind CSS][tailwindcss.com]][tailwindcss-url]
* [![Amazon s3][Amazon s3]][Amazon s3-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>



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
   to provide proper user roles. We need to generate the permissions for that package
    ```
    php artisan shield:generate --all
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
php artisan shield:generate --all
php artisan shield:super-admin --user="1"
php artisan storage:link
```

Don't forget to run `npm run dev` and `php artisan serve`
after the above commands are ran.

I use [Mailtrap](https://mailtrap.io/) for email testing. You can use whatever you like. If you want to
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

Your application is now ready for use. Enjoy! To install it in production follow your servers specific needs.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Configuration

### **Disabled features:**

##### The following features have been disabled to maintain a proper demonstration environment. You should enable this features when working on your own project to get the full functionality of the app.

### Editing:

* Profile editing (change on `Adminpanelprovider.php` and `TeamPanelProvider.php`)

### Permission management:

* Permission management for user roles (change on `RoleResource.php`)

### Editing and deleting:

* User resource (change on `UserResource.php`)
* Hero resource (change on `HeroResource.php`)
* SectionColors resource (change on `SectionColorResource.php`)
* Service resource (change on `ServiceResource.php`)
* Section visibility on the landing page (change on `PublicPageResource.php`)
* Address resource (change on `AddressResource.php`)
* BusinessHours resource (change on `BusinessHoursResource.php`)
* Flexibility resource (change on `FlexibilityResource.php`)
* Announcement resource (change on `AnnouncementResource.php`)
* Social resource (change on `SocialResource.php`)
* Gallery resource creating, (change on `GalleryResource.php`)
* About resource (change on `AboutResource.php`)
* Contact resource (change on `ContactResource.php`)
* FAQ resource (change on `FAQdataResource.php`)
* Help resource (change on `HelpResource.php`)
* Privacy resource (change on `PrivacyResource.php`)
* Terms resource (change on `TermsResource.php`)
* Support resource (change on `SupportResource.php`)

#### **To enable these features you need to comment or delete the following functions on the desired resources:**

```
public static function canEdit(Model $record): bool
    {
        return false;
    }
public static function canDelete(Model $record): bool
    {
        return false;
    }
```

#### **You can also comment the can create function based on necessity of your app:**

```
public static function canCreate(): bool
    {
        return false;
    }
```

#### If the `canCreate` function simply returns false, it's safe to be added/removed based on your app's needs. If the function checks if the record exists then returns the proper action, it shouldn't be messed with, since  only 1 database row has to be created for the app to work properly and avoid duplicate data.

[WittyWorkflow](https:://wittyworkflow.com) uses [filament-breezy](https://filamentphp.com/plugins/jeffgreco-breezy) to
manage user profiles. Change the following values to `shouldRegisterUserMenu: true` and `shouldRegisterNavigation: true`
to enable profile editing on `AdminPanelProvider.php` and `TeamPanelProvider.php` for the `Admin` and `Team member`
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

#### **Bulk actions have been disabled for the resources to maintain the integrity of a demonstration environment on a

production server since this repo is being used to show the live server on the official website**

###### To enable the bulk actions uncomment the following code on the necessary resources

`//Tables\Actions\DeleteBulkAction::make(),`

### Role configuration

[WittyWorkflow](https:://wittyworkflow.com) used the [Shield](https://filamentphp.com/plugins/bezhansalleh-shield)
package to manage roles as stated above. In order to give permissions to manage appointments go on the `Roles` section
of the dashboard under `Filament Shield` sidebar menu and for both `team_user` and `panel_user` choose `select all` on
the `Appointment` model permissions and to give the `panel_user` `view` permissions on the gallery choose  `view`
and `view any` under the `Gallery` model permissions.

### Role explanation

* `super_admin` = The super admin of the system
* `team_user` = The team members of the system assigned by the Super Admin
* `panel_user` = The panel for the customers

<!-- USAGE EXAMPLES -->

## Usage

_For App examples, please refer to [WittyWorkflow](https://wittyworkflow.com/)_

<p align="right">(<a href="#readme-top">back to top</a>)</p>

To access the `super-admin dashboard` go to the [Admin dashboard](https://wittyworkflow.com/admin/login) and enter the
following credentials:

```
Email: admin@example.com
Password: password
```

To access the `team dashboard` go to the [Team dashboard](https://wittyworkflow.com/team/login) and enter the following
credentials:

```
Email: team@example.com
Password: password
```

To access the `customer dashboard` go to the [Customer dashboard](https://wittyworkflow.com/dashboard/login) and create
an account

<p align="right">(<a href="#configuration">back to top</a>)</p>

<!-- ROADMAP -->

## Roadmap

1. [x] Create separate dashboards for each user role
2. [x] Add Filament [Shield](https://filamentphp.com/plugins/bezhansalleh-shield) for managing user roles and
   permissions
3. [x] Create business information resources (appointments, services, users etc )
4. [x] Add socials resource for referencing business's social profiles
5. [x] Add CRUD functionality to sections of the public page for a more controlled and customizable experience
6. [x] Add Hero animations
7. [x] Add footer resources to give users an easy way to add their policies, FAQ and other business related information
8. [x] Add flash notifications and email notifications for appointment changes
9. [ ] Add shop for purchases ( Thinking of [lunarPHP](https://lunarphp.io/) since it already has
   a [filamentPHP](https://filamentphp.com/) admin dashboard)
10. [ ] Add more animated hero options the user can choose from
11. [ ] Improve visuals (**ongoing effort**)
12. [ ] Add How to section showing the users how to use the app
13. [ ] Add analytics to admin dashboard
14. [ ] Improve SEO
15. [x] Add [Announce](https://filamentphp.com/plugins/rupadana-announce) package to announce different messages to
    system users
16. [x] Add [Themes](https://filamentphp.com/plugins/hasnayeen-themes) package to give users more options on system
    layout and design
17. [x] Add [Filament Breezy](https://filamentphp.com/plugins/jeffgreco-breezy) for 2-factor authentication and better
    profile updating
18. [x] Add [Language-switch](https://filamentphp.com/plugins/bezhansalleh-language-switch) to support different
    languages
19. [x] Add [Spatie Laravel Health](https://filamentphp.com/plugins/shuvroroy-spatie-laravel-health) to check how the
    app is running

<p align="right">(<a href="#roadmap">back to top</a>)</p>

<!-- CONTRIBUTING -->

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any
contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please contact me at `tanellari@gmail.com`

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- CONTACT -->

## Contact

Kristi Tanellari - [@TanellariKristi](https://twitter.com/TanellariKristi) - tanellari@gmail.com

Project Link: [https://github.com/kristi11/ww-filament/](https://github.com/kristi11/wittyworkflow/)

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- ACKNOWLEDGMENTS -->

## Acknowledgments

I've included a few of my favorite links to kick things off!

* [Laravel](https://laravel.com)
* [Filament](https://filamentphp.com/)
* [Livewire](https://livewire.laravel.com)
* [Tailwind CSS](https://tailwindcss.com)
* [README Template](https://github.com/othneildrew/Best-README-Template/)
* [Img Shields](https://shields.io)
* [Choose an Open Source License](https://choosealicense.com)
* [GitHub Pages](https://pages.github.com)

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555

[linkedin-url]: https://linkedin.com/in/othneildrew

[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white

[Laravel-url]: https://laravel.com

[Livewire.laravel.com]: https://img.shields.io/badge/Livewire-E05890?style=for-the-badge&logo=livewire&logoColor=white

[Livewire-url]: https://livewire.laravel.com

[tailwindcss.com]: https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white

[tailwindcss-url]: https://tailwindcss.com

[Amazon s3]: https://img.shields.io/badge/Amazon_AWS-232F3E?style=for-the-badge&logo=amazon-aws&logoColor=white

[Amazon s3-url]: https://aws.amazon.com/s3/

[Filament PHP]: https://img.shields.io/badge/Filament-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
