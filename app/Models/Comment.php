<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends \Eloquent
{
	use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'comment',
        'pin_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
