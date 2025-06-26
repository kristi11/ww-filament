<?php

namespace App\Actions\Orders;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class GetOrderByCheckoutSession
{
    /**
     * Get an order by its Stripe checkout session ID for a specific user
     *
     * @param  string  $sessionId  The Stripe checkout session ID
     * @param  int  $userId  The ID of the user who owns the order
     * @return Model|null The order if found, null otherwise
     */
    public function execute(string $sessionId, int $userId): ?Model
    {
        return Order::where('user_id', $userId)
            ->where('stripe_checkout_session_id', $sessionId)
            ->first();
    }
}
