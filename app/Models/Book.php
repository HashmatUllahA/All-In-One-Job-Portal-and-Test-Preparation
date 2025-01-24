<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['department_id', 'sub_department_id', 'title','file_type', 'original_name', 'file_path','description'];

    public function images()
    {
        return $this->hasMany(BookImage::class);
    }
}
