<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    public const PAYMENT_TRANSFER = 'transfer';
    public const PAYMENT_COD = 'cod';

    public const STATUS_PENDING = 'pending';
    public const STATUS_PAID = 'paid';
    public const STATUS_SHIPPED = 'shipped';
    public const STATUS_DONE = 'done';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'customer_name', 'phone', 'address',
        'payment_method', 'payment_proof',
        'status', 'total',
    ];

    protected $casts = [
        'total' => 'integer',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function statuses(): array
    {
        return [
            self::STATUS_PENDING => 'Menunggu pembayaran',
            self::STATUS_PAID => 'Dibayar',
            self::STATUS_SHIPPED => 'Dikirim',
            self::STATUS_DONE => 'Selesai',
            self::STATUS_CANCELLED => 'Batal',
        ];
    }
}
