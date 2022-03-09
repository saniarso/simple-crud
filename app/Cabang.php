<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cabang extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_cabang'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
