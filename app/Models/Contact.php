<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contact extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'relation',
        'user_id',
        'phone',
        'altph',
        'email',
        'altml',
        'location',
        'photo'
    ];

    /**
     * Get the user that owns the Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function favorites()
    // {
    // return $this->hasMany('App\Models\Favorite');
    // }
}
