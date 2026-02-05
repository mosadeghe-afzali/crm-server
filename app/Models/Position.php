<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'positions';

    protected $fillable = [
        'name',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function scopeFilter($query, $request)
    {
        $query->when(
            $request['position_id'] ?? false,
            fn($query, $request) => $query->where('id', $request)
        );

        $query->when(
            $request['department_id'] ?? false,
            fn($query, $request) => $query->where('department_id', $request)
        );
    }
}
