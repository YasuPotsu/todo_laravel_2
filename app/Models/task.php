<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * タスクを保持するユーザーの取得
     */

     public function user()
     {
        return $this->belongsTo(User::class);
     }
}

