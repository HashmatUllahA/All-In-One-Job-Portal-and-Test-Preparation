<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContectUs extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email','city', 'message','mobile_number'];
}
