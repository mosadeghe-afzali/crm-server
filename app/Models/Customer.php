<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'type'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(CustomerCompany::class, 'customer_id', 'id');
    }

    public function scopeFilter($query, $request)
    {

        $query->when(
            $request['id'] ?? false,
            fn($query, $request) => $query->where('id', $request)
        );
        $query->when(
            $request['type'] ?? false,
            fn($query, $request) => $query->where('type', $request)
        );
    }
}
