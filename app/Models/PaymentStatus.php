<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    const CAPTURED = 'Captured';
    const REFUNDED = 'Refunded';

    use HasFactory;

    protected $guarded = [];
}
