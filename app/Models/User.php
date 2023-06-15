<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_no',
        "address",
        "state",
        "image",
        "role_id",
        "status",
        "city",
        "parent_id",
        "surname",
        "pancard_no",
        "bank_act_no",


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImageAttribute($value){

        if ($this->attributes['image'] != NULL) {
            $image = public_path('admin_images/my_profile/'.$value);
            if(file_exists($image)){
                return url('admin_images/my_profile',$value);
            } else{
                return url('assets/noimage/noimage.png');
            }
        }else{
            return null;
        }
    }

    public function State_Detail(){
        return $this->hasOne(State::class, 'id', 'state');
    }
}
