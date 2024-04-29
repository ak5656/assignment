<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Jobs extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    public function User() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
