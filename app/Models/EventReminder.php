<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReminder extends Model
{
    use HasFactory;
    protected $fillable = [
        'reminder_id', 'title', 'description', 'event_time', 'location', 'attendees', 'completed'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastReminder = static::where('reminder_id', 'like', 'EVR-' . date('Ymd') . '%')
                ->orderBy('reminder_id', 'desc')
                ->first();

            if ($lastReminder) {
                $lastNumber = (int)substr($lastReminder->reminder_id, -3);
                $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '001';
            }

            $model->reminder_id = 'EVR-' . date('Ymd') . '-' . $newNumber;
        });
    }

    public function scopeUpcoming($query)
    {
        return $query->where('completed', false)->where('event_time', '>=', now());
    }

    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }
}
