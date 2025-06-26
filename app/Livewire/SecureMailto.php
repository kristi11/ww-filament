<?php

/**
 * Livewire component for securely handling mailto links.
 *
 * This component provides functionality to encode an email address
 * and redirect the user to a secure mailto link.
 */

namespace App\Livewire;

use /**
 * The Factory contract is responsible for creating view instances.
 * It defines methods to interact with views, allowing the rendering of templates
 * and sharing data across views within the Laravel application.
 *
 * This contract is implemented by the Laravel's view factory class
 * and can be bound to the application service container for customizing view functionality.
 *
 * Common functionality includes:
 * - Retrieving a view instance by name.
 * - Passing and sharing data across view templates.
 * - Checking if a view exists within the application.
 */
Illuminate\Contracts\View\Factory;
use /**
 * Interface Illuminate\Contracts\View\View
 *
 * This interface defines the contract for view rendering in Laravel.
 * Classes implementing this interface are responsible for rendering content
 * returned by the view instance. It encapsulates the logic for rendering
 * views and returning output as a string.
 *
 * Implementing this interface enables flexibility in modifying or extending
 * the behavior of view generation in Laravel.
 */
Illuminate\Contracts\View\View;
use /**
 * The Laravel application instance.
 *
 * This class is the core of a Laravel application. It is responsible for
 * managing the services, configuration, and environment of the application.
 */
Illuminate\Foundation\Application;
use /**
 * This class represents a Livewire component in a Laravel application.
 *
 * Livewire is a framework for building dynamic interfaces in Laravel applications
 * by using components that can handle frontend interactions and synchronize them
 * with backend logic.
 *
 * This component is designed to work with Laravel v10.48.26 and utilizes a MySQL
 * database connection. The queue connection is set to "sync", meaning tasks are
 * executed synchronously.
 *
 * Ensure this component is used within the context of a Laravel application
 * with the appropriate Livewire and related dependencies installed.
 *
 * For additional functionality or customization, extend this class and
 * override the necessary methods or properties in accordance with Livewire's
 * component lifecycle methods.
 */
Livewire\Component;

/**
 * A Laravel Livewire component that facilitates redirection to a mailto link.
 */
class SecureMailto extends Component
{
    public $email;

    public function redirectToMailto()
    {
        $encodedEmail = urlencode($this->email);
        $mailtoLink = "mailto:$encodedEmail";

        return redirect()->to($mailtoLink);
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.secure-mailto');
    }
}
