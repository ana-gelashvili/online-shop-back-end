<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total', 'status', 'shipping_address', 'phone_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
