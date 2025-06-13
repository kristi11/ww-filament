<div>

    <meta charset="UTF-8"/>
    <meta
        http-equiv="Content-Security-Policy"
        content="
        default-src 'self';
        script-src 'self';
        style-src 'self' 'unsafe-inline';
        img-src 'self' https://* data:;
        font-src 'self';
        connect-src 'self';
        media-src 'self';
        object-src 'none';
        child-src 'none';
        frame-ancestors 'self';
        form-action 'self';
        base-uri 'self';
    "
    />
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ asset('sitemap.xml') }}"/>
    <link rel="canonical" href="{{ URL::current() }}"/>
    <meta property="og:title" content="Witty Workflow"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ config('APP_URL') }}"/>
    <meta property="og:image" content="{{ asset('logo.svg') }}"/>
    <meta property="og:description"
          content="Witty Workflow is a dynamic web application poised to evolve into a robust platform designed to streamline business management. The application incorporates a range of features to empower users in efficiently managing their businesses."/>
    <meta name="twitter:card" content="summary"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="description"
          content="Witty Workflow is a dynamic web application poised to evolve into a robust platform designed to streamline business management. The application incorporates a range of features to empower users in efficiently managing their businesses."/>
    <meta name="keywords"
          content="Witty Workflow, Business Management, Workflow Automation, Business Process Management, Management Tools, Efficient Business Operations, Business Optimization, Enterprise Workflow, Dynamic Web Application, Streamline Business">
    <meta name="author" content="Kristi Tanellari"/>
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        @vite('resources/css/app.css')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "SoftwareApplication",
          "name": "Witty Workflow",
          "description": "A business management tool with role based access to different dashboards. It includes appointments, CRUD for business information, email notifications, flash notifications, full control on the visibility of the public page sections, enhanced footer, application health, 2 factor authentication, profile editing and more.",
          "applicationCategory": "BusinessApplication",

          "brand": {
            "@type": "Brand",
            "name": "Witty Workflow"
          },
          "provider": {
            "@type": "Organization",
            "name": "Witty Workflow"
          }
        }
    </script>
    <style>
        html {
            scroll-behavior: smooth;
            scroll-padding: 10rem;
        }
    </style>
</div>
