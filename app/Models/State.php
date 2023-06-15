<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = "state";

    protected $fillable = [
        'name',
        'code',
        'price',
    ];

    public function getNameAttribute($value)
    {
       return ucwords(strtolower($value));
    }
}
