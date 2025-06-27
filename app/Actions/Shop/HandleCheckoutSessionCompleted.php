<?php

/**
 * Handle the completion of a Stripe checkout session.
 *
 * This class is responsible for processing the completed checkout session,
 * creating an Order with the associated OrderItems, clearing the user's cart,
 * and sending an order confirmation email.
 */

namespace App\Actions\Shop;

use /**
 * This class represents the OrderConfirmation mail.
 *
 * It is responsible for constructing and sending an email
 * related to order confirmation in the application.
 *
 * Laravel version: v10.48.26
 *
 * The application uses MySQL as the database and sync as the queue connection.
 */
App\Mail\OrderConfirmation;
use /**
 * Cart Model
 *
 * Represents a shopping cart in the application.
 * Provides access to cart-related data stored in the database.
 *
 * This model interacts with the MySQL database and uses Laravel's
 * Eloquent ORM for data handling.
 *
 * Features:
 * - Ability to manage and retrieve cart items.
 * - Relates to other models such as Products or Users, if applicable.
 * - Utilizes Laravel features like query scopes, relationships, and accessors/mutators.
 *
 * Configurations:
 * - Database Connection: MySQL
 * - Queue Connection: Sync (for related tasks, if applicable)
 *
 * Associated Laravel Version: 10.48.26
 *
 * Considerations:
 * - Ensure proper validation and business logic when interacting with this model.
 * - Customize relationships or methods within the model as per application requirements.
 */
App\Models\Cart;
use /**
 * The OrderItems model.
 *
 * This model represents items associated with orders in the application.
 *
 *
 * @property int $id The primary key of the order item.
 * @property int $order_id The ID of the associated order.
 * @property int $product_id The ID of the associated product.
 * @property int $quantity The number of products ordered.
 * @property float $price The price of the product.
 * @property \Illuminate\Support\Carbon|null $created_at The date and time when the record was created.
 * @property \Illuminate\Support\Carbon|null $updated_at The date and time when the record was last updated.
 */
App\Models\OrderItems;
use /**
 * The User model represents a user entity within the application.
 *
 * This model interacts with the 'users' table in the database.
 * It provides methods for managing user data, authentication, and relationships.
 *
 * Laravel Version: 10.48.26
 * Database: MySQL
 * Queue Connection: sync
 */
App\Models\User;
use /**
 * Class DB
 *
 * This facade provides access to the underlying database connection and query builder
 * in a Laravel application. It offers methods to perform raw SQL queries, manage
 * database transactions, and interact with the application's database.
 *
 * Features:
 * - Run raw SQL queries using the `select`, `insert`, `update`, and `delete` methods.
 * - Transactions handling with `beginTransaction`, `commit`, and `rollBack` methods.
 * - Accessing query logs and enabling query logging when necessary.
 * - Retrieve PDO connection for low-level database operations.
 * - Supports multiple database connections and reconnection management.
 *
 * Methods Summary:
 * - select(): Executes a raw SQL SELECT query and retrieves data as an array of objects.
 * - insert(): Executes a raw SQL INSERT query.
 * - update(): Executes a raw SQL UPDATE query.
 * - delete(): Executes a raw SQL DELETE query.
 * - statement(): Executes an arbitrary SQL statement.
 * - transaction(): Performs a set of operations within a transaction.
 * - beginTransaction(): Begins a new transaction.
 * - commit(): Commits the current transaction.
 * - rollBack(): Rolls back the current transaction.
 * - connection(): Retrieves a database connection instance.
 * - getPdo(): Returns the underlying PDO connection.
 * - listen(): Allows listening for database queries executed during runtime.
 */
Illuminate\Support\Facades\DB;
use /**
 * The Mail facade provides a simplistic and expressive interface for sending emails
 * in a Laravel application. It enables the use of the underlying mailer without
 * instantiating it manually, supporting various mail drivers and configurations.
 *
 * This facade is part of the Illuminate\Support\Facades namespace and allows
 * access to Laravel's mailing system for queueable and non-queueable emails.
 *
 * Common functionalities include sending messages using Mailable classes,
 * direct email composition through closures, and leveraging markdown mail templates.
 *
 * The facade integrates seamlessly with Laravel's service container and configurations
 * specified in config/mail.php. It supports multiple mail drivers such as SMTP, SES,
 * Mailgun, Postmark, and more.
 *
 * Class Illuminate\Support\Facades\Mail
 */
Illuminate\Support\Facades\Mail;
use /**
 * The Cashier class provides convenience methods for managing Stripe billing
 * and subscription management in a Laravel application.
 *
 * This class facilitates integration with Stripe to handle subscriptions, payment processing,
 * and billing features, including features like webhook handling, invoice generation,
 * and subscription plan management.
 *
 * It serves as a bridge between Laravel models and Stripe, offering streamlined methods
 * for interacting with Stripe's API in a Laravel-specific way.
 *
 * Example use cases include:
 * - Defining billing plans and subscriptions.
 * - Creating and handling customer Stripe objects.
 * - Managing Stripe webhooks and events.
 *
 * Cashier uses a model that can be extended and customized to store additional metadata or
 * interact with user models effectively within a Laravel application.
 *
 * Prerequisites:
 * - Ensure that Stripe API keys are properly configured in the environment variables.
 * - Set up the required migrations for billing-related database tables using Cashier's
 * published migrations.
 *
 * Note: Ensure queue processing where applicable as some operations may require asynchronous
 * processing, though this app appears to use the `sync` queue driver.
 */
Laravel\Cashier\Cashier;
use /**
 * Class Stripe\LineItem
 *
 * Represents a line item in a Stripe payment or checkout session.
 *
 * This class is typically used for defining and managing individual items
 * in a Stripe transaction. Line items may include product details, prices,
 * quantities, and any other metadata required for processing the payment.
 *
 * Usage of this class depends on integration with Stripe's API to ensure
 * accurate transaction data and functionalities.
 *
 * The Stripe\LineItem class interacts with other Stripe features like
 * pricing models, discounts, taxes, and inventory to process purchases.
 *
 * Integrations with this class should follow the Stripe API documentation
 * to ensure valid and compliant usage of its attributes and capabilities.
 *
 * Key functionalities:
 * - Define item details for transaction purposes in Stripe.
 * - Supports prices, quantities, and descriptions.
 * - Includes support for extensible metadata as needed for specific business
 *   requirements.
 */
Stripe\LineItem;

/**
 * Class HandleCheckoutSessionCompleted
 *
 * Handles the Stripe checkout session completed event.
 * - Retrieves checkout session details from Stripe.
 * - Creates an order for the associated user with session data.
 * - Maps session line items to order items.
 * - Deletes the user's cart and its items after order creation.
 * - Sends an order confirmation email to the user.
 */
class HandleCheckoutSessionCompleted
{
    /**
     * @throws \Throwable
     */
    public function handle($sessionId): void
    {
        DB::transaction(function () use ($sessionId) {
            $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);
            $user = User::find($session->metadata->user_id);
            $cart = Cart::find($session->metadata->cart_id);

            $order = $user->orders()->create([
                'stripe_checkout_session_id' => $session->id,
                'amount_shipping' => $session->total_details->amount_shipping,
                'amount_discount' => $session->total_details->amount_discount,
                'amount_tax' => $session->total_details->amount_tax,
                'amount_subtotal' => $session->amount_subtotal,
                'amount_total' => $session->amount_total,
                'billing_address' => [
                    'name' => $session->customer_details->name,
                    'line1' => $session->customer_details->address->line1,
                    'line2' => $session->customer_details->address->line2,
                    'city' => $session->customer_details->address->city,
                    'state' => $session->customer_details->address->state,
                    'country' => $session->customer_details->address->country,
                    'postal_code' => $session->customer_details->address->postal_code,
                ],
                'shipping_address' => [
                    'name' => $session->shipping_details->name,
                    'line1' => $session->shipping_details->address->line1,
                    'line2' => $session->shipping_details->address->line2,
                    'city' => $session->shipping_details->address->city,
                    'state' => $session->shipping_details->address->state,
                    'country' => $session->shipping_details->address->country,
                    'postal_code' => $session->shipping_details->address->postal_code,

                ],
            ]);
            $lineItems = Cashier::stripe()->checkout->sessions->allLineItems($session->id);

            $orderItems = collect($lineItems->all())->map(function (LineItem $line) {
                $product = Cashier::stripe()->products->retrieve($line->price->product);

                return new OrderItems([
                    'product_variant_id' => $product->metadata->product_variant_id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $line->price->unit_amount,
                    'quantity' => $line->quantity,
                    'amount_discount' => $line->amount_discount,
                    'amount_tax' => $line->amount_tax,
                    'amount_subtotal' => $line->amount_subtotal,
                    'amount_total' => $line->amount_total,
                ]);
            });
            $order->items()->saveMany($orderItems);
            $cart->items()->delete();
            $cart->delete();
            Mail::to($user)->send(new OrderConfirmation($order));
        });
    }
}
