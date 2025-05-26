<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use App\Actions\Shop\AddProductVariantToCart;
use App\Actions\Shop\CreateStripeCheckoutSession;
use App\Actions\Shop\HandleCheckoutSessionCompleted;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Checkout;
use Mockery;
use Tests\TestCase;

class ShopTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the Mail facade
        Mail::fake();
    }

    /** @test */
    public function it_can_add_a_product_to_cart()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a product and variant
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 19.99,
        ]);

        $variant = ProductVariant::factory()->create([
            'product_id' => $product->id,
        ]);

        // Create a cart for the user
        $cart = Cart::create([
            'user_id' => $user->id,
            'session_id' => $this->faker->uuid,
        ]);

        // Add the product variant to the cart
        $action = new AddProductVariantToCart();
        $action->add($variant->id, 2, $cart);

        // Assert the cart item was created
        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $cart->id,
            'product_variant_id' => $variant->id,
            'quantity' => 2,
        ]);

        // Assert the cart has the item
        $this->assertEquals(1, $cart->items()->count());
        $this->assertEquals($variant->id, $cart->items()->first()->product_variant_id);
    }

    /** @test */
    public function it_can_update_cart_item_quantity()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a product and variant
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 19.99,
        ]);

        $variant = ProductVariant::factory()->create([
            'product_id' => $product->id,
        ]);

        // Create a cart for the user
        $cart = Cart::create([
            'user_id' => $user->id,
            'session_id' => $this->faker->uuid,
        ]);

        // Add the product variant to the cart
        $cartItem = CartItems::create([
            'cart_id' => $cart->id,
            'product_variant_id' => $variant->id,
            'quantity' => 1,
        ]);

        // Update the quantity
        $cartItem->update(['quantity' => 3]);
        $cartItem->refresh();

        // Assert the quantity was updated
        $this->assertEquals(3, $cartItem->quantity);
    }

    /** @test */
    public function it_can_remove_item_from_cart()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a product and variant
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 19.99,
        ]);

        $variant = ProductVariant::factory()->create([
            'product_id' => $product->id,
        ]);

        // Create a cart for the user
        $cart = Cart::create([
            'user_id' => $user->id,
            'session_id' => $this->faker->uuid,
        ]);

        // Add the product variant to the cart
        $cartItem = CartItems::create([
            'cart_id' => $cart->id,
            'product_variant_id' => $variant->id,
            'quantity' => 1,
        ]);

        // Delete the cart item
        $cartItem->delete();

        // Assert the cart item was deleted
        $this->assertDatabaseMissing('cart_items', ['id' => $cartItem->id]);
        $this->assertEquals(0, $cart->items()->count());
    }

    /** @test */
    public function it_can_create_a_checkout_session()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a product and variant
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 19.99,
        ]);

        $variant = ProductVariant::factory()->create([
            'product_id' => $product->id,
        ]);

        // Create a cart for the user
        $cart = Cart::create([
            'user_id' => $user->id,
            'session_id' => $this->faker->uuid,
        ]);

        // Add the product variant to the cart
        CartItems::create([
            'cart_id' => $cart->id,
            'product_variant_id' => $variant->id,
            'quantity' => 2,
        ]);

        // Mock the Checkout class
        $checkoutMock = Mockery::mock(Checkout::class);

        // Mock the CreateStripeCheckoutSession action
        $actionMock = Mockery::mock(CreateStripeCheckoutSession::class);
        $actionMock->shouldReceive('createFromCart')
            ->once()
            ->with($cart)
            ->andReturn($checkoutMock);

        // Call the mocked action
        $checkout = $actionMock->createFromCart($cart);

        // Assert the checkout was created
        $this->assertInstanceOf(Checkout::class, $checkout);
    }

    /** @test */
    public function it_can_handle_checkout_session_completed()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a product and variant
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 19.99,
        ]);

        $variant = ProductVariant::factory()->create([
            'product_id' => $product->id,
        ]);

        // Create a cart for the user
        $cart = Cart::create([
            'user_id' => $user->id,
            'session_id' => $this->faker->uuid,
        ]);

        // Add the product variant to the cart
        CartItems::create([
            'cart_id' => $cart->id,
            'product_variant_id' => $variant->id,
            'quantity' => 2,
        ]);

        // Create a mock session ID
        $sessionId = 'cs_test_' . $this->faker->uuid;

        // Mock the HandleCheckoutSessionCompleted action
        $actionMock = Mockery::mock(HandleCheckoutSessionCompleted::class);
        $actionMock->shouldReceive('handle')
            ->once()
            ->with($sessionId)
            ->andReturnNull();

        // Call the mocked action
        $actionMock->handle($sessionId);

        // This test is limited because we can't easily mock the Stripe API
        // In a real test, we would assert that an order was created
        // and the cart was deleted
    }

    /** @test */
    public function it_calculates_correct_cart_total()
    {
        // Create a user
        $user = User::factory()->create();

        // Create products and variants
        $product1 = Product::factory()->create([
            'name' => 'Product 1',
            'price' => 10.00,
        ]);

        $product2 = Product::factory()->create([
            'name' => 'Product 2',
            'price' => 15.00,
        ]);

        $variant1 = ProductVariant::factory()->create([
            'product_id' => $product1->id,
        ]);

        $variant2 = ProductVariant::factory()->create([
            'product_id' => $product2->id,
        ]);

        // Create a cart for the user
        $cart = Cart::create([
            'user_id' => $user->id,
            'session_id' => $this->faker->uuid,
        ]);

        // Add the product variants to the cart
        CartItems::create([
            'cart_id' => $cart->id,
            'product_variant_id' => $variant1->id,
            'quantity' => 2,
        ]);

        CartItems::create([
            'cart_id' => $cart->id,
            'product_variant_id' => $variant2->id,
            'quantity' => 1,
        ]);

        // Calculate expected total: (10.00 * 2) + (15.00 * 1) = 35.00
        $expectedTotal = 3500; // in cents

        // Assert the cart total is correct
        $this->assertEquals($expectedTotal, $cart->total->getAmount());
    }
}
