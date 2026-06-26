<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'sport_id', 'name', 'slug', 'country', 'season',
        'start_date', 'end_date', 'description',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    public function matches(): HasMany
    {
        return $this->hasMany(MatchGame::class)->orderBy('scheduled_at');
    }

    public function standings(): HasMany
    {
        return $this->hasMany(Standing::class)->orderBy('position');
    }
}
