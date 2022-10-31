<?php

namespace App\Models;

use App\Models\Fine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function fines(){
        return $this->hasMany(Fine::class);
    }

}
