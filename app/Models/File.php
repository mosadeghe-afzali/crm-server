<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'name',
        'size',
        'extension',
        'user_id',
        'fileable_id',
        'fileable_type',
        'status'
    ];

    public function fileable() {
        return $this->morphTo();
    }
}
