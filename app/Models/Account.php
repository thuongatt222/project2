<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone_number', 'birthday', 'address', 'email', 'cccd', 'username', 'password', 'role', 'create_at', 'update_at'];
}
