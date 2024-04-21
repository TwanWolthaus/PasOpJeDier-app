<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'request';

    protected $fillable = [
        'pet_id',
        'start_date',
        'end_date',
        'daily_rate',
        'description',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function pet() {
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    public function transaction() {
        return $this->hasOne(Transaction::class);
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }
}
