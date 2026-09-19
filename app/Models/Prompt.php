<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Prompt extends Model
{
    protected $fillable = ['prompt', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sentEmails()
    {
        return $this->hasMany(SentEmail::class);
    }
}