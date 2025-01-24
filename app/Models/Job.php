<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'job_title', 'province', 'apply_on_website','zone', 'advertisement_file','file_type', 'file_path','start_date','last_Date','apply_url'
    ];

}
