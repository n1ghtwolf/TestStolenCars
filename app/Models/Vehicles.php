<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;

    protected $fillable = ['name','gov_number','color','vin','mark_id','model_id','year'];
    protected $hidden = ['created_at', 'updated_at'];

    public function mark()
    {
        return $this->belongsTo(VehicleMarks::class, 'mark_id');
    }

    public function model()
    {
        return $this->belongsTo(VehicleModels::class, 'model_id');
    }

     public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
