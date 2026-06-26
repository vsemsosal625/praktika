<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Athlete extends Model
{
    use HasFactory;

    protected $fillable = [
        'sport_id', 'team_id', 'name', 'slug', 'country',
        'birth_date', 'position', 'photo', 'bio',
    ];

    protected function casts(): array
    {
        return ['birth_date' => 'date'];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
