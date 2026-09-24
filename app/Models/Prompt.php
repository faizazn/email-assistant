<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prompt extends Model
{
    protected $fillable = ['prompt', 'category_id'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sentEmails()
    {
        return $this->hasMany(SentEmail::class);
    }
}