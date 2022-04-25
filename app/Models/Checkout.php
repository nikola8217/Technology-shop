<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'street',
        'pb',
        'city',
        'country',
        'phone',
        'total'
    ];

    public static function createCheckout($street, $pb, $city, $country, $phone, $total) {
        return Checkout::create([
            'user_id' => auth()->user()->id,
            'name' => auth()->user()->name . " " . auth()->user()->lastname,
            'street' => $street,
            'pb' => $pb,
            'city' => $city,
            'country' => $country,
            'phone' => $phone,
            'total' => $total
        ]);
    }
}
