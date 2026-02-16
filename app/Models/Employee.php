<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'user_id',
        'position_id',
        'internal_code',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function user()
    {
        return  $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeFilter($query, $request)
    {

        $query->when(
            $request['id'] ?? false,
            fn($query, $request) => $query->where('id', $request)
        );

        $query->when(
            $request['user_id'] ?? false,
            fn($query, $request) => $query->where('user_id', $request)
        );

        $query->when(
            $request['full_name'] ?? false,
            fn($query, $request) =>
             $query->whereHas('user',
             fn($q) => $q->where(DB::raw('concat(first_name, " ", last_name)'), 'LIKE', "%{$request}%"))
        );
    }
}
