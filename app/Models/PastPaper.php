<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastPaper extends Model
{
    protected $fillable = [
        'sub_department_id','title', 'tast_date', 'test_center','original_name', 'file_content','file_path', 'doc_type', 'department_id'
    ];

    // Define any relationships if needed
    // For example, if a past paper belongs to a department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
