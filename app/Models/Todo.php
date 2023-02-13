<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $appends = ['date_time_formated'];
    //---
    public function getMaintenanceFormatedAttribute()
    {
        return date("d-m-Y H:i", strtotime($this->date_time));
    }
}
