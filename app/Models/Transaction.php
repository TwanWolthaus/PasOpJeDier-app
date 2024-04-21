<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Request
{
    use HasFactory;

    protected $table = 'transaction';

    protected $fillable = [
        'request_id',
        'sitter_id',
        'review_sitter',
        'review_owner',
    ];

    public function request() {
        return $this->belongsTo(Request::class, 'request_id');
    }

    public function sitter() {
        return $this->belongsTo(User::class, 'sitter_id');
    }

}
