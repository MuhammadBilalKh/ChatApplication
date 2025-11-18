<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $primaryKey = 'notification_id';

    protected $fillable = [
        'user_id',
        'message',
        'is_read',
        'created_at',
        'updated_at',
        'type',
        'notifiable_id',
        'notifiable_type',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

    public $timestamps = true;

    public static function createNotification($userId, $message, $type, $notifiableId, $notifiableType, $description){
        return static::create([
            'user_id' => $userId,
            'message' => $message,
            'is_read' => false,
            'type' => $type,
            'notifiable_id' => $notifiableId,
            'notifiable_type' => $notifiableType,
            'description' => $description,
        ]);
    }
}
