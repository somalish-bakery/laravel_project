<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'order_number',
        'total_amount',
        'status',
        'address',
        'delivery_address',
        'phone',
        'payment_method',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';       // Placed
    const STATUS_PREPARING = 'preparing';   // Cooking
    const STATUS_READY = 'ready';           // Ready
    const STATUS_DELIVERING = 'delivering'; // On Way
    const STATUS_COMPLETED = 'completed';   // Arrived/Completed

    /**
     * Relationship: An order has many items
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relationship: An order belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}