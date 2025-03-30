<?php

/**
 * StripeEventListener is responsible for handling Stripe webhook events.
 * In this context, it listens for the `checkout.session.completed` event
 * and triggers appropriate actions to handle the event's payload.
 */

namespace App\Listeners;

use /**
 * This class handles the completion of a checkout session in the Laravel application.
 *
 * Responsibilities:
 * - Executes actions required when a checkout session is successfully completed, such as updating the database
 *   or triggering business logic tied to the order completion.
 *
 * Dependencies/Environment:
 * - The application is built using Laravel v10.48.26.
 * - Utilizes MySQL as the database driver.
 * - Synchronous handling of queues (queue connection set to 'sync').
 *
 * Usage Scenarios:
 * - Invoked when an event related to completing a checkout session occurs, typically in e-commerce scenarios.
 * - Designed to handle post-checkout logic, such as updating order statuses, sending confirmation emails,
 *   or processing associated data.
 */
    App\Actions\Shop\HandleCheckoutSessionCompleted;
use /**
 * Event class that is triggered when a webhook is received from a payment provider.
 *
 * This event is commonly used in Laravel applications that integrate the Laravel Cashier
 * package to handle subscription billing services provided by platforms such as Stripe
 * or Paddle.
 *
 * The `WebhookReceived` event allows developers to listen and react to webhooks received
 * from the payment provider. It contains the payload of the received webhook to enable
 * further processing within the application.
 *
 * This event operates as part of the queue system in Laravel, and by default, it uses
 * the application's queue connection, which in this case is set to 'sync'.
 *
 * Event namespace path: Laravel\Cashier\Events\WebhookReceived
 */
    Laravel\Cashier\Events\WebhookReceived;

/**
 * Class responsible for handling Stripe webhook events.
 */
class StripeEventListener
{
    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] == 'checkout.session.completed'){
            (new HandleCheckoutSessionCompleted())->handle($event->payload['data']['object']['id']);
        }
    }
}
