<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
class Google extends Model
{
    use HasFactory, AuthenticatableTrait;
    protected $table = "google_login";

    protected $fillable = [
        "google_id",
        "name",
        "email",
        "password"
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'password' => 'hashed',
    ];
}
