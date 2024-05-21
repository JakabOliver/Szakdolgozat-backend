<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'attributes', 'user_id', 'browser_info', 'ip_address', 'country'];
    protected $casts = [
        'browser_info' => 'array',
        'created_at'   => 'datetime:Y-m-d H:i:s',
        'attributes'   => 'json'
    ];

    public static function getDistinctNames()
    {
        return self::distinct()->get(['name'])->pluck('name')->toArray();
    }

    public static function filter(DTO\EventFilterDTO $filter, mixed $limit): Collection|array
    {
        $query = self::query();
        if ($filter->from) {
            $query->where('created_at', '>=', $filter->from);
        }
        if ($filter->to) {
            $query->where('created_at', '<=', $filter->to);
        }
        if ($filter->event) {
            $query->where('name', $filter->event);
        }
        if ($filter->user) {
            $query->where('user_id', $filter->user);
        }
        $query->orderBy('created_at', 'DESC');
        return $query->limit($limit)->get();
    }

    public static function getCountForPastMonth($range = 1)
    {
        $query = self::where('created_at', '>=', Carbon::now()->subMonth($range))
            ->select(['name', DB::raw('count(*) as count')])
            ->groupBy('name');
        return $query->get();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(TrackedUser::class);
    }
}
