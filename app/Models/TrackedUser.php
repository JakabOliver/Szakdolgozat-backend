<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrackedUser extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'attributes'];
    protected $primaryKey = 'id';
    protected $casts = [
        'custom_attributes' => 'array',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public static function getDistinct()
    {
        return self::distinct()->get(['id'])->pluck('id')->toArray();
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'user_id');
    }

    public function pageVisits(): HasMany
    {
        return $this->hasMany(PageVisit::class, 'user_id');
    }

    public function updateAtributes(array $newAttributes)
    {
        $this->custom_attributes = array_merge($this->custom_attributes ?? [], $newAttributes);
    }
}
