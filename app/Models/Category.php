<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function categoryQuestions()
    {
        return $this->hasMany(Question::class);
    }

    public function categoryFeedback(){
        return $this->hasMany(Feedback::class, 'categori_id');
    }

    public function result(){
        return $this->hasMany(Result::class);
    }

    public function catagoryResult(){
        return $this->hasMany(CategoryResult::class);
    }
}
