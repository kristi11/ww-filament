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

Disabled features:
* Profile editing (change on Adminpanelprovider.php)
* Permission management for user roles (change on RoleResource.php)
* User resource editing and deleting have been disabled (change on UserResource.php)
* 
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

[![Product Name Screen Shot][product-screenshot]](https://wittyworkflow.com)

##### Wittyworkflow is a dynamic web application poised to evolve into a robust platform designed to streamline business management. The application incorporates a range of features to empower users in efficiently managing their businesses. Below is an overview of the key functionalities and the development journey captured in our roadmap:

## Key Features:

* **Dynamic Hero:** Engage your audience with a visually appealing and dynamic hero section that captures attention and
  communicates your brand essence.

* **Realtime Validation:** Ensure data accuracy and enhance user experience with realtime validation for all components,
  contributing to a seamless interaction.

* **Role-Based Access:** Implement a secure environment with role-based access, allowing team members exclusive access
  to relevant information. Non-team members are restricted from accessing team-related data.

* **Lazy Image Loading:** Optimize performance by incorporating lazy image loading, particularly beneficial in the hero
  section for faster page rendering.

* **SPA functionality with Wire:Navigate :** Enhance navigation with a SPA like menu featuring wire:navigate
  functionality, bringing Single Page Application (SPA) functionality to your site for smooth transitions between links.

* **Laravel Jetstream Authentication:** Benefit from Laravel Jetstream authentication, including features like 2-factor
  authentication and browser session control. Profile information updating has been disabled for demonstration purposes
  but can be enabled through fortify.php with the desired features.

* **Team Management:** Staff members can create teams, ensuring controlled and secure team management.

* **CRUD Operations for Admins:** Enable administrators with CRUD (Create, Read, Update, Delete) operations for users,
  addresses, landing page heroes, appointments, services, opening hours, gallery, socials, and SEO. These
  functionalities empower admins with comprehensive control over critical aspects of the platform.

* **Public Email Form and Footer:** Facilitate communication by implementing a public email form and completing the
  footer for a professional and polished user interface.

* **Email Notifications on Appointment Changes:** Receive email notifications for changes in appointments, ensuring you
  never miss valuable information about your upcoming appointments.

* **Newsletter Creation:** Planned feature (Not yet finished): Develop a newsletter system to keep users informed and
  engaged with your platform.

* **Progressive Web App (PWA):** Planned feature (Not yet started): Transform the web app into a Progressive Web App,
  providing users with an enhanced offline experience and improved accessibility.

* **Jetstream Configuration (jetstream.php):** Customize Jetstream features by editing the jetstream.php configuration
  file. Enable the desired features according to your project requirements.

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

This project uses [Laravel 10.x](https://laravel.com/docs/master#install-composer) with
the  [livewire 3.x](https://livewire.laravel.com/docs/quickstart) stack.

### Installation

To get started clone this repository.

1. Clone the repo
   ```
   git clone https://github.com/kristi11/wittyworkflow.git
   ```
   or if you have a different name you'd like to use for the project create an empty folder with your desired name and
   run the following command:
   ```
   git clone https://github.com/kristi11/wittyworkflow.git .
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
6. Create an empty database for our application. I personally like using [TablePlus](https://tableplus.com/) but you can
   use whatever you like.
7. In the `.env` file, add database information to allow Laravel to connect to the database. The default database name
   is `wittyworkflow`. If you are using a different name, you'll need to edit the `DB_DATABASE` variable in the `.env`
   file with your database name.
8. Migrate and seed the database.
   ```
   php artisan migrate:fresh --seed
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
13. Login to the admin dashboard with the following credentials:
    ```
    email: kristi@wittyworkflow.com
    
    password: password
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

To set up your chat credentials first you have to sign up for [pusher](https://pusher.com/).
[Here's](https://chatify.munafio.com/installation) the setup and installation video from the creator of laravel chatify
.This includes the set up of pusher and the installation of chatify(which is already installed).
Then fill the following credentials to the `.env` file with the credentials from your pusher account.

```
PUSHER_APP_ID=your-pusher-app-id
PUSHER_APP_KEY=your-pusher-app-key
PUSHER_APP_SECRET=your-pusher-app-secret
PUSHER_APP_CLUSTER=your-pusher-app-cluster
```

also add the following to the `.env` file

```
CHATIFY_STORAGE_DISK=your-s3-bucket-or-custom-driver
CHATIFY_ROUTES_PREFIX=your-chatify-routes-prefix
CHATIFY_NAME=Chatify-messeneger-name-here
```

The private bucket is used to store the livewire `tmp` files and the public bucket is used to store the images
accessible to everyone.

To clean up the `tmp` files uploaded on `S3` every 24 hours add the following command to your server

```
php artisan livewire:configure-s3-upload-cleanup
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



<!-- ROADMAP -->

## Roadmap

1. [x] Create jetstream project
2. [x] Dynamic hero
3. [x] Realtime validation for all components
4. [x] Lazy image loading on hero
5. [x] Create role based access to team members.Non-team members do not have access to teams
6. [x] Add wire:navigate to links for SPA functionality.
7. [x] Staff members can create their own teams but cannot modify teams they belong to teams disabled momentarily
8. [x] Above functionality for responsive menu
9. [x] Disable making a user an administrator on JetstreamServiceProvider
10. [x] Create CRUD for users. Only admin can access it
11. [x] Create CRUD for address. Only admin can access it
12. [x] Create CRUD for landingpage hero. Only admin can access it
13. [x] Create appointments component
14. [x] Create CRUD for appointments. Only admin can access it
15. [x] Create CRUD for services. Only admin can access it
16. [x] Create CRUD for opening hours. Only admin can access it
17. [x] Create CRUD for gallery. Only admin can access it
18. [x] Create CRUD for socials. Only admin can access it
19. [x] complete public email form
20. [x] complete footer
22. [x] create newsletter (newsletter created but needs changes to be made)
23. [x] make CRUD for SEO
24. [x] install Schema.org for better SEO
25. [ ] make PWA for the website
26. [ ] make a blog
27. [ ] make a shop
28. [ ] make a forum
29. [x] make a chat
30. [ ] make a calendar
31. [ ] make a CRM
32. [ ] make a project management tool
33. [ ] make a time tracking tool
34. [ ] make a billing tool
35. [ ] make a file sharing tool
36. [ ] make a video conferencing tool
37. [ ] make a note taking tool
38. [ ] make a task management tool
39. [ ] Create AI chatbot
40. [x] Create dark/light mode toggle
41. [ ] Integrate google analytics

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- CONTRIBUTING -->

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any
contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also
simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- CONTACT -->

## Contact

Kristi Tanellari - [@TanellariKristi](https://twitter.com/TanellariKristi) - tanellari@gmail.com

Project Link: [https://github.com/kristi11/wittyworkflow/](https://github.com/kristi11/wittyworkflow/)

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- ACKNOWLEDGMENTS -->

## Acknowledgments

I've included a few of my favorite links to kick things off!

* [Laravel](https://laravel.com)
* [Livewire](https://livewire.laravel.com)
* [Tailwind CSS](https://tailwindcss.com)
* [README Template](https://github.com/othneildrew/Best-README-Template/)
* [Schema.org](https://schema.org)
* [Img Shields](https://shields.io)
* [Choose an Open Source License](https://choosealicense.com)
* [GitHub Emoji Cheat Sheet](https://www.webpagefx.com/tools/emoji-cheat-sheet)
* [Malven's Flexbox Cheatsheet](https://flexbox.malven.co/)
* [Malven's Grid Cheatsheet](https://grid.malven.co/)
* [Img Shields](https://shields.io)
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
