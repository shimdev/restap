<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = [
        'customer', 'dishes', 'seat',
        'note', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'customer');
    }
}
