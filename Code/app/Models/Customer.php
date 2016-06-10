<?php

namespace Cart\Models;
use Illuminate\Database\Eloquent\Model;
use Cart\Models\Cart;

class Customer extends Model{
    protected $fillable = [
        'email',
        'name'
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }
}