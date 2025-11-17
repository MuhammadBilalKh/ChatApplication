<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\PostLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'profile_picture',
        'country_id',
        "cover_image",
        "city_name",
        "gender",
        "is_online",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getPosts()
    {
        return $this->hasMany(Post::class, 'user_id', 'user_id');
    }

    public function getFriends()
    {
        return $this->hasMany(FriendShip::class, 'sender_id', 'user_id')
            ->where('status', FRIEND_REQUEST_STATUS_ACCEPTED);
    }

    public static function checkFriendShipStatus($memberID)
    {
        return FriendShip::where(function ($query) use ($memberID) {
                $query->where('sender_id', Auth::user()->user_id)
                    ->where('receiver_id', $memberID);
            })
            ->orWhere(function ($query) use ($memberID) {
                $query->where('sender_id', $memberID)
                    ->where('receiver_id', Auth::user()->user_id);
            })
            ->first();
    }

    public function getLikedPosts(){
        return $this->hasMany(User::class, 'user_id', "user_id");
    }

    public function setNameAttribute($val){
        return $this->attributes['name'] = ucwords($val);
    }
}
