<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sentEmails()
    {
        return $this->hasMany(SentEmail::class);
    }
}