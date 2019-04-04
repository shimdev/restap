<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";

    protected $fillable = [
        'order', 'cashier', 'total'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order', 'order');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'cashier');
    }
}