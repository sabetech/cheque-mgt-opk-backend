<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cheque extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id', 'deleted_at', 'created_at', 'updated_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
