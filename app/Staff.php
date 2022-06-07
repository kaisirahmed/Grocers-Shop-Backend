<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\StaffEmailVerificationNotification;
use App\Notifications\StaffResetPasswordNotification as Notification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Enums;

class Staff extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Enums, SoftDeletes;

    protected $guard = 'staff';

    protected $fillable = [
        'name', 'email', 'password', 'role', 'join_date', 
        'separation_date',
    ];

    protected $enumStatuses = [
        'role', 
    ];
 
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Custom password reset notification.
     * 
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new Notification($token));
    }

    /**
     * Send email verification notice.
     * 
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new StaffEmailVerificationNotification);
    }

    public function hasAnyRole($role)
    {
        if ($this->whereIn('role',$role)->first()) {
            return true;
        }

        return false;
    }

    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = strtolower($name);
    }

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
