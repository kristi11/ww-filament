# Shop System

WittyWorkflow includes a fully-featured e-commerce system built with the TALL stack and integrated with Stripe for payment processing. This section will guide you through setting up and using the shop functionality.

## 🏗️ Shop Architecture Overview

The shop system consists of several key components:

- **Products & Variants**: Products can have multiple variants (size, color, etc.)
- **Cart System**: Manages items added to a user's cart
- **Checkout Process**: Integrated with Stripe for secure payments

## ⚙️ Setting Up the Shop

### 1. Stripe Integration

First, add your Stripe credentials to your `.env` file:

```
STRIPE_KEY=your-stripe-key
STRIPE_SECRET=your-stripe-secret
STRIPE_WEBHOOK_SECRET=your-stripe-webhook-secret
```

#### Development Environment Setup

For local testing:

1. Install [stripe-cli](https://docs.stripe.com/stripe-cli)
2. Run `stripe login` to authenticate with your Stripe account
3. Start the webhook listener:
    ```
    stripe listen --forward-to {your-local-url}/stripe/webhook --format JSON
    ```
4. Copy the webhook signing secret provided by the CLI to your `.env` file as `STRIPE_WEBHOOK_SECRET`

#### Production Environment Setup

For production:

1. Run `php artisan cashier:webhook` on your server to register the webhook with Stripe
2. Go to the [Stripe Webhooks Dashboard](https://dashboard.stripe.com/webhooks)
3. Click on the newly created webhook
4. Copy the "Signing Secret" to your `.env` file as `STRIPE_WEBHOOK_SECRET`
5. Ensure the `checkout.session.completed` event is enabled:
    - Click the "..." button on the webhook
    - Choose "Update details"
    - Under "Events to send", click "Select events..."
    - Add `checkout.session.completed`

### 2. Database Configuration

The shop system uses several database tables:

- `products`: Stores product information
- `product_variants`: Stores variant information for products
- `carts`: Manages user shopping carts
- `cart_items`: Stores items in carts
- `orders`: Tracks completed orders
- `order_items`: Stores items in orders

These tables are created automatically when you run migrations.

## 🛍️ Using the Shop System

### Product Management

Products are managed through the Filament admin panel:

1. Navigate to the Products section in the admin panel
2. Create products with basic information (name, description, price, image)
3. Add variants for each product (size, color, etc.)

### Cart Functionality

The cart system allows users to:

- Add products to their cart
- Update quantities
- Remove items
- View cart totals

The cart is implemented using the `Cart` and `CartItems` models, with the `AddProductVariantToCart` action handling the addition of products.

### Checkout Process

The checkout process is handled by:

1. `CreateStripeCheckoutSession`: Creates a Stripe checkout session from the cart
2. `HandleCheckoutSessionCompleted`: Processes the completed checkout, creates an order, and clears the cart

### Order Management

After checkout, orders are:

1. Created in the database with billing and shipping information
2. Associated with the user who made the purchase
3. Viewable in the admin panel for management

## 🧪 Testing the Shop

To test purchases in your development environment:

1. Use Stripe's test card number: `4242 4242 4242 4242`
2. Any future expiration date (e.g., `03/30`)
3. Any 3-digit CVC code (e.g., `123`)
4. Any name and address information

## 🚀 Going Live

To switch to production mode:

1. Complete your business profile in the [Stripe Dashboard](https://dashboard.stripe.com/settings/account)
2. Switch from test to live API keys in your `.env` file
3. Ensure your webhook is properly configured for the live environment
4. Test the complete purchase flow with a real card (consider using a small amount)

## 🔧 Customizing the Shop

The shop system is designed to be customizable:

- **Product Variants**: Add custom variants in `app/Enums/` and update the `ProductVariant` model
- **Checkout Flow**: Modify the `CreateStripeCheckoutSession` class to customize checkout options
- **Order Processing**: Extend the `HandleCheckoutSessionCompleted` class to add custom logic after purchase

See the [Configuration Guide](../configuration/README.md) for detailed instructions on customizing product variants.

[Back to Top](../../README.md)

---

Last Updated: June 2025
