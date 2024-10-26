<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ticket_id',
        'booking_trx_id',
        'name',
        'email',
        'phone_number',
        'started_at',
        'total_participant',
        'total_amount',
        'is_paid',
        'proof'
    ];

    protected $casts = [
        'started_at' => 'date'
    ];

    public static function generateUniqueTrxId()
    {
        $prefix = 'WSTX';
        do {
            $randomString = $prefix . '-' . strtoupper(bin2hex(random_bytes(2)));
        } while (self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
