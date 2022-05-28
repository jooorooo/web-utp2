<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pin extends \Eloquent
{
	use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'user_id',
        'image',
        'width',
        'height',
    ];
	
	public function user() 
	{
		return $this->belongsTo(User::class);
	}
	
	public function comments() 
	{
		return $this->hasMany(Comment::class);
	}
}
