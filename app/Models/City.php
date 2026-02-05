<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "cities";

    protected $fillable = [
        'name',
        'slug',
        'province_id'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function scopeFilter($query, $request)
    {
        $query->when(
            $request['city_id'] ?? false,
            fn($query, $request) => $query->where('id', $request)
        );

        $query->when(
            $request['province_id'] ?? false,
            fn($query, $request) => $query->where('province_id', $request)
        );
    }
}
