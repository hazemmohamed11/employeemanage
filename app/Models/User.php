<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Notifiable, HasRoles;

    protected $fillable = ['name', 'email', 'password', 'phone', 'role'];

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'manager_id');
    }
}
