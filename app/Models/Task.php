<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'user_id',
        'is_complete',
    ];

    /**
     * Get the user that the task belongs to
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}