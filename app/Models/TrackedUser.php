<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrackedUser extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id'];
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'user_id');
    }

    public function pageVisits(): HasMany
    {
        return $this->hasMany(PageVisit::class, 'user_id');
    }
}
