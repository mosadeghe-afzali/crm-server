<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = ['name'];

    public function scopeFilter($query, $request)
    {
        $query->when(
            $request['department_id'] ?? false,
            fn($query, $request) => $query->where('id', $request)
        );

        $query->when(
            $request['province_id'] ?? false,
            fn($query, $request) => $query->where('province_id', $request)
        );
    }
}
