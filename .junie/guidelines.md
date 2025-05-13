Junie Guidelines for Optimal Results
These guidelines ensure Junie generates high-quality, consistent code, tests, and documentation for projects using Laravel, Filament PHP, Livewire, Tailwind CSS, and Alpine.js. Follow these rules to align with the TALL stack, preserve existing naming conventions (especially for Filament), prioritize functionality, and ensure responsiveness.
General Principles

Code Style: Adhere to PSR-12 for PHP. Use 4-space indentation, camelCase for variables and methods, and PascalCase for class names, unless existing conventions differ.
Naming Conventions: Preserve existing naming conventions by analyzing current project files (e.g., app/Filament/Resources/, app/Models/, app/Livewire/). For Filament resources, models, and components, match the naming patterns already in use (e.g., UserResource, Product, OrderTable).
Project Structure: Follow Laravel’s default directory structure (app/, resources/, tests/, etc.). Place Filament resources in app/Filament/Resources/, Livewire components in app/Livewire/, Tailwind CSS in resources/css/, and Alpine.js scripts in resources/js/ or inline in Blade templates when appropriate.
Commit Messages: Use clear, concise commit messages following the Conventional Commits format (e.g., feat: add user resource, fix: resolve login bug).
Error Handling: Include try-catch blocks for database operations and API calls. Return meaningful error messages using Laravel’s abort() or custom exceptions.
Performance: Optimize queries with eager loading (with()), add indexes to frequently queried columns (e.g., email, name), and cache repetitive data using Laravel’s caching system.
Responsiveness: All generated UI elements must be fully responsive using Tailwind CSS, tested across mobile, tablet, and desktop breakpoints.

Coding Standards
PHP and Laravel

Naming:
Match existing model names (e.g., User, Order) and Filament resource names (e.g., UserResource, OrderResource) as found in app/Models/ and app/Filament/Resources/.
For new Livewire components, follow existing patterns in app/Livewire/ (e.g., UserTable, CreateUserForm).


Eloquent:
Use Eloquent relationships (hasMany, belongsTo, etc.) over raw queries.
Avoid N+1 query issues by using with() for related data.
Use query scopes for reusable query logic, e.g., scopeActive($query), matching existing scope naming.


Validation:
Use Livewire’s validation in components, e.g., protected $rules = ['email' => 'required|email|unique:users,email'];.
For Filament forms, define validation in form() schema, e.g., TextInput::make('email')->required()->email()->unique('users', 'email').


Routing:
Use Laravel’s resourceful routes or Livewire’s route registration for navigation, e.g., Route::get('/users', UserTable::class);.
Avoid controllers; rely on Livewire components for logic.


Blade Templates:
Use Blade components for reusable UI elements, e.g., <x-button>.
Keep logic minimal; move complex logic to Livewire components or Alpine.js for lightweight reactivity in non-Filament contexts.



Filament PHP

Resources:
Place in app/Filament/Resources/, preserving existing names, e.g., UserResource.php.
Define form() for create/edit forms and table() for listing with searchable/sortable columns (e.g., name, email).
Enable pagination by default; use ->paginated([10, 25, 50]).


Filters:
Use SelectFilter for role-based filtering, preloading options, e.g., Role::pluck('name', 'id').
Cache filter options, e.g., Cache::remember('roles', 3600, fn () => Role::pluck('name', 'id')).


Performance:
Optimize table queries with select() for specific columns.
Use deferredLoading() for large datasets in tables.


Alpine.js:
Avoid Alpine.js in Filament resources unless necessary for specific functionality not achievable with Livewire.
If used, ensure it does not interfere with Filament’s Livewire-based reactivity; prioritize functionality over reactivity.



Livewire

Components:
Place in app/Livewire/, matching existing naming patterns, e.g., UserTable, CreateUserForm.
Use single-responsibility components, e.g., one for forms, another for tables.


Reactivity:
Bind form inputs with wire:model for real-time updates.
Use wire:loading for UX feedback during async operations.


Best Practices:
Avoid heavy computations in render methods; use computed properties or actions.
Implement error handling with $this->addError() for validation failures.


Alpine.js Integration:
Use Alpine.js in Livewire components for lightweight, client-side reactivity (e.g., toggling UI elements) when Livewire’s server-side rendering is unnecessary.
Include Alpine.js via <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> in the Blade template or via resources/js/app.js if bundled.
Ensure Alpine.js does not compromise functionality; prioritize Livewire for critical interactions.



Tailwind CSS

Utility-First:
Use Tailwind’s utility classes exclusively for styling in Blade, Livewire, and Filament templates, e.g., class="bg-blue-500 text-white p-4".
Do not use custom CSS or other frameworks; define any custom styles in resources/css/app.css using Tailwind’s @apply.


Responsiveness:
Apply responsive prefixes, e.g., sm:flex, md:grid-cols-2, for mobile, tablet, and desktop layouts.
Test all UI elements across breakpoints (e.g., sm:, md:, lg:) to ensure usability.


Consistency:
Follow existing color palettes and styles in the project, e.g., blue-500 for primary buttons, gray-200 for backgrounds.
Use tailwind.config.js for custom themes, fonts, or plugins.


Alpine.js Synergy:
Combine Tailwind with Alpine.js for dynamic styling, e.g., x-bind:class="{ 'hidden': !open }".



Alpine.js

Usage:
Prefer Alpine.js in non-Filament Blade bày or Livewire components for lightweight, client-side reactivity (e.g., modals, dropdowns, toggles).
Use Alpine.js in Filament panels only if necessary for functionality not achievable with Livewire, ensuring no disruption to Filament’s reactivity.
Prioritize functionality over reactivity; only include Alpine.js when it enhances UX without compromising stability.


Setup:
Include Alpine.js via CDN in resources/views/layouts/app.blade.php: <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>.
Alternatively, bundle via npm in resources/js/app.js with import 'alpinejs'; and compile with Vite (npm run build).


Best Practices:
Use x-data for reactive state, e.g., <div x-data="{ open: false }">.
Leverage x-bind, x-on, and x-show for dynamic behavior, e.g., <button x-on:click="open = !open">Toggle</button>.
Keep Alpine.js logic minimal; move complex logic to Livewire or Laravel.
Ensure Tailwind compatibility, e.g., <div x-bind:class="{ 'hidden': !open }">.


Performance:
Avoid excessive x-for loops or complex computations; delegate to Livewire or Laravel for heavy lifting.
Minify Alpine.js scripts when bundling for production.



Testing

Unit Tests:
Write PHPUnit tests for models and services in tests/Unit/.
Use existing model factories for test data, e.g., User::factory()->create().


Feature Tests:
Write feature tests for Livewire components and Filament resources in tests/Feature/.
Test Livewire using Livewire::test(), e.g., Livewire::test(UserTable::class)->assertSee('John Doe').
Test Alpine.js behavior with Laravel Dusk for browser-based testing, e.g., asserting visibility of x-show elements.


Coverage:
Aim for at least 80% test coverage for critical paths (e.g., authentication, payments).
Use assertStatus(), assertSee(), and assertDatabaseHas() for assertions.



Documentation

PHPDoc:
Include PHPDoc blocks for classes, methods, and properties, e.g., @param string $email, @return \Illuminate\Http\JsonResponse.


README:
Update README.md with setup instructions, dependencies (including Alpine.js), and usage examples.
Include a changelog for major updates.


Filament and Alpine.js:
Document Filament resources, widgets, and Alpine.js usage in docs/ or inline comments, respecting existing naming.
Explain x-data states, Livewire interactions, and Tailwind classes for clarity.



Junie-Specific Instructions

Task Execution:
Propose a plan before executing tasks, detailing files to modify or create.
Prefer small, focused changes over large refactors unless requested.
Evaluate Alpine.js necessity for non-Filament tasks; use only for lightweight reactivity, and sparingly in Filament if functionality requires it.


Code Review:
Run php artisan lint and composer test before committing.
Ensure code passes PSR-12 checks using pint.
Verify Alpine.js scripts load correctly and don’t conflict with Livewire or Filament.


Context Awareness:
Reference existing files (e.g., app/Models/User.php, app/Filament/Resources/UserResource.php) to maintain naming and style consistency.
Analyze recent commits to adapt to the project’s coding patterns, especially Filament resource names.


Output:
Generate complete, functional code snippets with Tailwind CSS for styling.
Include comments explaining complex logic, Alpine.js usage, or non-obvious decisions.
Ensure all UI elements are responsive with Tailwind’s responsive utilities.



Example Task
Task: Create a non-Filament Livewire component for a responsive user profile card with an Alpine.js-powered toggle for privacy settings, respecting existing naming conventions.

Steps:
Create a Livewire component in app/Livewire/, e.g., UserProfileCard.php, matching existing naming patterns.
Create resources/views/livewire/user-profile-card.blade.php with Tailwind CSS and Alpine.js for toggling privacy.
Include Alpine.js CDN in resources/views/layouts/app.blade.php.
Add a Dusk test in tests/Browser/UserProfileCardTest.php to verify toggling.
Update README.md with usage instructions.


Output:
Use Tailwind classes like sm:flex, md:max-w-lg for responsiveness.
Implement Alpine.js with x-data="{ isPrivate: false }", ensuring functionality (e.g., saving privacy state) via Livewire.
Verify no conflicts with Livewire, full responsiveness, and adherence to existing naming (e.g., User model, UserResource).



By following these guidelines, Junie will produce functional, responsive code that aligns with your TALL stack, uses Tailwind CSS exclusively, integrates Alpine.js appropriately, and preserves existing naming conventions, especially for Filament, minimizing rework and enhancing maintainability.
