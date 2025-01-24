<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    // public function subject(){
    //     return $this->hasMany('App\Models\Subject'); 
    // }
    public function subjects()
    {
        return $this->hasMany('App\Models\Subject', 'Department_id'); 
    }
    
}
