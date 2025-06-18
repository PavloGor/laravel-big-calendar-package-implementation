<?php

namespace OpenHands\BigCalendar\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OpenHands\BigCalendar\Database\Factories\CalendarUserFactory;

class CalendarUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'picture_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(CalendarEvent::class, 'user_id');
    }

    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->picture_path) {
            return asset('storage/' . $this->picture_path);
        }
        
        // Generate a default avatar URL based on name initials
        $initials = collect(explode(' ', $this->name))
            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
            ->take(2)
            ->implode('');
            
        return "https://ui-avatars.com/api/?name={$initials}&background=random";
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['picturePath'] = $this->picture_path;
        $array['avatarUrl'] = $this->avatar_url;
        return $array;
    }

    protected static function newFactory()
    {
        return CalendarUserFactory::new();
    }
}