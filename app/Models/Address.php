<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'title',
        'address',
        'postal_code',
        'city_id',
        'addressable_type',
        'addressable_id',
        'status'
    ];

    public function addressable() {
        return $this->morphTo();
    }

    public function city() {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
