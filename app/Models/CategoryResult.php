<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryResult extends Model
{
    use HasFactory;

    protected $table = 'category_results';

    protected $fillable = [
        'total_points',
        'attachment',
    ];

    public function result()
    {
        return $this->belongsTo(Result::class);
    }
    

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questionResult()
    {
        return $this->hasMany(QuestionResult::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
