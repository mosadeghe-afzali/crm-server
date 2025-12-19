<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'name',
        'size',
        'extention',
        'user_id',
        'model_id',
        'model_type',
        'status'
    ];

    public function fileable() {
        return $this->morphTo();
    }
}
