<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Pin
 *
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property string $image
 * @property int $width
 * @property int $height
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PinFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Pin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pin whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pin whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pin whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pin whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pin whereWidth($value)
 * @mixin \Eloquent
 */
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
