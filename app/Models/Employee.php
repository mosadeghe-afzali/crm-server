<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'user_id',
        'position_id',
        'internal_code',
        'department_id'
    ];

    public function department() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function user() {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeFilter($query, $request) {

    }
}
