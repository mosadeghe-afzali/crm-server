<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCompany extends Model
{
    protected $fillable = [
        'customer_id',
        'national_id',
        'registeration_date',
        'company_name'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function scopeFilter($query, $request) {}
}
