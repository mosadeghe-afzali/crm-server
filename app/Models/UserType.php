<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $fillable = ['name', 'slug'];
}
    public function scopeFilter($query, $request) {

        $query->when(
            $request['id'] ?? false,
            fn($query, $request) => $query->where('users.id', $request)
        );

        $query->when(
            $request['slug'] ?? false,
            fn($query, $request) => $query->where('slug', 'LIKE', '%' . $request . '%')
        );
    }
