<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'action', 
        'data',
        'user_id'
    ]; 

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
