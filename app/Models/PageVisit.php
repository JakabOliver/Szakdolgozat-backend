<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageVisit extends Model
{
    use HasFactory;

    protected $fillable = ['page', 'user_id', 'browser_info', 'ip_address', 'country'];
    protected $casts = [
        'browser_info' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(TrackedUser::class);
    }
}
