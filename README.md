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

### **Disabled features:**

##### The following features have been disabled to maintain a proper demonstration environment. You should enable this features when working on your own project to get the full functionality of the app.

* Profile editing (change on Adminpanelprovider.php)
* Permission management for user roles (change on RoleResource.php)
* User resource editing and deleting have been disabled (change on UserResource.php)
* Hero resource editing and deleting have been disabled (change on HeroResource.php)
* SectionColors resource editing and deleting have been disabled (change on SectionColorResource.php)
* Service resource editing and deleting have been disabled (change on ServiceResource.php)
* Section visibility on the landing page has been disabled (change on PublicPageResource.php)
* Address resource editing and deleting have been disabled (change on AddressResource.php)
* BusinessHours resource editing and deleting have been disabled (change on BusinessHoursResource.php)
* Flexibility resource editing and deleting have been disabled (change on FlexibilityResource.php)
* Announcement resource editing and deleting have been disabled (change on AnnouncementResource.php)
* Social resource editing and deleting have been disabled (change on SocialResource.php)
* Gallery resource creating, editing and deleting have been disabled (change on GalleryResource.php)

### If the `canCreate` function simply returns false, it's safe to be added/removed based on your app's needs. If the function checks if the record exists then returns the proper action, it shouldn't be messed with, since  only 1 database row has to be created for the app to work properly and avoid duplicate data.

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
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
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

##### Wittyworkflow is a dynamic web application poised to evolve into a robust platform designed to streamline business management. The application incorporates a range of features to empower users in efficiently managing their businesses. Below is an overview of the key functionalities and the development journey captured in our roadmap:

## Key Features:

* **Dynamic Hero:** Engage your audience with a visually appealing and dynamic hero section that captures attention and
  communicates your brand essence. The hero is fully customizable from the admin panel to ensure a seamless user experience.

* **Role-Based Access:** Utilizing the powerful Filament PHP, Wittyworkflow offers role-based access control, enabling
  different panels for different user roles. Admins have full access to all functionalities, while staff members and customers have a more limited view.

* **SPA functionality with Wire:Navigate :** Enhance navigation with a SPA like menu featuring wire:navigate
  functionality, bringing Single Page Application (SPA) functionality to your site for smooth transitions between links.

* **CRUD Operations for Admins:** Enable administrators with CRUD (Create, Read, Update, Delete) operations for users,
  addresses, landing page heroes, appointments, services, opening hours, gallery, socials, and SEO. These
  functionalities empower admins with comprehensive control over critical aspects of the platform.

* **Public Email Form and Footer:** Facilitate communication by implementing a public email form and completing the
  footer for a professional and polished user interface.

* **Email Notifications on Appointment Changes:** Receive email notifications for changes in appointments, ensuring you
  never miss valuable information about your upcoming appointments.

* **Full control** on what section shows/hides from the landing page depending on your businesses need for the section

## About Wittyworkflow:

Wittyworkflow is designed to empower businesses through a comprehensive suite of features, combining dynamic visual
elements with secure and efficient management tools. The roadmap reflects the commitment to continuous improvement and
innovation. Join up on this journey as we work towards creating a platform that simplifies business operations and
fosters growth.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

This section lists all major frameworks/libraries used to bootstrap this project.

* [![Laravel][Laravel.com]][Laravel-url]
* [![Livewire][Livewire.laravel.com]][Livewire-url]
* [![Tailwind CSS][tailwindcss.com]][tailwindcss-url]
* [![Amazon s3][Amazon s3]][Amazon s3-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- GETTING STARTED -->

## Getting Started

This project is built with [Filament 3](https://filamentphp.com)

### Installation

To get started clone this repository.

1. Clone the repo
   ```
   https://github.com/kristi11/ww-filament.git
   ```
   or if you have a different name you'd like to use for the project create an empty folder with your desired name and
   run the following command:
   ```
   https://github.com/kristi11/ww-filament.git .
   ```
   this will clone all of the project's content without the project name folder.
2. Install NPM packages
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
6. Create an empty database for your application. I personally like using [TablePlus](https://tableplus.com/) but you can
   use whatever you like.
7. In the `.env` file, add database information to allow Laravel to connect to the database. The default database name
   is `wittyworkflow`. If you are using a different name, you'll need to edit the `DB_DATABASE` variable in the `.env`
   file with your database name.
8. Migrate and seed the database.
   ```
   php artisan migrate:fresh --seed
   ```
   
9. Wittyworkflow uses Shield package to provide proper user roles. We need to generate the permissions for that package 
    ```
    php artisan shield:generate --all
    ```
   and define the super admin of the system 
    ```
    php artisan shield:super-admin --user="1"
    ```
   
    --user=1 is the id of the user that will be the super admin. You can change it to whatever user you want to be the super admin. the credentials for the super admin are the following:
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

I use [Mailtrap](https://mailtrap.io/) for email testing. You can use whatever you like. If you want to use Mailtrap,
create an account and add the credentials to the `.env` file. If you are using [forge](https://forge.laravel.com/) you
can add the credentials to the server environment variables.

If you decide to use mailtrap, you can use the following credentials:

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

This app stores files in [Amazon s3](https://aws.amazon.com/s3/). If you want to
use [Amazon s3](https://aws.amazon.com/s3/) you need to add the credentials to the `.env` file.

```
AWS_ACCESS_KEY_ID=your_access_key
AWS_SECRET_ACCESS_KEY=your_secret_key
AWS_DEFAULT_REGION=your_region
AWS_BUCKET=your-bucket-private
AWS_BUCKET_PUBLIC=your-bucket-public
AWS_USE_PATH_STYLE_ENDPOINT=false
```

For help setting up [Amazon s3](https://aws.amazon.com/s3/) you can check out
this [tutorial](https://laracasts.com/series/multitenancy-in-practice/episodes/7) by Kevin McKee, a laracasts
instructor. This is a paid tutorial but it's worth it. I learned a lot from it. And, No I'm not affiliated with
laracasts in any way. If you're having trouble setting up [Amazon s3](https://aws.amazon.com/s3/) you can contact me and
I'll try to help you out. Or you can choose to use a different storage provider.

If you are using [forge](https://forge.laravel.com/) you can add the credentials to the server environment variables.

Your application is now ready for use. Enjoy! To install it in production follow your servers specific needs.

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->

## Usage

_For App examples, please refer to [WittyWorkflow](https://wittyworkflow.com/)_

<p align="right">(<a href="#readme-top">back to top</a>)</p>

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

[product-screenshot]: public/Screenshot-wittyworkflow.png

[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white

[Laravel-url]: https://laravel.com

[Livewire.laravel.com]: https://img.shields.io/badge/Livewire-E05890?style=for-the-badge&logo=livewire&logoColor=white

[Livewire-url]: https://livewire.laravel.com

[tailwindcss.com]: https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white

[tailwindcss-url]: https://tailwindcss.com

[Amazon s3]: https://img.shields.io/badge/Amazon_AWS-232F3E?style=for-the-badge&logo=amazon-aws&logoColor=white

[Amazon s3-url]: https://aws.amazon.com/s3/

[Filament PHP]: https://img.shields.io/badge/Filament-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
