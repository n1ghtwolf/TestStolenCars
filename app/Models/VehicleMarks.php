<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMarks extends Model
{
    use HasFactory;
    protected $fillable = ['mark_id','name'];
    protected $hidden = ['created_at', 'updated_at'];

}
