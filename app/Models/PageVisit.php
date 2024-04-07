<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageVisit extends Model
{
    use HasFactory;

    protected $fillable = ['page', 'user_id', 'browser_info', 'ip_address', 'country'];
    protected $casts = [
        'browser_info' => 'array',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    public static function getDistinctPageNames()
    {
        return self::distinct()->get(['page'])->pluck('page')->toArray();
    }

    public static function filter(DTO\VisitFilterDTO $filter, mixed $limit): Collection|array
    {
        $query = self::query();
        if ($filter->from) {
            $query->where('created_at', '>=', $filter->from);
        }
        if ($filter->to) {
            $query->where('created_at', '<=', $filter->to);
        }
        if ($filter->page) {
            $query->where('page', $filter->page);
        }
        if ($filter->user) {
            $query->where('user_id', $filter->user);
        }
        return $query->limit($limit)->get();

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(TrackedUser::class);
    }
}
