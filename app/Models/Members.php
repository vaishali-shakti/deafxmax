<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'mobile',
        'email',
        'pancard_no',
        'bank_act_no',
    ];
}
