<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pet';

    protected $fillable = [
        'name',
        'profilepic',
        'species',
        'breed',
        'behaviour',
        'allergy',
    ];

    public function person()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function request()
    {
        return $this->hasOne(Request::class);
    }
}
