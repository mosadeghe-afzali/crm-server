<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'type'
    ];


    const TYPE_PERSON = 1;
    const TYPE_COMPANY = 2;

    const CUSTOMER_TYPES_TEXT = [
        self::TYPE_PERSON => 'حقیقی',
        self::TYPE_COMPANY => 'حقوقی'
    ];

    const CUSTOMER_TYPES_ENUM = [
        self::TYPE_PERSON => 'person',
        self::TYPE_COMPANY => 'company'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function company()
    {
        return $this->hasOne(CustomerCompany::class, 'customer_id', 'id');
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
        $query->when(
            $request['full_name'] ?? false,
            fn($query, $request) =>
            $query->whereHas(
                'user',
                fn($q) => $q->where(DB::raw('concat(first_name, " ", last_name)'), 'LIKE', "%{$request}%")
            )
        );
    }
}
