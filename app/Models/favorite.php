<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class favorite extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'con_id'
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
    
}
