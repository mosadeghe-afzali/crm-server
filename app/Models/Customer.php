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
    public function user() {
        $this->belongsTo(User::class, 'user_id', 'id');
    }
}
