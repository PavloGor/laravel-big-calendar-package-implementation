<?php

namespace OpenHands\BigCalendar\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use OpenHands\BigCalendar\Database\Factories\CalendarEventFactory;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'color',
        'user_id',
        'all_day',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'all_day' => 'boolean',
    ];

    protected $appends = [
        'is_multi_day',
        'duration_minutes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(CalendarUser::class, 'user_id');
    }

    public function getIsMultiDayAttribute(): bool
    {
        if (!$this->start_date || !$this->end_date) {
            return false;
        }
        return $this->start_date->format('Y-m-d') !== $this->end_date->format('Y-m-d');
    }

    public function getDurationMinutesAttribute(): int
    {
        if (!$this->start_date || !$this->end_date) {
            return 0;
        }
        return $this->start_date->diffInMinutes($this->end_date);
    }

    public function scopeInDateRange($query, Carbon $start, Carbon $end)
    {
        return $query->where(function ($q) use ($start, $end) {
            $q->whereBetween('start_date', [$start, $end])
              ->orWhereBetween('end_date', [$start, $end])
              ->orWhere(function ($q2) use ($start, $end) {
                  $q2->where('start_date', '<=', $start)
                     ->where('end_date', '>=', $end);
              });
        });
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeWithColor($query, string $color)
    {
        return $query->where('color', $color);
    }

    public function toArray()
    {
        $array = parent::toArray();
        
        // Format dates for frontend compatibility
        $array['startDate'] = $this->start_date->toISOString();
        $array['endDate'] = $this->end_date->toISOString();
        
        return $array;
    }

    protected static function newFactory()
    {
        return CalendarEventFactory::new();
    }
}