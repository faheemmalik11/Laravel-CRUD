<?php

namespace App\Models;
use App\Models\Post;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    protected $guarded = [];

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
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

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function roles(){
      return  $this->belongsToMany(Role::class);
    }

    public function permissions(){
        return  $this->belongsToMany(Permission::class);
      }

      public function hasRole($value){
        foreach($this->roles as $role){
            if($role->name == $value){
                return true;
        }
            return false;
      }
    }
      public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
      }

      public function getProfileImageAttribute($value){
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
    }


}