<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function categori(){
        return $this->belongsTo(Category::class);
    }
}
